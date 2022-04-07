<?php

namespace Base;

use \LogEditHostSchedule as ChildLogEditHostSchedule;
use \LogEditHostScheduleQuery as ChildLogEditHostScheduleQuery;
use \Exception;
use \PDO;
use Map\LogEditHostScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_edit_host_schedule' table.
 *
 *
 *
 * @method     ChildLogEditHostScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogEditHostScheduleQuery orderByHostScheduleId($order = Criteria::ASC) Order by the host_schedule_id column
 * @method     ChildLogEditHostScheduleQuery orderByOldHostId($order = Criteria::ASC) Order by the old_host_id column
 * @method     ChildLogEditHostScheduleQuery orderByNewHostId($order = Criteria::ASC) Order by the new_host_id column
 * @method     ChildLogEditHostScheduleQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 * @method     ChildLogEditHostScheduleQuery orderByOldDataFrom($order = Criteria::ASC) Order by the old_data_from column
 * @method     ChildLogEditHostScheduleQuery orderByNewDateFrom($order = Criteria::ASC) Order by the new_date_from column
 * @method     ChildLogEditHostScheduleQuery orderByOldDateUntil($order = Criteria::ASC) Order by the old_date_until column
 * @method     ChildLogEditHostScheduleQuery orderByNewDateUntil($order = Criteria::ASC) Order by the new_date_until column
 * @method     ChildLogEditHostScheduleQuery orderByOldPushPop($order = Criteria::ASC) Order by the old_push_pop column
 * @method     ChildLogEditHostScheduleQuery orderByNewPushPop($order = Criteria::ASC) Order by the new_push_pop column
 *
 * @method     ChildLogEditHostScheduleQuery groupById() Group by the id column
 * @method     ChildLogEditHostScheduleQuery groupByHostScheduleId() Group by the host_schedule_id column
 * @method     ChildLogEditHostScheduleQuery groupByOldHostId() Group by the old_host_id column
 * @method     ChildLogEditHostScheduleQuery groupByNewHostId() Group by the new_host_id column
 * @method     ChildLogEditHostScheduleQuery groupByLogId() Group by the log_id column
 * @method     ChildLogEditHostScheduleQuery groupByOldDataFrom() Group by the old_data_from column
 * @method     ChildLogEditHostScheduleQuery groupByNewDateFrom() Group by the new_date_from column
 * @method     ChildLogEditHostScheduleQuery groupByOldDateUntil() Group by the old_date_until column
 * @method     ChildLogEditHostScheduleQuery groupByNewDateUntil() Group by the new_date_until column
 * @method     ChildLogEditHostScheduleQuery groupByOldPushPop() Group by the old_push_pop column
 * @method     ChildLogEditHostScheduleQuery groupByNewPushPop() Group by the new_push_pop column
 *
 * @method     ChildLogEditHostScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogEditHostScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogEditHostScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogEditHostScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogEditHostScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostSchedule relation
 * @method     ChildLogEditHostScheduleQuery rightJoinHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostSchedule relation
 * @method     ChildLogEditHostScheduleQuery innerJoinHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the HostSchedule relation
 *
 * @method     ChildLogEditHostScheduleQuery joinWithHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostSchedule relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinWithHostSchedule() Adds a LEFT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildLogEditHostScheduleQuery rightJoinWithHostSchedule() Adds a RIGHT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildLogEditHostScheduleQuery innerJoinWithHostSchedule() Adds a INNER JOIN clause and with to the query using the HostSchedule relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Log relation
 * @method     ChildLogEditHostScheduleQuery rightJoinLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Log relation
 * @method     ChildLogEditHostScheduleQuery innerJoinLog($relationAlias = null) Adds a INNER JOIN clause to the query using the Log relation
 *
 * @method     ChildLogEditHostScheduleQuery joinWithLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Log relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinWithLog() Adds a LEFT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditHostScheduleQuery rightJoinWithLog() Adds a RIGHT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditHostScheduleQuery innerJoinWithLog() Adds a INNER JOIN clause and with to the query using the Log relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinHostRelatedByNewHostId($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostRelatedByNewHostId relation
 * @method     ChildLogEditHostScheduleQuery rightJoinHostRelatedByNewHostId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostRelatedByNewHostId relation
 * @method     ChildLogEditHostScheduleQuery innerJoinHostRelatedByNewHostId($relationAlias = null) Adds a INNER JOIN clause to the query using the HostRelatedByNewHostId relation
 *
 * @method     ChildLogEditHostScheduleQuery joinWithHostRelatedByNewHostId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostRelatedByNewHostId relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinWithHostRelatedByNewHostId() Adds a LEFT JOIN clause and with to the query using the HostRelatedByNewHostId relation
 * @method     ChildLogEditHostScheduleQuery rightJoinWithHostRelatedByNewHostId() Adds a RIGHT JOIN clause and with to the query using the HostRelatedByNewHostId relation
 * @method     ChildLogEditHostScheduleQuery innerJoinWithHostRelatedByNewHostId() Adds a INNER JOIN clause and with to the query using the HostRelatedByNewHostId relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinHostRelatedByOldHostId($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostRelatedByOldHostId relation
 * @method     ChildLogEditHostScheduleQuery rightJoinHostRelatedByOldHostId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostRelatedByOldHostId relation
 * @method     ChildLogEditHostScheduleQuery innerJoinHostRelatedByOldHostId($relationAlias = null) Adds a INNER JOIN clause to the query using the HostRelatedByOldHostId relation
 *
 * @method     ChildLogEditHostScheduleQuery joinWithHostRelatedByOldHostId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostRelatedByOldHostId relation
 *
 * @method     ChildLogEditHostScheduleQuery leftJoinWithHostRelatedByOldHostId() Adds a LEFT JOIN clause and with to the query using the HostRelatedByOldHostId relation
 * @method     ChildLogEditHostScheduleQuery rightJoinWithHostRelatedByOldHostId() Adds a RIGHT JOIN clause and with to the query using the HostRelatedByOldHostId relation
 * @method     ChildLogEditHostScheduleQuery innerJoinWithHostRelatedByOldHostId() Adds a INNER JOIN clause and with to the query using the HostRelatedByOldHostId relation
 *
 * @method     \HostScheduleQuery|\LogQuery|\HostQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogEditHostSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildLogEditHostSchedule matching the query
 * @method     ChildLogEditHostSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogEditHostSchedule matching the query, or a new ChildLogEditHostSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildLogEditHostSchedule|null findOneById(int $id) Return the first ChildLogEditHostSchedule filtered by the id column
 * @method     ChildLogEditHostSchedule|null findOneByHostScheduleId(int $host_schedule_id) Return the first ChildLogEditHostSchedule filtered by the host_schedule_id column
 * @method     ChildLogEditHostSchedule|null findOneByOldHostId(int $old_host_id) Return the first ChildLogEditHostSchedule filtered by the old_host_id column
 * @method     ChildLogEditHostSchedule|null findOneByNewHostId(int $new_host_id) Return the first ChildLogEditHostSchedule filtered by the new_host_id column
 * @method     ChildLogEditHostSchedule|null findOneByLogId(int $log_id) Return the first ChildLogEditHostSchedule filtered by the log_id column
 * @method     ChildLogEditHostSchedule|null findOneByOldDataFrom(string $old_data_from) Return the first ChildLogEditHostSchedule filtered by the old_data_from column
 * @method     ChildLogEditHostSchedule|null findOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditHostSchedule filtered by the new_date_from column
 * @method     ChildLogEditHostSchedule|null findOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditHostSchedule filtered by the old_date_until column
 * @method     ChildLogEditHostSchedule|null findOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditHostSchedule filtered by the new_date_until column
 * @method     ChildLogEditHostSchedule|null findOneByOldPushPop(string $old_push_pop) Return the first ChildLogEditHostSchedule filtered by the old_push_pop column
 * @method     ChildLogEditHostSchedule|null findOneByNewPushPop(string $new_push_pop) Return the first ChildLogEditHostSchedule filtered by the new_push_pop column *

 * @method     ChildLogEditHostSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildLogEditHostSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOne(ConnectionInterface $con = null) Return the first ChildLogEditHostSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditHostSchedule requireOneById(int $id) Return the first ChildLogEditHostSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByHostScheduleId(int $host_schedule_id) Return the first ChildLogEditHostSchedule filtered by the host_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByOldHostId(int $old_host_id) Return the first ChildLogEditHostSchedule filtered by the old_host_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByNewHostId(int $new_host_id) Return the first ChildLogEditHostSchedule filtered by the new_host_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByLogId(int $log_id) Return the first ChildLogEditHostSchedule filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByOldDataFrom(string $old_data_from) Return the first ChildLogEditHostSchedule filtered by the old_data_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditHostSchedule filtered by the new_date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditHostSchedule filtered by the old_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditHostSchedule filtered by the new_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByOldPushPop(string $old_push_pop) Return the first ChildLogEditHostSchedule filtered by the old_push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditHostSchedule requireOneByNewPushPop(string $new_push_pop) Return the first ChildLogEditHostSchedule filtered by the new_push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditHostSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogEditHostSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> find(ConnectionInterface $con = null) Return ChildLogEditHostSchedule objects based on current ModelCriteria
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findById(int $id) Return ChildLogEditHostSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findById(int $id) Return ChildLogEditHostSchedule objects filtered by the id column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByHostScheduleId(int $host_schedule_id) Return ChildLogEditHostSchedule objects filtered by the host_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByHostScheduleId(int $host_schedule_id) Return ChildLogEditHostSchedule objects filtered by the host_schedule_id column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByOldHostId(int $old_host_id) Return ChildLogEditHostSchedule objects filtered by the old_host_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByOldHostId(int $old_host_id) Return ChildLogEditHostSchedule objects filtered by the old_host_id column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByNewHostId(int $new_host_id) Return ChildLogEditHostSchedule objects filtered by the new_host_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByNewHostId(int $new_host_id) Return ChildLogEditHostSchedule objects filtered by the new_host_id column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByLogId(int $log_id) Return ChildLogEditHostSchedule objects filtered by the log_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByLogId(int $log_id) Return ChildLogEditHostSchedule objects filtered by the log_id column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByOldDataFrom(string $old_data_from) Return ChildLogEditHostSchedule objects filtered by the old_data_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByOldDataFrom(string $old_data_from) Return ChildLogEditHostSchedule objects filtered by the old_data_from column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByNewDateFrom(string $new_date_from) Return ChildLogEditHostSchedule objects filtered by the new_date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByNewDateFrom(string $new_date_from) Return ChildLogEditHostSchedule objects filtered by the new_date_from column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByOldDateUntil(string $old_date_until) Return ChildLogEditHostSchedule objects filtered by the old_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByOldDateUntil(string $old_date_until) Return ChildLogEditHostSchedule objects filtered by the old_date_until column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByNewDateUntil(string $new_date_until) Return ChildLogEditHostSchedule objects filtered by the new_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByNewDateUntil(string $new_date_until) Return ChildLogEditHostSchedule objects filtered by the new_date_until column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByOldPushPop(string $old_push_pop) Return ChildLogEditHostSchedule objects filtered by the old_push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByOldPushPop(string $old_push_pop) Return ChildLogEditHostSchedule objects filtered by the old_push_pop column
 * @method     ChildLogEditHostSchedule[]|ObjectCollection findByNewPushPop(string $new_push_pop) Return ChildLogEditHostSchedule objects filtered by the new_push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditHostSchedule> findByNewPushPop(string $new_push_pop) Return ChildLogEditHostSchedule objects filtered by the new_push_pop column
 * @method     ChildLogEditHostSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogEditHostSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogEditHostScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogEditHostScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogEditHostSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogEditHostScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogEditHostScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogEditHostScheduleQuery) {
            return $criteria;
        }
        $query = new ChildLogEditHostScheduleQuery();
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
     * @return ChildLogEditHostSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogEditHostScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogEditHostScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogEditHostSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, host_schedule_id, old_host_id, new_host_id, log_id, old_data_from, new_date_from, old_date_until, new_date_until, old_push_pop, new_push_pop FROM log_edit_host_schedule WHERE id = :p0';
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
            /** @var ChildLogEditHostSchedule $obj */
            $obj = new ChildLogEditHostSchedule();
            $obj->hydrate($row);
            LogEditHostScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogEditHostSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHostScheduleId($hostScheduleId = null, $comparison = null)
    {
        if (is_array($hostScheduleId)) {
            $useMinMax = false;
            if (isset($hostScheduleId['min'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hostScheduleId['max'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, $hostScheduleId, $comparison);
    }

    /**
     * Filter the query on the old_host_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOldHostId(1234); // WHERE old_host_id = 1234
     * $query->filterByOldHostId(array(12, 34)); // WHERE old_host_id IN (12, 34)
     * $query->filterByOldHostId(array('min' => 12)); // WHERE old_host_id > 12
     * </code>
     *
     * @see       filterByHostRelatedByOldHostId()
     *
     * @param     mixed $oldHostId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByOldHostId($oldHostId = null, $comparison = null)
    {
        if (is_array($oldHostId)) {
            $useMinMax = false;
            if (isset($oldHostId['min'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_HOST_ID, $oldHostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oldHostId['max'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_HOST_ID, $oldHostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_HOST_ID, $oldHostId, $comparison);
    }

    /**
     * Filter the query on the new_host_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNewHostId(1234); // WHERE new_host_id = 1234
     * $query->filterByNewHostId(array(12, 34)); // WHERE new_host_id IN (12, 34)
     * $query->filterByNewHostId(array('min' => 12)); // WHERE new_host_id > 12
     * </code>
     *
     * @see       filterByHostRelatedByNewHostId()
     *
     * @param     mixed $newHostId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByNewHostId($newHostId = null, $comparison = null)
    {
        if (is_array($newHostId)) {
            $useMinMax = false;
            if (isset($newHostId['min'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_HOST_ID, $newHostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newHostId['max'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_HOST_ID, $newHostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_HOST_ID, $newHostId, $comparison);
    }

    /**
     * Filter the query on the log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLogId(1234); // WHERE log_id = 1234
     * $query->filterByLogId(array(12, 34)); // WHERE log_id IN (12, 34)
     * $query->filterByLogId(array('min' => 12)); // WHERE log_id > 12
     * </code>
     *
     * @see       filterByLog()
     *
     * @param     mixed $logId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByLogId($logId = null, $comparison = null)
    {
        if (is_array($logId)) {
            $useMinMax = false;
            if (isset($logId['min'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(LogEditHostScheduleTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_LOG_ID, $logId, $comparison);
    }

    /**
     * Filter the query on the old_data_from column
     *
     * Example usage:
     * <code>
     * $query->filterByOldDataFrom('fooValue');   // WHERE old_data_from = 'fooValue'
     * $query->filterByOldDataFrom('%fooValue%', Criteria::LIKE); // WHERE old_data_from LIKE '%fooValue%'
     * $query->filterByOldDataFrom(['foo', 'bar']); // WHERE old_data_from IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldDataFrom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDataFrom($oldDataFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDataFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_DATA_FROM, $oldDataFrom, $comparison);
    }

    /**
     * Filter the query on the new_date_from column
     *
     * Example usage:
     * <code>
     * $query->filterByNewDateFrom('fooValue');   // WHERE new_date_from = 'fooValue'
     * $query->filterByNewDateFrom('%fooValue%', Criteria::LIKE); // WHERE new_date_from LIKE '%fooValue%'
     * $query->filterByNewDateFrom(['foo', 'bar']); // WHERE new_date_from IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newDateFrom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateFrom($newDateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_DATE_FROM, $newDateFrom, $comparison);
    }

    /**
     * Filter the query on the old_date_until column
     *
     * Example usage:
     * <code>
     * $query->filterByOldDateUntil('fooValue');   // WHERE old_date_until = 'fooValue'
     * $query->filterByOldDateUntil('%fooValue%', Criteria::LIKE); // WHERE old_date_until LIKE '%fooValue%'
     * $query->filterByOldDateUntil(['foo', 'bar']); // WHERE old_date_until IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldDateUntil The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDateUntil($oldDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL, $oldDateUntil, $comparison);
    }

    /**
     * Filter the query on the new_date_until column
     *
     * Example usage:
     * <code>
     * $query->filterByNewDateUntil('fooValue');   // WHERE new_date_until = 'fooValue'
     * $query->filterByNewDateUntil('%fooValue%', Criteria::LIKE); // WHERE new_date_until LIKE '%fooValue%'
     * $query->filterByNewDateUntil(['foo', 'bar']); // WHERE new_date_until IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newDateUntil The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateUntil($newDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL, $newDateUntil, $comparison);
    }

    /**
     * Filter the query on the old_push_pop column
     *
     * Example usage:
     * <code>
     * $query->filterByOldPushPop('fooValue');   // WHERE old_push_pop = 'fooValue'
     * $query->filterByOldPushPop('%fooValue%', Criteria::LIKE); // WHERE old_push_pop LIKE '%fooValue%'
     * $query->filterByOldPushPop(['foo', 'bar']); // WHERE old_push_pop IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldPushPop The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByOldPushPop($oldPushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldPushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_PUSH_POP, $oldPushPop, $comparison);
    }

    /**
     * Filter the query on the new_push_pop column
     *
     * Example usage:
     * <code>
     * $query->filterByNewPushPop('fooValue');   // WHERE new_push_pop = 'fooValue'
     * $query->filterByNewPushPop('%fooValue%', Criteria::LIKE); // WHERE new_push_pop LIKE '%fooValue%'
     * $query->filterByNewPushPop(['foo', 'bar']); // WHERE new_push_pop IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newPushPop The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByNewPushPop($newPushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newPushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_PUSH_POP, $newPushPop, $comparison);
    }

    /**
     * Filter the query by a related \HostSchedule object
     *
     * @param \HostSchedule|ObjectCollection $hostSchedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHostSchedule($hostSchedule, $comparison = null)
    {
        if ($hostSchedule instanceof \HostSchedule) {
            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, $hostSchedule->getId(), $comparison);
        } elseif ($hostSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, $hostSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \Log object
     *
     * @param \Log|ObjectCollection $log The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByLog($log, $comparison = null)
    {
        if ($log instanceof \Log) {
            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_LOG_ID, $log->getId(), $comparison);
        } elseif ($log instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_LOG_ID, $log->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLog() only accepts arguments of type \Log or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Log relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function joinLog($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Log');

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
            $this->addJoinObject($join, 'Log');
        }

        return $this;
    }

    /**
     * Use the Log relation Log object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogQuery A secondary query class using the current class as primary query
     */
    public function useLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Log', '\LogQuery');
    }

    /**
     * Use the Log relation Log object
     *
     * @param callable(\LogQuery):\LogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Log table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogQuery The inner query object of the EXISTS statement
     */
    public function useLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Log', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Log table for a NOT EXISTS query.
     *
     * @see useLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Log', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Host object
     *
     * @param \Host|ObjectCollection $host The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHostRelatedByNewHostId($host, $comparison = null)
    {
        if ($host instanceof \Host) {
            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_HOST_ID, $host->getId(), $comparison);
        } elseif ($host instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_NEW_HOST_ID, $host->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHostRelatedByNewHostId() only accepts arguments of type \Host or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HostRelatedByNewHostId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function joinHostRelatedByNewHostId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HostRelatedByNewHostId');

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
            $this->addJoinObject($join, 'HostRelatedByNewHostId');
        }

        return $this;
    }

    /**
     * Use the HostRelatedByNewHostId relation Host object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HostQuery A secondary query class using the current class as primary query
     */
    public function useHostRelatedByNewHostIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHostRelatedByNewHostId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HostRelatedByNewHostId', '\HostQuery');
    }

    /**
     * Use the HostRelatedByNewHostId relation Host object
     *
     * @param callable(\HostQuery):\HostQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHostRelatedByNewHostIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHostRelatedByNewHostIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the HostRelatedByNewHostId relation to the Host table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \HostQuery The inner query object of the EXISTS statement
     */
    public function useHostRelatedByNewHostIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('HostRelatedByNewHostId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the HostRelatedByNewHostId relation to the Host table for a NOT EXISTS query.
     *
     * @see useHostRelatedByNewHostIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \HostQuery The inner query object of the NOT EXISTS statement
     */
    public function useHostRelatedByNewHostIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('HostRelatedByNewHostId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Host object
     *
     * @param \Host|ObjectCollection $host The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHostRelatedByOldHostId($host, $comparison = null)
    {
        if ($host instanceof \Host) {
            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_HOST_ID, $host->getId(), $comparison);
        } elseif ($host instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditHostScheduleTableMap::COL_OLD_HOST_ID, $host->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHostRelatedByOldHostId() only accepts arguments of type \Host or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HostRelatedByOldHostId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function joinHostRelatedByOldHostId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HostRelatedByOldHostId');

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
            $this->addJoinObject($join, 'HostRelatedByOldHostId');
        }

        return $this;
    }

    /**
     * Use the HostRelatedByOldHostId relation Host object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HostQuery A secondary query class using the current class as primary query
     */
    public function useHostRelatedByOldHostIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHostRelatedByOldHostId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HostRelatedByOldHostId', '\HostQuery');
    }

    /**
     * Use the HostRelatedByOldHostId relation Host object
     *
     * @param callable(\HostQuery):\HostQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHostRelatedByOldHostIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHostRelatedByOldHostIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the HostRelatedByOldHostId relation to the Host table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \HostQuery The inner query object of the EXISTS statement
     */
    public function useHostRelatedByOldHostIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('HostRelatedByOldHostId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the HostRelatedByOldHostId relation to the Host table for a NOT EXISTS query.
     *
     * @see useHostRelatedByOldHostIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \HostQuery The inner query object of the NOT EXISTS statement
     */
    public function useHostRelatedByOldHostIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('HostRelatedByOldHostId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildLogEditHostSchedule $logEditHostSchedule Object to remove from the list of results
     *
     * @return $this|ChildLogEditHostScheduleQuery The current query, for fluid interface
     */
    public function prune($logEditHostSchedule = null)
    {
        if ($logEditHostSchedule) {
            $this->addUsingAlias(LogEditHostScheduleTableMap::COL_ID, $logEditHostSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_edit_host_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditHostScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogEditHostScheduleTableMap::clearInstancePool();
            LogEditHostScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditHostScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogEditHostScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogEditHostScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogEditHostScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogEditHostScheduleQuery
