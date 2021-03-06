<?php


class UserDeploymentsService
{

    private $tableName = 'Metadata';
    private $primaryKey = 'Idmetadata';
    private $logger;
    private $galaxy_url;
    private $galaxy_api_key;

    public function __construct(Monolog\Logger $logger, $galaxy_url, $galaxy_api_key)
    {
        $this->logger = $logger;
        $this->galaxy_url = $galaxy_url;
        $this->galaxy_api_key = $galaxy_api_key;
    }


    function getJenkinsReport()
    {

        return PhenomenalJenkinsReport::get_json_report();
    }

    function getGoogleKey()
    {

        $output = shell_exec('python service-account.py');
        $output = preg_replace("/\r\n|\r|\n/", '', $output);
//        header('Content-type: application/json');
        $sub = array('key' => $output);
        $arr = array('result' => 1, 'data' => $sub);

        return $arr;
    }

    /**
     * @param $userId
     * @param $galaxyAccount
     * @return array|mixed
     * @throws UserDeploymentsServiceException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    function createGalaxyUser($userId, $galaxyAccount)
    {
        $data = array();
        $entity = UserQuery::create()->findOneById($userId);

        if ($entity == null) {
            $data[] = helper::getError(
                404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
        } else {
            $url = $this->galaxy_url . '/api/users?key=' . $this->galaxy_api_key;
            $fields = array(
                'email' => $galaxyAccount['email'],
                'username' => $galaxyAccount['username'],
                'password' => $galaxyAccount['password']
            );

            $fields_string = '';
            foreach ($fields as $key => $value) {
                $fields_string .= $key . '=' . $value . '&';
            }
            rtrim($fields_string, '&');

            $this->logger->debug("Processing request 'createGalaxyUser': URL=$url");

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

            $result = curl_exec($ch);

            curl_close($ch);

            $this->logger->debug("Raw response: " . $result);
            $data = json_decode($result, true);
            $this->logger->debug("Array correctly decoded!");

            if ($data && (!isset($data["err_code"]) || $this->isAlreadyRegisteredEmail($data))) {
                // update to true 'HasGalaxyAccount' when error_code=400008,
                // that implies an already registered user
                $entity->setHasGalaxyAccount(true);
                $entity->save();
                $data['data'] = $entity->toArray();
            }

            if ($data && isset($data["err_code"])) {
                $this->logger->debug("Setting error CODE: " . $data["err_code"]);
                throw new UserDeploymentsServiceException(
                    $data[/** @lang text */
                    "err_msg"], $this->isAlreadyRegisteredEmail($data) ? 409 : 500, $data);
            }
            $this->logger->debug("Return from createGalaxyUser method!!!");
        }

        $this->logger->debug("Type of the DATA object: " . gettype($data));
        return $data;
    }

    private function isAlreadyRegisteredEmail($data)
    {
        $msg_pattern = 'User with that email already exists.';
        $length = strlen($msg_pattern);
        $result = isset($data['err_code'])
            && ($data['err_code'] == '400008')
            && (substr($data['err_msg'], 0, $length) === $msg_pattern);
        $this->logger->debug("the email already exists:" . ($result ? "TRUE" : "FALSE"));
        return $result;
    }


    /**
     * @param $query
     * @return array
     */
    function find($query = null)
    {
        $this->logger->debug("Performing FIND using query: " . json_encode($query));
        $entity = MetadataQuery::create()->findByArray($query);
        $this->logger->debug("Find executed... RESULT=" . json_encode($query));

        return array("data" => $entity->toArray());
    }

    /**
     * @param $id
     * @return array
     */
    function findById($id = null)
    {
        $entity = MetadataQuery::create()->findPk($id);
        return array("data" => empty($entity) ? array() : $entity->toArray());
    }

    /**
     * @param $ids
     * @return array
     */
    function findByIds($ids = null)
    {
        $entity = MetadataQuery::create()->findPks($ids);
        return array("data" => empty($entity) ? array() : $entity->toArray());
    }


    /**
     * @param $id
     * @return array
     */
    function getUser($id)
    {
        $entity = UserQuery::create()->findOneById($id);
        if ($entity == null) {
            #$data = helper::getError(404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
            $data = helper::getError(404, 'No user found with ID ' . $id);
        } else {
            $data = array();
            $data['data'] = $entity->toArray();
        }
        return $data;
    }

    function createUser($userInfo)
    {
        $this->logger->debug(" data: " . gettype($userInfo) . " --- " . json_encode($userInfo));
        $data = array();
        try {
            $user = new User($userInfo);
            $user->save();
            $data['data'] = $user->toArray();
        } catch (Exception $e) {
            $data = helper::getError(409, $e->getMessage());
            $this->logger->error($e->getTraceAsString());
        } finally {
            return $data;
        }
    }

    function deleteUser($id)
    {
        $result = array();
        $this->logger->debug("ID of the user to delete: $id");
        $entity = UserQuery::create()->findById($id);
        if ($entity == null) {
            $this->logger->debug("User with ID $id not found");
            $result = helper::getError(404, 'No user found with ID ' . $id);
        } else {
            $entity->delete();
            $result['data'] = true;
        }
        return $result;
    }

    function updateUser($id, $data)
    {
        $result = array();
        $this->logger->debug(" data: " . gettype($data) . " of $id");
        try {
            $user = UserQuery::create()->findOneById($id);
            $this->logger->debug(" object: " . get_class($user) . " of $id");
            if ($user == null) {
                $result = helper::getError(404, 'No user found with ID ' . $id);
            } else {
                $user->updateFromData($data);
                $user->save();
                $result['data'] = $user->toArray();
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return $result;
    }

    /**
     * @param $id
     * @return array
     * @throws \Propel\Runtime\Exception\PropelException
     */
    function getUserDeployments($id)
    {
        $user = UserQuery::create()->findOneById($id);
        if ($user == null) {
            $data = helper::getError(404, 'No user found with ID ' . $id);
        } else {
            $data = array();
            $deployments = array();
            foreach ($user->getDeployments() as $deployment)
                array_push($deployments, $deployment->toArray());
            $data['data'] = $deployments;
        }

        return $data;
    }

    /**
     * @param $id
     * @param $reference
     * @return array
     * @throws \Propel\Runtime\Exception\PropelException
     */
    function getUserDeployment($id, $reference)
    {
        $user = UserQuery::create()->findOneById($id);
        if ($user == null) {
            $data = helper::getError(404, 'No user found with ID ' . $id);
        } else {
            foreach ($user->getDeployments() as $deployment) {
                if ($deployment->getReference() === $reference) {
                    $data = array('data' => $deployment->toArray());
                    break;
                }
            }
            if (!isset($data))
                $data = helper::getError(404,
                    "No deployment '$reference' found related with the user $id");
        }
        return $data;
    }


    function createDeployment($userId, $deploymentData)
    {
        $this->logger->debug(" data: " . gettype($deploymentData));
        $data = array();
        try {
            $user = UserQuery::create()->findOneById($userId);
            $this->logger->debug(" object: " . get_class($user) . " of $userId");
            if ($user == null) {
                $data = helper::getError(404, 'No user found with ID ' . $userId);
            } else {
                $deployment = new Deployment($deploymentData);
                $deployment->setDeploymentUser($user);
                $deployment->save();
                $data['data'] = $deployment->toArray();
            }
        } catch (Exception $e) {
            $data = helper::getError(409, $e->getMessage());
        } finally {
            return $data;
        }
    }


    function updateDeployment($userId, $reference, $data)
    {
        $result = array();
        $this->logger->debug(" data: " . gettype($data) . " of $userId");
        try {
            $deployment = DeploymentQuery::create()->findOneByArray(array("user" => $userId, "reference" => $reference));
            $this->logger->debug(" object: " . get_class($deployment) . " of $userId");
            if ($deployment == null) {
                $user = UserQuery::create()->findOneById($userId);
                $this->logger->debug(" object: " . get_class($user) . " of $userId");
                if ($user == null) {
                    $result = helper::getError(404, 'No user found with ID ' . $userId);
                } else {
                    $deployment = new Deployment($data);
                    $deployment->setDeploymentUser($user);
                    $deployment->save();
                    $result['data'] = $deployment->toArray();
                }
            } else {
                $deployment->updateTimesFromData($data);
                $deployment->save();
                $result['data'] = $deployment->toArray();
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return $result;
    }


    function deleteDeployment($id, $reference)
    {
        $result = array();
        $this->logger->debug("ID of the deployment to delete: $id");
        $entity = DeploymentQuery::create()->findOneByArray(array("user" => $id, "reference" => $reference));
        if ($entity == null) {
            $this->logger->debug("Deployment with ID $id not found");
            $result = helper::getError(404, 'No deployment found with ID ' . $id);
        } else {
            $entity->delete();
            $result['data'] = true;
        }
        return $result;
    }

}