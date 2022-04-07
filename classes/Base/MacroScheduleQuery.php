<?php

namespace Base;

use \MacroSchedule as ChildMacroSchedule;
use \MacroScheduleQuery as ChildMacroScheduleQuery;
use \Exception;
use \PDO;
use Map\MacroScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'macro_schedule' table.
 *
 *
 *
 * @method     ChildMacroScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMacroScheduleQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildMacroScheduleQuery orderByScheduleId($order = Criteria::ASC) Order by the schedule_id column
 * @method     ChildMacroScheduleQuery orderByHostId($order = Criteria::ASC) Order by the host_id column
 * @method     ChildMacroScheduleQuery orderByUsuarioId($order = Criteria::ASC) Order by the usuario_id column
 * @method     ChildMacroScheduleQuery orderByMacroId($order = Criteria::ASC) Order by the macro_id column
 * @method     ChildMacroScheduleQuery orderByScheduled($order = Criteria::ASC) Order by the scheduled column
 * @method     ChildMacroScheduleQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method     ChildMacroScheduleQuery groupById() Group by the id column
 * @method     ChildMacroScheduleQuery groupByDescription() Group by the description column
 * @method     ChildMacroScheduleQuery groupByScheduleId() Group by the schedule_id column
 * @method     ChildMacroScheduleQuery groupByHostId() Group by the host_id column
 * @method     ChildMacroScheduleQuery groupByUsuarioId() Group by the usuario_id column
 * @method     ChildMacroScheduleQuery groupByMacroId() Group by the macro_id column
 * @method     ChildMacroScheduleQuery groupByScheduled() Group by the scheduled column
 * @method     ChildMacroScheduleQuery groupByEnabled() Group by the enabled column
 *
 * @method     ChildMacroScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMacroScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMacroScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMacroScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMacroScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMacroScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMacroScheduleQuery leftJoinHost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Host relation
 * @method     ChildMacroScheduleQuery rightJoinHost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Host relation
 * @method     ChildMacroScheduleQuery innerJoinHost($relationAlias = null) Adds a INNER JOIN clause to the query using the Host relation
 *
 * @method     ChildMacroScheduleQuery joinWithHost($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Host relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithHost() Adds a LEFT JOIN clause and with to the query using the Host relation
 * @method     ChildMacroScheduleQuery rightJoinWithHost() Adds a RIGHT JOIN clause and with to the query using the Host relation
 * @method     ChildMacroScheduleQuery innerJoinWithHost() Adds a INNER JOIN clause and with to the query using the Host relation
 *
 * @method     ChildMacroScheduleQuery leftJoinMacro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Macro relation
 * @method     ChildMacroScheduleQuery rightJoinMacro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Macro relation
 * @method     ChildMacroScheduleQuery innerJoinMacro($relationAlias = null) Adds a INNER JOIN clause to the query using the Macro relation
 *
 * @method     ChildMacroScheduleQuery joinWithMacro($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Macro relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithMacro() Adds a LEFT JOIN clause and with to the query using the Macro relation
 * @method     ChildMacroScheduleQuery rightJoinWithMacro() Adds a RIGHT JOIN clause and with to the query using the Macro relation
 * @method     ChildMacroScheduleQuery innerJoinWithMacro() Adds a INNER JOIN clause and with to the query using the Macro relation
 *
 * @method     ChildMacroScheduleQuery leftJoinSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Schedule relation
 * @method     ChildMacroScheduleQuery rightJoinSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Schedule relation
 * @method     ChildMacroScheduleQuery innerJoinSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the Schedule relation
 *
 * @method     ChildMacroScheduleQuery joinWithSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Schedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithSchedule() Adds a LEFT JOIN clause and with to the query using the Schedule relation
 * @method     ChildMacroScheduleQuery rightJoinWithSchedule() Adds a RIGHT JOIN clause and with to the query using the Schedule relation
 * @method     ChildMacroScheduleQuery innerJoinWithSchedule() Adds a INNER JOIN clause and with to the query using the Schedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildMacroScheduleQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildMacroScheduleQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildMacroScheduleQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildMacroScheduleQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildMacroScheduleQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildMacroScheduleQuery leftJoinLogDeleteMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteMacroSchedule relation
 * @method     ChildMacroScheduleQuery rightJoinLogDeleteMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteMacroSchedule relation
 * @method     ChildMacroScheduleQuery innerJoinLogDeleteMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery joinWithLogDeleteMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithLogDeleteMacroSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 * @method     ChildMacroScheduleQuery rightJoinWithLogDeleteMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 * @method     ChildMacroScheduleQuery innerJoinWithLogDeleteMacroSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinLogEditeMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeMacroSchedule relation
 * @method     ChildMacroScheduleQuery rightJoinLogEditeMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeMacroSchedule relation
 * @method     ChildMacroScheduleQuery innerJoinLogEditeMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery joinWithLogEditeMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithLogEditeMacroSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditeMacroSchedule relation
 * @method     ChildMacroScheduleQuery rightJoinWithLogEditeMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditeMacroSchedule relation
 * @method     ChildMacroScheduleQuery innerJoinWithLogEditeMacroSchedule() Adds a INNER JOIN clause and with to the query using the LogEditeMacroSchedule relation
 *
 * @method     ChildMacroScheduleQuery leftJoinLogMacroExecution($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogMacroExecution relation
 * @method     ChildMacroScheduleQuery rightJoinLogMacroExecution($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogMacroExecution relation
 * @method     ChildMacroScheduleQuery innerJoinLogMacroExecution($relationAlias = null) Adds a INNER JOIN clause to the query using the LogMacroExecution relation
 *
 * @method     ChildMacroScheduleQuery joinWithLogMacroExecution($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogMacroExecution relation
 *
 * @method     ChildMacroScheduleQuery leftJoinWithLogMacroExecution() Adds a LEFT JOIN clause and with to the query using the LogMacroExecution relation
 * @method     ChildMacroScheduleQuery rightJoinWithLogMacroExecution() Adds a RIGHT JOIN clause and with to the query using the LogMacroExecution relation
 * @method     ChildMacroScheduleQuery innerJoinWithLogMacroExecution() Adds a INNER JOIN clause and with to the query using the LogMacroExecution relation
 *
 * @method     \HostQuery|\MacroQuery|\ScheduleQuery|\UsuarioQuery|\LogDeleteMacroScheduleQuery|\LogEditeMacroScheduleQuery|\LogMacroExecutionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMacroSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildMacroSchedule matching the query
 * @method     ChildMacroSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMacroSchedule matching the query, or a new ChildMacroSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildMacroSchedule|null findOneById(int $id) Return the first ChildMacroSchedule filtered by the id column
 * @method     ChildMacroSchedule|null findOneByDescription(string $description) Return the first ChildMacroSchedule filtered by the description column
 * @method     ChildMacroSchedule|null findOneByScheduleId(int $schedule_id) Return the first ChildMacroSchedule filtered by the schedule_id column
 * @method     ChildMacroSchedule|null findOneByHostId(int $host_id) Return the first ChildMacroSchedule filtered by the host_id column
 * @method     ChildMacroSchedule|null findOneByUsuarioId(int $usuario_id) Return the first ChildMacroSchedule filtered by the usuario_id column
 * @method     ChildMacroSchedule|null findOneByMacroId(int $macro_id) Return the first ChildMacroSchedule filtered by the macro_id column
 * @method     ChildMacroSchedule|null findOneByScheduled(string $scheduled) Return the first ChildMacroSchedule filtered by the scheduled column
 * @method     ChildMacroSchedule|null findOneByEnabled(string $enabled) Return the first ChildMacroSchedule filtered by the enabled column *

 * @method     ChildMacroSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildMacroSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOne(ConnectionInterface $con = null) Return the first ChildMacroSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMacroSchedule requireOneById(int $id) Return the first ChildMacroSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByDescription(string $description) Return the first ChildMacroSchedule filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByScheduleId(int $schedule_id) Return the first ChildMacroSchedule filtered by the schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByHostId(int $host_id) Return the first ChildMacroSchedule filtered by the host_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByUsuarioId(int $usuario_id) Return the first ChildMacroSchedule filtered by the usuario_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByMacroId(int $macro_id) Return the first ChildMacroSchedule filtered by the macro_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByScheduled(string $scheduled) Return the first ChildMacroSchedule filtered by the scheduled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacroSchedule requireOneByEnabled(string $enabled) Return the first ChildMacroSchedule filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMacroSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMacroSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> find(ConnectionInterface $con = null) Return ChildMacroSchedule objects based on current ModelCriteria
 * @method     ChildMacroSchedule[]|ObjectCollection findById(int $id) Return ChildMacroSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findById(int $id) Return ChildMacroSchedule objects filtered by the id column
 * @method     ChildMacroSchedule[]|ObjectCollection findByDescription(string $description) Return ChildMacroSchedule objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByDescription(string $description) Return ChildMacroSchedule objects filtered by the description column
 * @method     ChildMacroSchedule[]|ObjectCollection findByScheduleId(int $schedule_id) Return ChildMacroSchedule objects filtered by the schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByScheduleId(int $schedule_id) Return ChildMacroSchedule objects filtered by the schedule_id column
 * @method     ChildMacroSchedule[]|ObjectCollection findByHostId(int $host_id) Return ChildMacroSchedule objects filtered by the host_id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByHostId(int $host_id) Return ChildMacroSchedule objects filtered by the host_id column
 * @method     ChildMacroSchedule[]|ObjectCollection findByUsuarioId(int $usuario_id) Return ChildMacroSchedule objects filtered by the usuario_id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByUsuarioId(int $usuario_id) Return ChildMacroSchedule objects filtered by the usuario_id column
 * @method     ChildMacroSchedule[]|ObjectCollection findByMacroId(int $macro_id) Return ChildMacroSchedule objects filtered by the macro_id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByMacroId(int $macro_id) Return ChildMacroSchedule objects filtered by the macro_id column
 * @method     ChildMacroSchedule[]|ObjectCollection findByScheduled(string $scheduled) Return ChildMacroSchedule objects filtered by the scheduled column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByScheduled(string $scheduled) Return ChildMacroSchedule objects filtered by the scheduled column
 * @method     ChildMacroSchedule[]|ObjectCollection findByEnabled(string $enabled) Return ChildMacroSchedule objects filtered by the enabled column
 * @psalm-method ObjectCollection&\Traversable<ChildMacroSchedule> findByEnabled(string $enabled) Return ChildMacroSchedule objects filtered by the enabled column
 * @method     ChildMacroSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMacroSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MacroScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MacroScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\MacroSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMacroScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMacroScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMacroScheduleQuery) {
            return $criteria;
        }
        $query = new ChildMacroScheduleQuery();
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
     * @return ChildMacroSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MacroScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MacroScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMacroSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, schedule_id, host_id, usuario_id, macro_id, scheduled, enabled FROM macro_schedule WHERE id = :p0';
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
            /** @var ChildMacroSchedule $obj */
            $obj = new ChildMacroSchedule();
            $obj->hydrate($row);
            MacroScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMacroSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduleId($scheduleId = null, $comparison = null)
    {
        if (is_array($scheduleId)) {
            $useMinMax = false;
            if (isset($scheduleId['min'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleId['max'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULE_ID, $scheduleId, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByHostId($hostId = null, $comparison = null)
    {
        if (is_array($hostId)) {
            $useMinMax = false;
            if (isset($hostId['min'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_HOST_ID, $hostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hostId['max'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_HOST_ID, $hostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_HOST_ID, $hostId, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_USUARIO_ID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_USUARIO_ID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_USUARIO_ID, $usuarioId, $comparison);
    }

    /**
     * Filter the query on the macro_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMacroId(1234); // WHERE macro_id = 1234
     * $query->filterByMacroId(array(12, 34)); // WHERE macro_id IN (12, 34)
     * $query->filterByMacroId(array('min' => 12)); // WHERE macro_id > 12
     * </code>
     *
     * @see       filterByMacro()
     *
     * @param     mixed $macroId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroId($macroId = null, $comparison = null)
    {
        if (is_array($macroId)) {
            $useMinMax = false;
            if (isset($macroId['min'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_MACRO_ID, $macroId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($macroId['max'])) {
                $this->addUsingAlias(MacroScheduleTableMap::COL_MACRO_ID, $macroId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_MACRO_ID, $macroId, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduled($scheduled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scheduled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULED, $scheduled, $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enabled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroScheduleTableMap::COL_ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query by a related \Host object
     *
     * @param \Host|ObjectCollection $host The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByHost($host, $comparison = null)
    {
        if ($host instanceof \Host) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_HOST_ID, $host->getId(), $comparison);
        } elseif ($host instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_HOST_ID, $host->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \Macro object
     *
     * @param \Macro|ObjectCollection $macro The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacro($macro, $comparison = null)
    {
        if ($macro instanceof \Macro) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_MACRO_ID, $macro->getId(), $comparison);
        } elseif ($macro instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_MACRO_ID, $macro->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMacro() only accepts arguments of type \Macro or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Macro relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function joinMacro($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Macro');

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
            $this->addJoinObject($join, 'Macro');
        }

        return $this;
    }

    /**
     * Use the Macro relation Macro object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MacroQuery A secondary query class using the current class as primary query
     */
    public function useMacroQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMacro($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Macro', '\MacroQuery');
    }

    /**
     * Use the Macro relation Macro object
     *
     * @param callable(\MacroQuery):\MacroQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMacroQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMacroQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Macro table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \MacroQuery The inner query object of the EXISTS statement
     */
    public function useMacroExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Macro', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Macro table for a NOT EXISTS query.
     *
     * @see useMacroExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \MacroQuery The inner query object of the NOT EXISTS statement
     */
    public function useMacroNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Macro', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Schedule object
     *
     * @param \Schedule|ObjectCollection $schedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterBySchedule($schedule, $comparison = null)
    {
        if ($schedule instanceof \Schedule) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULE_ID, $schedule->getId(), $comparison);
        } elseif ($schedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_SCHEDULE_ID, $schedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
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
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_USUARIO_ID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_USUARIO_ID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \LogDeleteMacroSchedule object
     *
     * @param \LogDeleteMacroSchedule|ObjectCollection $logDeleteMacroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLogDeleteMacroSchedule($logDeleteMacroSchedule, $comparison = null)
    {
        if ($logDeleteMacroSchedule instanceof \LogDeleteMacroSchedule) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_ID, $logDeleteMacroSchedule->getMacroScheduleId(), $comparison);
        } elseif ($logDeleteMacroSchedule instanceof ObjectCollection) {
            return $this
                ->useLogDeleteMacroScheduleQuery()
                ->filterByPrimaryKeys($logDeleteMacroSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogDeleteMacroSchedule() only accepts arguments of type \LogDeleteMacroSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogDeleteMacroSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function joinLogDeleteMacroSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogDeleteMacroSchedule');

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
            $this->addJoinObject($join, 'LogDeleteMacroSchedule');
        }

        return $this;
    }

    /**
     * Use the LogDeleteMacroSchedule relation LogDeleteMacroSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogDeleteMacroScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogDeleteMacroScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogDeleteMacroSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogDeleteMacroSchedule', '\LogDeleteMacroScheduleQuery');
    }

    /**
     * Use the LogDeleteMacroSchedule relation LogDeleteMacroSchedule object
     *
     * @param callable(\LogDeleteMacroScheduleQuery):\LogDeleteMacroScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogDeleteMacroScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogDeleteMacroScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogDeleteMacroSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogDeleteMacroScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogDeleteMacroScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogDeleteMacroSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogDeleteMacroSchedule table for a NOT EXISTS query.
     *
     * @see useLogDeleteMacroScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogDeleteMacroScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogDeleteMacroScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogDeleteMacroSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogEditeMacroSchedule object
     *
     * @param \LogEditeMacroSchedule|ObjectCollection $logEditeMacroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLogEditeMacroSchedule($logEditeMacroSchedule, $comparison = null)
    {
        if ($logEditeMacroSchedule instanceof \LogEditeMacroSchedule) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_ID, $logEditeMacroSchedule->getMacroScheduleId(), $comparison);
        } elseif ($logEditeMacroSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditeMacroScheduleQuery()
                ->filterByPrimaryKeys($logEditeMacroSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditeMacroSchedule() only accepts arguments of type \LogEditeMacroSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditeMacroSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function joinLogEditeMacroSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditeMacroSchedule');

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
            $this->addJoinObject($join, 'LogEditeMacroSchedule');
        }

        return $this;
    }

    /**
     * Use the LogEditeMacroSchedule relation LogEditeMacroSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditeMacroScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditeMacroScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditeMacroSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditeMacroSchedule', '\LogEditeMacroScheduleQuery');
    }

    /**
     * Use the LogEditeMacroSchedule relation LogEditeMacroSchedule object
     *
     * @param callable(\LogEditeMacroScheduleQuery):\LogEditeMacroScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditeMacroScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditeMacroScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogEditeMacroSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditeMacroScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditeMacroScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditeMacroSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogEditeMacroSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditeMacroScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditeMacroScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditeMacroScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditeMacroSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogMacroExecution object
     *
     * @param \LogMacroExecution|ObjectCollection $logMacroExecution the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLogMacroExecution($logMacroExecution, $comparison = null)
    {
        if ($logMacroExecution instanceof \LogMacroExecution) {
            return $this
                ->addUsingAlias(MacroScheduleTableMap::COL_ID, $logMacroExecution->getMacroScheduleId(), $comparison);
        } elseif ($logMacroExecution instanceof ObjectCollection) {
            return $this
                ->useLogMacroExecutionQuery()
                ->filterByPrimaryKeys($logMacroExecution->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogMacroExecution() only accepts arguments of type \LogMacroExecution or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogMacroExecution relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function joinLogMacroExecution($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogMacroExecution');

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
            $this->addJoinObject($join, 'LogMacroExecution');
        }

        return $this;
    }

    /**
     * Use the LogMacroExecution relation LogMacroExecution object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogMacroExecutionQuery A secondary query class using the current class as primary query
     */
    public function useLogMacroExecutionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogMacroExecution($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogMacroExecution', '\LogMacroExecutionQuery');
    }

    /**
     * Use the LogMacroExecution relation LogMacroExecution object
     *
     * @param callable(\LogMacroExecutionQuery):\LogMacroExecutionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogMacroExecutionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogMacroExecutionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogMacroExecution table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogMacroExecutionQuery The inner query object of the EXISTS statement
     */
    public function useLogMacroExecutionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogMacroExecution', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogMacroExecution table for a NOT EXISTS query.
     *
     * @see useLogMacroExecutionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogMacroExecutionQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogMacroExecutionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogMacroExecution', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildMacroSchedule $macroSchedule Object to remove from the list of results
     *
     * @return $this|ChildMacroScheduleQuery The current query, for fluid interface
     */
    public function prune($macroSchedule = null)
    {
        if ($macroSchedule) {
            $this->addUsingAlias(MacroScheduleTableMap::COL_ID, $macroSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MacroScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MacroScheduleTableMap::clearInstancePool();
            MacroScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MacroScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MacroScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MacroScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MacroScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MacroScheduleQuery
