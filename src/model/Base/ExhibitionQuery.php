<?php

namespace Base;

use \Exhibition as ChildExhibition;
use \ExhibitionQuery as ChildExhibitionQuery;
use \Exception;
use \PDO;
use Map\ExhibitionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Exhibition' table.
 *
 *
 *
 * @method     ChildExhibitionQuery orderByExid($order = Criteria::ASC) Order by the EXid column
 * @method     ChildExhibitionQuery orderByExhibitionname($order = Criteria::ASC) Order by the ExhibitionName column
 * @method     ChildExhibitionQuery orderByObjecttitle($order = Criteria::ASC) Order by the ObjectTitle column
 * @method     ChildExhibitionQuery orderByCulturalgroup($order = Criteria::ASC) Order by the CulturalGroup column
 *
 * @method     ChildExhibitionQuery groupByExid() Group by the EXid column
 * @method     ChildExhibitionQuery groupByExhibitionname() Group by the ExhibitionName column
 * @method     ChildExhibitionQuery groupByObjecttitle() Group by the ObjectTitle column
 * @method     ChildExhibitionQuery groupByCulturalgroup() Group by the CulturalGroup column
 *
 * @method     ChildExhibitionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExhibitionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExhibitionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExhibitionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExhibitionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExhibitionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExhibitionQuery leftJoinCulturalobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildExhibitionQuery rightJoinCulturalobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildExhibitionQuery innerJoinCulturalobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Culturalobjects relation
 *
 * @method     ChildExhibitionQuery joinWithCulturalobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Culturalobjects relation
 *
 * @method     ChildExhibitionQuery leftJoinWithCulturalobjects() Adds a LEFT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildExhibitionQuery rightJoinWithCulturalobjects() Adds a RIGHT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildExhibitionQuery innerJoinWithCulturalobjects() Adds a INNER JOIN clause and with to the query using the Culturalobjects relation
 *
 * @method     \CulturalobjectsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExhibition findOne(ConnectionInterface $con = null) Return the first ChildExhibition matching the query
 * @method     ChildExhibition findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExhibition matching the query, or a new ChildExhibition object populated from the query conditions when no match is found
 *
 * @method     ChildExhibition findOneByExid(int $EXid) Return the first ChildExhibition filtered by the EXid column
 * @method     ChildExhibition findOneByExhibitionname(string $ExhibitionName) Return the first ChildExhibition filtered by the ExhibitionName column
 * @method     ChildExhibition findOneByObjecttitle(string $ObjectTitle) Return the first ChildExhibition filtered by the ObjectTitle column
 * @method     ChildExhibition findOneByCulturalgroup(string $CulturalGroup) Return the first ChildExhibition filtered by the CulturalGroup column *

 * @method     ChildExhibition requirePk($key, ConnectionInterface $con = null) Return the ChildExhibition by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExhibition requireOne(ConnectionInterface $con = null) Return the first ChildExhibition matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExhibition requireOneByExid(int $EXid) Return the first ChildExhibition filtered by the EXid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExhibition requireOneByExhibitionname(string $ExhibitionName) Return the first ChildExhibition filtered by the ExhibitionName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExhibition requireOneByObjecttitle(string $ObjectTitle) Return the first ChildExhibition filtered by the ObjectTitle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExhibition requireOneByCulturalgroup(string $CulturalGroup) Return the first ChildExhibition filtered by the CulturalGroup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExhibition[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExhibition objects based on current ModelCriteria
 * @method     ChildExhibition[]|ObjectCollection findByExid(int $EXid) Return ChildExhibition objects filtered by the EXid column
 * @method     ChildExhibition[]|ObjectCollection findByExhibitionname(string $ExhibitionName) Return ChildExhibition objects filtered by the ExhibitionName column
 * @method     ChildExhibition[]|ObjectCollection findByObjecttitle(string $ObjectTitle) Return ChildExhibition objects filtered by the ObjectTitle column
 * @method     ChildExhibition[]|ObjectCollection findByCulturalgroup(string $CulturalGroup) Return ChildExhibition objects filtered by the CulturalGroup column
 * @method     ChildExhibition[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExhibitionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ExhibitionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sierraleonedb', $modelName = '\\Exhibition', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExhibitionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExhibitionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExhibitionQuery) {
            return $criteria;
        }
        $query = new ChildExhibitionQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildExhibition|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExhibitionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExhibitionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExhibition A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT EXid, ExhibitionName, ObjectTitle, CulturalGroup FROM Exhibition WHERE EXid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildExhibition $obj */
            $obj = new ChildExhibition();
            $obj->hydrate($row);
            ExhibitionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildExhibition|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the EXid column
     *
     * Example usage:
     * <code>
     * $query->filterByExid(1234); // WHERE EXid = 1234
     * $query->filterByExid(array(12, 34)); // WHERE EXid IN (12, 34)
     * $query->filterByExid(array('min' => 12)); // WHERE EXid > 12
     * </code>
     *
     * @param     mixed $exid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByExid($exid = null, $comparison = null)
    {
        if (is_array($exid)) {
            $useMinMax = false;
            if (isset($exid['min'])) {
                $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $exid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exid['max'])) {
                $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $exid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $exid, $comparison);
    }

    /**
     * Filter the query on the ExhibitionName column
     *
     * Example usage:
     * <code>
     * $query->filterByExhibitionname('fooValue');   // WHERE ExhibitionName = 'fooValue'
     * $query->filterByExhibitionname('%fooValue%', Criteria::LIKE); // WHERE ExhibitionName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $exhibitionname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByExhibitionname($exhibitionname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exhibitionname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExhibitionTableMap::COL_EXHIBITIONNAME, $exhibitionname, $comparison);
    }

    /**
     * Filter the query on the ObjectTitle column
     *
     * Example usage:
     * <code>
     * $query->filterByObjecttitle('fooValue');   // WHERE ObjectTitle = 'fooValue'
     * $query->filterByObjecttitle('%fooValue%', Criteria::LIKE); // WHERE ObjectTitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objecttitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByObjecttitle($objecttitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objecttitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExhibitionTableMap::COL_OBJECTTITLE, $objecttitle, $comparison);
    }

    /**
     * Filter the query on the CulturalGroup column
     *
     * Example usage:
     * <code>
     * $query->filterByCulturalgroup('fooValue');   // WHERE CulturalGroup = 'fooValue'
     * $query->filterByCulturalgroup('%fooValue%', Criteria::LIKE); // WHERE CulturalGroup LIKE '%fooValue%'
     * </code>
     *
     * @param     string $culturalgroup The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByCulturalgroup($culturalgroup = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($culturalgroup)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExhibitionTableMap::COL_CULTURALGROUP, $culturalgroup, $comparison);
    }

    /**
     * Filter the query by a related \Culturalobjects object
     *
     * @param \Culturalobjects|ObjectCollection $culturalobjects the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildExhibitionQuery The current query, for fluid interface
     */
    public function filterByCulturalobjects($culturalobjects, $comparison = null)
    {
        if ($culturalobjects instanceof \Culturalobjects) {
            return $this
                ->addUsingAlias(ExhibitionTableMap::COL_EXID, $culturalobjects->getFkExid(), $comparison);
        } elseif ($culturalobjects instanceof ObjectCollection) {
            return $this
                ->useCulturalobjectsQuery()
                ->filterByPrimaryKeys($culturalobjects->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCulturalobjects() only accepts arguments of type \Culturalobjects or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Culturalobjects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function joinCulturalobjects($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Culturalobjects');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Culturalobjects');
        }

        return $this;
    }

    /**
     * Use the Culturalobjects relation Culturalobjects object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CulturalobjectsQuery A secondary query class using the current class as primary query
     */
    public function useCulturalobjectsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCulturalobjects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Culturalobjects', '\CulturalobjectsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildExhibition $exhibition Object to remove from the list of results
     *
     * @return $this|ChildExhibitionQuery The current query, for fluid interface
     */
    public function prune($exhibition = null)
    {
        if ($exhibition) {
            $this->addUsingAlias(ExhibitionTableMap::COL_EXID, $exhibition->getExid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Exhibition table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExhibitionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExhibitionTableMap::clearInstancePool();
            ExhibitionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExhibitionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExhibitionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExhibitionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExhibitionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExhibitionQuery
