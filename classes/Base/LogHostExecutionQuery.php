<?php

namespace Base;

use \LogHostExecution as ChildLogHostExecution;
use \LogHostExecutionQuery as ChildLogHostExecutionQuery;
use \Exception;
use \PDO;
use Map\LogHostExecutionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_host_execution' table.
 *
 *
 *
 * @method     ChildLogHostExecutionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogHostExecutionQuery orderByLogtime($order = Criteria::ASC) Order by the logtime column
 * @method     ChildLogHostExecutionQuery orderByHostScheduleId($order = Criteria::ASC) Order by the host_schedule_id column
 * @method     ChildLogHostExecutionQuery orderByDetails($order = Criteria::ASC) Order by the details column
 * @method     ChildLogHostExecutionQuery orderByPushPop($order = Criteria::ASC) Order by the push_pop column
 *
 * @method     ChildLogHostExecutionQuery groupById() Group by the id column
 * @method     ChildLogHostExecutionQuery groupByLogtime() Group by the logtime column
 * @method     ChildLogHostExecutionQuery groupByHostScheduleId() Group by the host_schedule_id column
 * @method     ChildLogHostExecutionQuery groupByDetails() Group by the details column
 * @method     ChildLogHostExecutionQuery groupByPushPop() Group by the push_pop column
 *
 * @method     ChildLogHostExecutionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogHostExecutionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogHostExecutionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogHostExecutionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogHostExecutionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogHostExecutionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogHostExecutionQuery leftJoinHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostSchedule relation
 * @method     ChildLogHostExecutionQuery rightJoinHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostSchedule relation
 * @method     ChildLogHostExecutionQuery innerJoinHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the HostSchedule relation
 *
 * @method     ChildLogHostExecutionQuery joinWithHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostSchedule relation
 *
 * @method     ChildLogHostExecutionQuery leftJoinWithHostSchedule() Adds a LEFT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildLogHostExecutionQuery rightJoinWithHostSchedule() Adds a RIGHT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildLogHostExecutionQuery innerJoinWithHostSchedule() Adds a INNER JOIN clause and with to the query using the HostSchedule relation
 *
 * @method     \HostScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogHostExecution|null findOne(ConnectionInterface $con = null) Return the first ChildLogHostExecution matching the query
 * @method     ChildLogHostExecution findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogHostExecution matching the query, or a new ChildLogHostExecution object populated from the query conditions when no match is found
 *
 * @method     ChildLogHostExecution|null findOneById(int $id) Return the first ChildLogHostExecution filtered by the id column
 * @method     ChildLogHostExecution|null findOneByLogtime(string $logtime) Return the first ChildLogHostExecution filtered by the logtime column
 * @method     ChildLogHostExecution|null findOneByHostScheduleId(int $host_schedule_id) Return the first ChildLogHostExecution filtered by the host_schedule_id column
 * @method     ChildLogHostExecution|null findOneByDetails(string $details) Return the first ChildLogHostExecution filtered by the details column
 * @method     ChildLogHostExecution|null findOneByPushPop(string $push_pop) Return the first ChildLogHostExecution filtered by the push_pop column *

 * @method     ChildLogHostExecution requirePk($key, ConnectionInterface $con = null) Return the ChildLogHostExecution by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogHostExecution requireOne(ConnectionInterface $con = null) Return the first ChildLogHostExecution matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogHostExecution requireOneById(int $id) Return the first ChildLogHostExecution filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogHostExecution requireOneByLogtime(string $logtime) Return the first ChildLogHostExecution filtered by the logtime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogHostExecution requireOneByHostScheduleId(int $host_schedule_id) Return the first ChildLogHostExecution filtered by the host_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogHostExecution requireOneByDetails(string $details) Return the first ChildLogHostExecution filtered by the details column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogHostExecution requireOneByPushPop(string $push_pop) Return the first ChildLogHostExecution filtered by the push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogHostExecution[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogHostExecution objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> find(ConnectionInterface $con = null) Return ChildLogHostExecution objects based on current ModelCriteria
 * @method     ChildLogHostExecution[]|ObjectCollection findById(int $id) Return ChildLogHostExecution objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> findById(int $id) Return ChildLogHostExecution objects filtered by the id column
 * @method     ChildLogHostExecution[]|ObjectCollection findByLogtime(string $logtime) Return ChildLogHostExecution objects filtered by the logtime column
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> findByLogtime(string $logtime) Return ChildLogHostExecution objects filtered by the logtime column
 * @method     ChildLogHostExecution[]|ObjectCollection findByHostScheduleId(int $host_schedule_id) Return ChildLogHostExecution objects filtered by the host_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> findByHostScheduleId(int $host_schedule_id) Return ChildLogHostExecution objects filtered by the host_schedule_id column
 * @method     ChildLogHostExecution[]|ObjectCollection findByDetails(string $details) Return ChildLogHostExecution objects filtered by the details column
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> findByDetails(string $details) Return ChildLogHostExecution objects filtered by the details column
 * @method     ChildLogHostExecution[]|ObjectCollection findByPushPop(string $push_pop) Return ChildLogHostExecution objects filtered by the push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogHostExecution> findByPushPop(string $push_pop) Return ChildLogHostExecution objects filtered by the push_pop column
 * @method     ChildLogHostExecution[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogHostExecution> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogHostExecutionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogHostExecutionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogHostExecution', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogHostExecutionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogHostExecutionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogHostExecutionQuery) {
            return $criteria;
        }
        $query = new ChildLogHostExecutionQuery();
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
     * @return ChildLogHostExecution|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogHostExecutionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogHostExecutionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogHostExecution A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, logtime, host_schedule_id, details, push_pop FROM log_host_execution WHERE id = :p0';
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
            /** @var ChildLogHostExecution $obj */
            $obj = new ChildLogHostExecution();
            $obj->hydrate($row);
            LogHostExecutionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogHostExecution|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the logtime column
     *
     * Example usage:
     * <code>
     * $query->filterByLogtime('fooValue');   // WHERE logtime = 'fooValue'
     * $query->filterByLogtime('%fooValue%', Criteria::LIKE); // WHERE logtime LIKE '%fooValue%'
     * $query->filterByLogtime(['foo', 'bar']); // WHERE logtime IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $logtime The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByLogtime($logtime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logtime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_LOGTIME, $logtime, $comparison);
    }

    /**
     * Filter the query on the host_schedule_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHostScheduleId(1234); // WHERE host_schedule_id = 1234
     * $query->filterByHostScheduleId(array(12, 34)); // WHERE host_schedule_id IN (12, 34)
     * $query->filterByHostScheduleId(array('min' => 12)); // WHERE host_schedule_id > 12
     * </code>
     *
     * @see       filterByHostSchedule()
     *
     * @param     mixed $hostScheduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByHostScheduleId($hostScheduleId = null, $comparison = null)
    {
        if (is_array($hostScheduleId)) {
            $useMinMax = false;
            if (isset($hostScheduleId['min'])) {
                $this->addUsingAlias(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hostScheduleId['max'])) {
                $this->addUsingAlias(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId, $comparison);
    }

    /**
     * Filter the query on the details column
     *
     * Example usage:
     * <code>
     * $query->filterByDetails('fooValue');   // WHERE details = 'fooValue'
     * $query->filterByDetails('%fooValue%', Criteria::LIKE); // WHERE details LIKE '%fooValue%'
     * $query->filterByDetails(['foo', 'bar']); // WHERE details IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $details The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByDetails($details = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($details)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_DETAILS, $details, $comparison);
    }

    /**
     * Filter the query on the push_pop column
     *
     * Example usage:
     * <code>
     * $query->filterByPushPop('fooValue');   // WHERE push_pop = 'fooValue'
     * $query->filterByPushPop('%fooValue%', Criteria::LIKE); // WHERE push_pop LIKE '%fooValue%'
     * $query->filterByPushPop(['foo', 'bar']); // WHERE push_pop IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $pushPop The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByPushPop($pushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogHostExecutionTableMap::COL_PUSH_POP, $pushPop, $comparison);
    }

    /**
     * Filter the query by a related \HostSchedule object
     *
     * @param \HostSchedule|ObjectCollection $hostSchedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function filterByHostSchedule($hostSchedule, $comparison = null)
    {
        if ($hostSchedule instanceof \HostSchedule) {
            return $this
                ->addUsingAlias(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, $hostSchedule->getId(), $comparison);
        } elseif ($hostSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, $hostSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHostSchedule() only accepts arguments of type \HostSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HostSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function joinHostSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HostSchedule');

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
            $this->addJoinObject($join, 'HostSchedule');
        }

        return $this;
    }

    /**
     * Use the HostSchedule relation HostSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HostScheduleQuery A secondary query class using the current class as primary query
     */
    public function useHostScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHostSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HostSchedule', '\HostScheduleQuery');
    }

    /**
     * Use the HostSchedule relation HostSchedule object
     *
     * @param callable(\HostScheduleQuery):\HostScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHostScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHostScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to HostSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \HostScheduleQuery The inner query object of the EXISTS statement
     */
    public function useHostScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('HostSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to HostSchedule table for a NOT EXISTS query.
     *
     * @see useHostScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \HostScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useHostScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('HostSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildLogHostExecution $logHostExecution Object to remove from the list of results
     *
     * @return $this|ChildLogHostExecutionQuery The current query, for fluid interface
     */
    public function prune($logHostExecution = null)
    {
        if ($logHostExecution) {
            $this->addUsingAlias(LogHostExecutionTableMap::COL_ID, $logHostExecution->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_host_execution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogHostExecutionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogHostExecutionTableMap::clearInstancePool();
            LogHostExecutionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogHostExecutionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogHostExecutionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogHostExecutionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogHostExecutionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogHostExecutionQuery
