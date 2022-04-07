<?php

namespace Base;

use \HostSchedule as ChildHostSchedule;
use \HostScheduleQuery as ChildHostScheduleQuery;
use \Exception;
use \PDO;
use Map\HostScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'host_schedule' table.
 *
 *
 *
 * @method     ChildHostScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHostScheduleQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildHostScheduleQuery orderByScheduled($order = Criteria::ASC) Order by the scheduled column
 * @method     ChildHostScheduleQuery orderByScheduleId($order = Criteria::ASC) Order by the schedule_id column
 * @method     ChildHostScheduleQuery orderByHostId($order = Criteria::ASC) Order by the host_id column
 * @method     ChildHostScheduleQuery orderByPushPop($order = Criteria::ASC) Order by the push_pop column
 * @method     ChildHostScheduleQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 * @method     ChildHostScheduleQuery orderByUsuarioId($order = Criteria::ASC) Order by the usuario_id column
 *
 * @method     ChildHostScheduleQuery groupById() Group by the id column
 * @method     ChildHostScheduleQuery groupByDescription() Group by the description column
 * @method     ChildHostScheduleQuery groupByScheduled() Group by the scheduled column
 * @method     ChildHostScheduleQuery groupByScheduleId() Group by the schedule_id column
 * @method     ChildHostScheduleQuery groupByHostId() Group by the host_id column
 * @method     ChildHostScheduleQuery groupByPushPop() Group by the push_pop column
 * @method     ChildHostScheduleQuery groupByEnabled() Group by the enabled column
 * @method     ChildHostScheduleQuery groupByUsuarioId() Group by the usuario_id column
 *
 * @method     ChildHostScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHostScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHostScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHostScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHostScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHostScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHostScheduleQuery leftJoinHost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Host relation
 * @method     ChildHostScheduleQuery rightJoinHost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Host relation
 * @method     ChildHostScheduleQuery innerJoinHost($relationAlias = null) Adds a INNER JOIN clause to the query using the Host relation
 *
 * @method     ChildHostScheduleQuery joinWithHost($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Host relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithHost() Adds a LEFT JOIN clause and with to the query using the Host relation
 * @method     ChildHostScheduleQuery rightJoinWithHost() Adds a RIGHT JOIN clause and with to the query using the Host relation
 * @method     ChildHostScheduleQuery innerJoinWithHost() Adds a INNER JOIN clause and with to the query using the Host relation
 *
 * @method     ChildHostScheduleQuery leftJoinSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Schedule relation
 * @method     ChildHostScheduleQuery rightJoinSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Schedule relation
 * @method     ChildHostScheduleQuery innerJoinSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the Schedule relation
 *
 * @method     ChildHostScheduleQuery joinWithSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Schedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithSchedule() Adds a LEFT JOIN clause and with to the query using the Schedule relation
 * @method     ChildHostScheduleQuery rightJoinWithSchedule() Adds a RIGHT JOIN clause and with to the query using the Schedule relation
 * @method     ChildHostScheduleQuery innerJoinWithSchedule() Adds a INNER JOIN clause and with to the query using the Schedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildHostScheduleQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildHostScheduleQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildHostScheduleQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildHostScheduleQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildHostScheduleQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildHostScheduleQuery leftJoinLogDeleteHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteHostSchedule relation
 * @method     ChildHostScheduleQuery rightJoinLogDeleteHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteHostSchedule relation
 * @method     ChildHostScheduleQuery innerJoinLogDeleteHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildHostScheduleQuery joinWithLogDeleteHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithLogDeleteHostSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteHostSchedule relation
 * @method     ChildHostScheduleQuery rightJoinWithLogDeleteHostSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteHostSchedule relation
 * @method     ChildHostScheduleQuery innerJoinWithLogDeleteHostSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinLogEditHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditHostSchedule relation
 * @method     ChildHostScheduleQuery rightJoinLogEditHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditHostSchedule relation
 * @method     ChildHostScheduleQuery innerJoinLogEditHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditHostSchedule relation
 *
 * @method     ChildHostScheduleQuery joinWithLogEditHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditHostSchedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithLogEditHostSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditHostSchedule relation
 * @method     ChildHostScheduleQuery rightJoinWithLogEditHostSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditHostSchedule relation
 * @method     ChildHostScheduleQuery innerJoinWithLogEditHostSchedule() Adds a INNER JOIN clause and with to the query using the LogEditHostSchedule relation
 *
 * @method     ChildHostScheduleQuery leftJoinLogHostExecution($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogHostExecution relation
 * @method     ChildHostScheduleQuery rightJoinLogHostExecution($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogHostExecution relation
 * @method     ChildHostScheduleQuery innerJoinLogHostExecution($relationAlias = null) Adds a INNER JOIN clause to the query using the LogHostExecution relation
 *
 * @method     ChildHostScheduleQuery joinWithLogHostExecution($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogHostExecution relation
 *
 * @method     ChildHostScheduleQuery leftJoinWithLogHostExecution() Adds a LEFT JOIN clause and with to the query using the LogHostExecution relation
 * @method     ChildHostScheduleQuery rightJoinWithLogHostExecution() Adds a RIGHT JOIN clause and with to the query using the LogHostExecution relation
 * @method     ChildHostScheduleQuery innerJoinWithLogHostExecution() Adds a INNER JOIN clause and with to the query using the LogHostExecution relation
 *
 * @method     \HostQuery|\ScheduleQuery|\UsuarioQuery|\LogDeleteHostScheduleQuery|\LogEditHostScheduleQuery|\LogHostExecutionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHostSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildHostSchedule matching the query
 * @method     ChildHostSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHostSchedule matching the query, or a new ChildHostSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildHostSchedule|null findOneById(int $id) Return the first ChildHostSchedule filtered by the id column
 * @method     ChildHostSchedule|null findOneByDescription(string $description) Return the first ChildHostSchedule filtered by the description column
 * @method     ChildHostSchedule|null findOneByScheduled(string $scheduled) Return the first ChildHostSchedule filtered by the scheduled column
 * @method     ChildHostSchedule|null findOneByScheduleId(int $schedule_id) Return the first ChildHostSchedule filtered by the schedule_id column
 * @method     ChildHostSchedule|null findOneByHostId(int $host_id) Return the first ChildHostSchedule filtered by the host_id column
 * @method     ChildHostSchedule|null findOneByPushPop(string $push_pop) Return the first ChildHostSchedule filtered by the push_pop column
 * @method     ChildHostSchedule|null findOneByEnabled(string $enabled) Return the first ChildHostSchedule filtered by the enabled column
 * @method     ChildHostSchedule|null findOneByUsuarioId(int $usuario_id) Return the first ChildHostSchedule filtered by the usuario_id column *

 * @method     ChildHostSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildHostSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOne(ConnectionInterface $con = null) Return the first ChildHostSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHostSchedule requireOneById(int $id) Return the first ChildHostSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByDescription(string $description) Return the first ChildHostSchedule filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByScheduled(string $scheduled) Return the first ChildHostSchedule filtered by the scheduled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByScheduleId(int $schedule_id) Return the first ChildHostSchedule filtered by the schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByHostId(int $host_id) Return the first ChildHostSchedule filtered by the host_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByPushPop(string $push_pop) Return the first ChildHostSchedule filtered by the push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByEnabled(string $enabled) Return the first ChildHostSchedule filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHostSchedule requireOneByUsuarioId(int $usuario_id) Return the first ChildHostSchedule filtered by the usuario_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHostSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHostSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> find(ConnectionInterface $con = null) Return ChildHostSchedule objects based on current ModelCriteria
 * @method     ChildHostSchedule[]|ObjectCollection findById(int $id) Return ChildHostSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findById(int $id) Return ChildHostSchedule objects filtered by the id column
 * @method     ChildHostSchedule[]|ObjectCollection findByDescription(string $description) Return ChildHostSchedule objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByDescription(string $description) Return ChildHostSchedule objects filtered by the description column
 * @method     ChildHostSchedule[]|ObjectCollection findByScheduled(string $scheduled) Return ChildHostSchedule objects filtered by the scheduled column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByScheduled(string $scheduled) Return ChildHostSchedule objects filtered by the scheduled column
 * @method     ChildHostSchedule[]|ObjectCollection findByScheduleId(int $schedule_id) Return ChildHostSchedule objects filtered by the schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByScheduleId(int $schedule_id) Return ChildHostSchedule objects filtered by the schedule_id column
 * @method     ChildHostSchedule[]|ObjectCollection findByHostId(int $host_id) Return ChildHostSchedule objects filtered by the host_id column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByHostId(int $host_id) Return ChildHostSchedule objects filtered by the host_id column
 * @method     ChildHostSchedule[]|ObjectCollection findByPushPop(string $push_pop) Return ChildHostSchedule objects filtered by the push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByPushPop(string $push_pop) Return ChildHostSchedule objects filtered by the push_pop column
 * @method     ChildHostSchedule[]|ObjectCollection findByEnabled(string $enabled) Return ChildHostSchedule objects filtered by the enabled column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByEnabled(string $enabled) Return ChildHostSchedule objects filtered by the enabled column
 * @method     ChildHostSchedule[]|ObjectCollection findByUsuarioId(int $usuario_id) Return ChildHostSchedule objects filtered by the usuario_id column
 * @psalm-method ObjectCollection&\Traversable<ChildHostSchedule> findByUsuarioId(int $usuario_id) Return ChildHostSchedule objects filtered by the usuario_id column
 * @method     ChildHostSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHostSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HostScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\HostScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\HostSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHostScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHostScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHostScheduleQuery) {
            return $criteria;
        }
        $query = new ChildHostScheduleQuery();
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
     * @return ChildHostSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HostScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHostSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, scheduled, schedule_id, host_id, push_pop, enabled, usuario_id FROM host_schedule WHERE id = :p0';
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
            /** @var ChildHostSchedule $obj */
            $obj = new ChildHostSchedule();
            $obj->hydrate($row);
            HostScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHostSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HostScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HostScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the scheduled column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduled('fooValue');   // WHERE scheduled = 'fooValue'
     * $query->filterByScheduled('%fooValue%', Criteria::LIKE); // WHERE scheduled LIKE '%fooValue%'
     * $query->filterByScheduled(['foo', 'bar']); // WHERE scheduled IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $scheduled The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduled($scheduled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scheduled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_SCHEDULED, $scheduled, $comparison);
    }

    /**
     * Filter the query on the schedule_id column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduleId(1234); // WHERE schedule_id = 1234
     * $query->filterByScheduleId(array(12, 34)); // WHERE schedule_id IN (12, 34)
     * $query->filterByScheduleId(array('min' => 12)); // WHERE schedule_id > 12
     * </code>
     *
     * @see       filterBySchedule()
     *
     * @param     mixed $scheduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduleId($scheduleId = null, $comparison = null)
    {
        if (is_array($scheduleId)) {
            $useMinMax = false;
            if (isset($scheduleId['min'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleId['max'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_SCHEDULE_ID, $scheduleId, $comparison);
    }

    /**
     * Filter the query on the host_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHostId(1234); // WHERE host_id = 1234
     * $query->filterByHostId(array(12, 34)); // WHERE host_id IN (12, 34)
     * $query->filterByHostId(array('min' => 12)); // WHERE host_id > 12
     * </code>
     *
     * @see       filterByHost()
     *
     * @param     mixed $hostId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHostId($hostId = null, $comparison = null)
    {
        if (is_array($hostId)) {
            $useMinMax = false;
            if (isset($hostId['min'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_HOST_ID, $hostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hostId['max'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_HOST_ID, $hostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_HOST_ID, $hostId, $comparison);
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
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByPushPop($pushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_PUSH_POP, $pushPop, $comparison);
    }

    /**
     * Filter the query on the enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByEnabled('fooValue');   // WHERE enabled = 'fooValue'
     * $query->filterByEnabled('%fooValue%', Criteria::LIKE); // WHERE enabled LIKE '%fooValue%'
     * $query->filterByEnabled(['foo', 'bar']); // WHERE enabled IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $enabled The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enabled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query on the usuario_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuarioId(1234); // WHERE usuario_id = 1234
     * $query->filterByUsuarioId(array(12, 34)); // WHERE usuario_id IN (12, 34)
     * $query->filterByUsuarioId(array('min' => 12)); // WHERE usuario_id > 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $usuarioId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_USUARIO_ID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(HostScheduleTableMap::COL_USUARIO_ID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostScheduleTableMap::COL_USUARIO_ID, $usuarioId, $comparison);
    }

    /**
     * Filter the query by a related \Host object
     *
     * @param \Host|ObjectCollection $host The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByHost($host, $comparison = null)
    {
        if ($host instanceof \Host) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_HOST_ID, $host->getId(), $comparison);
        } elseif ($host instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_HOST_ID, $host->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHost() only accepts arguments of type \Host or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Host relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinHost($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Host');

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
            $this->addJoinObject($join, 'Host');
        }

        return $this;
    }

    /**
     * Use the Host relation Host object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HostQuery A secondary query class using the current class as primary query
     */
    public function useHostQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHost($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Host', '\HostQuery');
    }

    /**
     * Use the Host relation Host object
     *
     * @param callable(\HostQuery):\HostQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHostQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHostQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Host table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \HostQuery The inner query object of the EXISTS statement
     */
    public function useHostExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Host', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Host table for a NOT EXISTS query.
     *
     * @see useHostExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \HostQuery The inner query object of the NOT EXISTS statement
     */
    public function useHostNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Host', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Schedule object
     *
     * @param \Schedule|ObjectCollection $schedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterBySchedule($schedule, $comparison = null)
    {
        if ($schedule instanceof \Schedule) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_SCHEDULE_ID, $schedule->getId(), $comparison);
        } elseif ($schedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_SCHEDULE_ID, $schedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySchedule() only accepts arguments of type \Schedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Schedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Schedule');

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
            $this->addJoinObject($join, 'Schedule');
        }

        return $this;
    }

    /**
     * Use the Schedule relation Schedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ScheduleQuery A secondary query class using the current class as primary query
     */
    public function useScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Schedule', '\ScheduleQuery');
    }

    /**
     * Use the Schedule relation Schedule object
     *
     * @param callable(\ScheduleQuery):\ScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Schedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ScheduleQuery The inner query object of the EXISTS statement
     */
    public function useScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Schedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Schedule table for a NOT EXISTS query.
     *
     * @see useScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Schedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_USUARIO_ID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_USUARIO_ID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\UsuarioQuery');
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @param callable(\UsuarioQuery):\UsuarioQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsuarioQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsuarioQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Usuario table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UsuarioQuery The inner query object of the EXISTS statement
     */
    public function useUsuarioExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Usuario', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Usuario table for a NOT EXISTS query.
     *
     * @see useUsuarioExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UsuarioQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsuarioNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Usuario', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogDeleteHostSchedule object
     *
     * @param \LogDeleteHostSchedule|ObjectCollection $logDeleteHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByLogDeleteHostSchedule($logDeleteHostSchedule, $comparison = null)
    {
        if ($logDeleteHostSchedule instanceof \LogDeleteHostSchedule) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_ID, $logDeleteHostSchedule->getHostScheduleId(), $comparison);
        } elseif ($logDeleteHostSchedule instanceof ObjectCollection) {
            return $this
                ->useLogDeleteHostScheduleQuery()
                ->filterByPrimaryKeys($logDeleteHostSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogDeleteHostSchedule() only accepts arguments of type \LogDeleteHostSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogDeleteHostSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinLogDeleteHostSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogDeleteHostSchedule');

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
            $this->addJoinObject($join, 'LogDeleteHostSchedule');
        }

        return $this;
    }

    /**
     * Use the LogDeleteHostSchedule relation LogDeleteHostSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogDeleteHostScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogDeleteHostScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogDeleteHostSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogDeleteHostSchedule', '\LogDeleteHostScheduleQuery');
    }

    /**
     * Use the LogDeleteHostSchedule relation LogDeleteHostSchedule object
     *
     * @param callable(\LogDeleteHostScheduleQuery):\LogDeleteHostScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogDeleteHostScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogDeleteHostScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogDeleteHostSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogDeleteHostScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogDeleteHostScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogDeleteHostSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogDeleteHostSchedule table for a NOT EXISTS query.
     *
     * @see useLogDeleteHostScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogDeleteHostScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogDeleteHostScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogDeleteHostSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogEditHostSchedule object
     *
     * @param \LogEditHostSchedule|ObjectCollection $logEditHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByLogEditHostSchedule($logEditHostSchedule, $comparison = null)
    {
        if ($logEditHostSchedule instanceof \LogEditHostSchedule) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_ID, $logEditHostSchedule->getHostScheduleId(), $comparison);
        } elseif ($logEditHostSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditHostScheduleQuery()
                ->filterByPrimaryKeys($logEditHostSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditHostSchedule() only accepts arguments of type \LogEditHostSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditHostSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinLogEditHostSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditHostSchedule');

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
            $this->addJoinObject($join, 'LogEditHostSchedule');
        }

        return $this;
    }

    /**
     * Use the LogEditHostSchedule relation LogEditHostSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditHostScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditHostScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditHostSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditHostSchedule', '\LogEditHostScheduleQuery');
    }

    /**
     * Use the LogEditHostSchedule relation LogEditHostSchedule object
     *
     * @param callable(\LogEditHostScheduleQuery):\LogEditHostScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditHostScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditHostScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogEditHostSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditHostScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditHostScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditHostSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogEditHostSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditHostScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditHostScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditHostScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditHostSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogHostExecution object
     *
     * @param \LogHostExecution|ObjectCollection $logHostExecution the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostScheduleQuery The current query, for fluid interface
     */
    public function filterByLogHostExecution($logHostExecution, $comparison = null)
    {
        if ($logHostExecution instanceof \LogHostExecution) {
            return $this
                ->addUsingAlias(HostScheduleTableMap::COL_ID, $logHostExecution->getHostScheduleId(), $comparison);
        } elseif ($logHostExecution instanceof ObjectCollection) {
            return $this
                ->useLogHostExecutionQuery()
                ->filterByPrimaryKeys($logHostExecution->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogHostExecution() only accepts arguments of type \LogHostExecution or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogHostExecution relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function joinLogHostExecution($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogHostExecution');

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
            $this->addJoinObject($join, 'LogHostExecution');
        }

        return $this;
    }

    /**
     * Use the LogHostExecution relation LogHostExecution object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogHostExecutionQuery A secondary query class using the current class as primary query
     */
    public function useLogHostExecutionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogHostExecution($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogHostExecution', '\LogHostExecutionQuery');
    }

    /**
     * Use the LogHostExecution relation LogHostExecution object
     *
     * @param callable(\LogHostExecutionQuery):\LogHostExecutionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogHostExecutionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogHostExecutionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogHostExecution table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogHostExecutionQuery The inner query object of the EXISTS statement
     */
    public function useLogHostExecutionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogHostExecution', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogHostExecution table for a NOT EXISTS query.
     *
     * @see useLogHostExecutionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogHostExecutionQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogHostExecutionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogHostExecution', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildHostSchedule $hostSchedule Object to remove from the list of results
     *
     * @return $this|ChildHostScheduleQuery The current query, for fluid interface
     */
    public function prune($hostSchedule = null)
    {
        if ($hostSchedule) {
            $this->addUsingAlias(HostScheduleTableMap::COL_ID, $hostSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the host_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HostScheduleTableMap::clearInstancePool();
            HostScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HostScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HostScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HostScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HostScheduleQuery
