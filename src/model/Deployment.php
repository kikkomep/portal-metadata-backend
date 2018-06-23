<?php

use Base\Deployment as BaseDeployment;

/**
 * Skeleton subclass for representing a row from the 'deployment' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Deployment extends BaseDeployment
{
    private static $REQUIRED_PROPERTIES = ["name", "reference", "provider", "configuration"];
    private static $MUTABLE_PROPERTIES = ["created", "deployed", "destroyed", "failed"];

    public function __construct($data = null)
    {
        $this->updateTimesFromData($data);
        if (isset($data)) {
            foreach (Deployment::$REQUIRED_PROPERTIES as $property) {
                if (isset($data[$property])) {
                    $this->{"set" . ucfirst($property)}($data[$property]);
                }
            }
        }
    }

    public function setConfiguration($v)
    {
        if(is_object($v) || is_array($v))
            $v = json_encode($v);
        return parent::setConfiguration($v); // TODO: Change the autogenerated stub
    }


    public function updateTimesFromData($data)
    {
        if (isset($data)) {
            foreach (Deployment::$MUTABLE_PROPERTIES as $property) {
                if (isset($data[$property])) {
                    $this->{"set" . ucfirst($property)}($data[$property]);
                }
            }
        }
    }

}
