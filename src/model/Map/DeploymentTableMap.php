<?php

namespace Map;

use \Deployment;
use \DeploymentQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'deployment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DeploymentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.DeploymentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'phenomenal';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'deployment';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Deployment';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Deployment';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'deployment.id';

    /**
     * the column name for the user field
     */
    const COL_USER = 'deployment.user';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'deployment.name';

    /**
     * the column name for the reference field
     */
    const COL_REFERENCE = 'deployment.reference';

    /**
     * the column name for the provider field
     */
    const COL_PROVIDER = 'deployment.provider';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'deployment.created';

    /**
     * the column name for the deployed field
     */
    const COL_DEPLOYED = 'deployment.deployed';

    /**
     * the column name for the destroyed field
     */
    const COL_DESTROYED = 'deployment.destroyed';

    /**
     * the column name for the failed field
     */
    const COL_FAILED = 'deployment.failed';

    /**
     * the column name for the configuration field
     */
    const COL_CONFIGURATION = 'deployment.configuration';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'User', 'name', 'Reference', 'Provider', 'Created', 'Deployed', 'Destroyed', 'Failed', 'Configuration', ),
        self::TYPE_CAMELNAME     => array('id', 'user', 'name', 'reference', 'provider', 'created', 'deployed', 'destroyed', 'failed', 'configuration', ),
        self::TYPE_COLNAME       => array(DeploymentTableMap::COL_ID, DeploymentTableMap::COL_USER, DeploymentTableMap::COL_NAME, DeploymentTableMap::COL_REFERENCE, DeploymentTableMap::COL_PROVIDER, DeploymentTableMap::COL_CREATED, DeploymentTableMap::COL_DEPLOYED, DeploymentTableMap::COL_DESTROYED, DeploymentTableMap::COL_FAILED, DeploymentTableMap::COL_CONFIGURATION, ),
        self::TYPE_FIELDNAME     => array('id', 'user', 'name', 'reference', 'provider', 'created', 'deployed', 'destroyed', 'failed', 'configuration', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'User' => 1, 'name' => 2, 'Reference' => 3, 'Provider' => 4, 'Created' => 5, 'Deployed' => 6, 'Destroyed' => 7, 'Failed' => 8, 'Configuration' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'user' => 1, 'name' => 2, 'reference' => 3, 'provider' => 4, 'created' => 5, 'deployed' => 6, 'destroyed' => 7, 'failed' => 8, 'configuration' => 9, ),
        self::TYPE_COLNAME       => array(DeploymentTableMap::COL_ID => 0, DeploymentTableMap::COL_USER => 1, DeploymentTableMap::COL_NAME => 2, DeploymentTableMap::COL_REFERENCE => 3, DeploymentTableMap::COL_PROVIDER => 4, DeploymentTableMap::COL_CREATED => 5, DeploymentTableMap::COL_DEPLOYED => 6, DeploymentTableMap::COL_DESTROYED => 7, DeploymentTableMap::COL_FAILED => 8, DeploymentTableMap::COL_CONFIGURATION => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'user' => 1, 'name' => 2, 'reference' => 3, 'provider' => 4, 'created' => 5, 'deployed' => 6, 'destroyed' => 7, 'failed' => 8, 'configuration' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('deployment');
        $this->setPhpName('Deployment');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Deployment');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user', 'User', 'VARCHAR', 'user', 'id', true, 300, null);
        $this->addColumn('name', 'name', 'VARCHAR', true, 300, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 300, null);
        $this->addColumn('provider', 'Provider', 'VARCHAR', true, 300, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', false, null, null);
        $this->addColumn('deployed', 'Deployed', 'TIMESTAMP', false, null, null);
        $this->addColumn('destroyed', 'Destroyed', 'TIMESTAMP', false, null, null);
        $this->addColumn('failed', 'Failed', 'TIMESTAMP', false, null, null);
        $this->addColumn('configuration', 'Configuration', 'CLOB', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DeploymentUser', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user',
    1 => ':id',
  ),
), 'RESTRICT', null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? DeploymentTableMap::CLASS_DEFAULT : DeploymentTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Deployment object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DeploymentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DeploymentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DeploymentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DeploymentTableMap::OM_CLASS;
            /** @var Deployment $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DeploymentTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DeploymentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DeploymentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Deployment $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DeploymentTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DeploymentTableMap::COL_ID);
            $criteria->addSelectColumn(DeploymentTableMap::COL_USER);
            $criteria->addSelectColumn(DeploymentTableMap::COL_NAME);
            $criteria->addSelectColumn(DeploymentTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(DeploymentTableMap::COL_PROVIDER);
            $criteria->addSelectColumn(DeploymentTableMap::COL_CREATED);
            $criteria->addSelectColumn(DeploymentTableMap::COL_DEPLOYED);
            $criteria->addSelectColumn(DeploymentTableMap::COL_DESTROYED);
            $criteria->addSelectColumn(DeploymentTableMap::COL_FAILED);
            $criteria->addSelectColumn(DeploymentTableMap::COL_CONFIGURATION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.reference');
            $criteria->addSelectColumn($alias . '.provider');
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.deployed');
            $criteria->addSelectColumn($alias . '.destroyed');
            $criteria->addSelectColumn($alias . '.failed');
            $criteria->addSelectColumn($alias . '.configuration');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DeploymentTableMap::DATABASE_NAME)->getTable(DeploymentTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DeploymentTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DeploymentTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DeploymentTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Deployment or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Deployment object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Deployment) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DeploymentTableMap::DATABASE_NAME);
            $criteria->add(DeploymentTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DeploymentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DeploymentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DeploymentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the deployment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DeploymentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Deployment or Criteria object.
     *
     * @param mixed               $criteria Criteria or Deployment object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Deployment object
        }

        if ($criteria->containsKey(DeploymentTableMap::COL_ID) && $criteria->keyContainsValue(DeploymentTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DeploymentTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DeploymentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DeploymentTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DeploymentTableMap::buildTableMap();
