<?php

namespace Base;

use \GrupoSchedule as ChildGrupoSchedule;
use \GrupoScheduleQuery as ChildGrupoScheduleQuery;
use \Exception;
use \PDO;
use Map\GrupoScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'grupo_schedule' table.
 *
 *
 *
 * @method     ChildGrupoScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGrupoScheduleQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildGrupoScheduleQuery orderByScheduleId($order = Criteria::ASC) Order by the schedule_id column
 * @method     ChildGrupoScheduleQuery orderByUsuarioId($order = Criteria::ASC) Order by the usuario_id column
 * @method     ChildGrupoScheduleQuery orderByGrupoId($order = Criteria::ASC) Order by the grupo_id column
 * @method     ChildGrupoScheduleQuery orderByScheduled($order = Criteria::ASC) Order by the scheduled column
 * @method     ChildGrupoScheduleQuery orderByPushPop($order = Criteria::ASC) Order by the push_pop column
 * @method     ChildGrupoScheduleQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method     ChildGrupoScheduleQuery groupById() Group by the id column
 * @method     ChildGrupoScheduleQuery groupByDescription() Group by the description column
 * @method     ChildGrupoScheduleQuery groupByScheduleId() Group by the schedule_id column
 * @method     ChildGrupoScheduleQuery groupByUsuarioId() Group by the usuario_id column
 * @method     ChildGrupoScheduleQuery groupByGrupoId() Group by the grupo_id column
 * @method     ChildGrupoScheduleQuery groupByScheduled() Group by the scheduled column
 * @method     ChildGrupoScheduleQuery groupByPushPop() Group by the push_pop column
 * @method     ChildGrupoScheduleQuery groupByEnabled() Group by the enabled column
 *
 * @method     ChildGrupoScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGrupoScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGrupoScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGrupoScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGrupoScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGrupoScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGrupoScheduleQuery leftJoinGrupo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Grupo relation
 * @method     ChildGrupoScheduleQuery rightJoinGrupo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Grupo relation
 * @method     ChildGrupoScheduleQuery innerJoinGrupo($relationAlias = null) Adds a INNER JOIN clause to the query using the Grupo relation
 *
 * @method     ChildGrupoScheduleQuery joinWithGrupo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Grupo relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithGrupo() Adds a LEFT JOIN clause and with to the query using the Grupo relation
 * @method     ChildGrupoScheduleQuery rightJoinWithGrupo() Adds a RIGHT JOIN clause and with to the query using the Grupo relation
 * @method     ChildGrupoScheduleQuery innerJoinWithGrupo() Adds a INNER JOIN clause and with to the query using the Grupo relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Schedule relation
 * @method     ChildGrupoScheduleQuery rightJoinSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Schedule relation
 * @method     ChildGrupoScheduleQuery innerJoinSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the Schedule relation
 *
 * @method     ChildGrupoScheduleQuery joinWithSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Schedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithSchedule() Adds a LEFT JOIN clause and with to the query using the Schedule relation
 * @method     ChildGrupoScheduleQuery rightJoinWithSchedule() Adds a RIGHT JOIN clause and with to the query using the Schedule relation
 * @method     ChildGrupoScheduleQuery innerJoinWithSchedule() Adds a INNER JOIN clause and with to the query using the Schedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildGrupoScheduleQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildGrupoScheduleQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildGrupoScheduleQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildGrupoScheduleQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildGrupoScheduleQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery rightJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery innerJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery joinWithLogDeleteGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithLogDeleteGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery rightJoinWithLogDeleteGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery innerJoinWithLogDeleteGrupoSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinLogEditeGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery rightJoinLogEditeGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery innerJoinLogEditeGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery joinWithLogEditeGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithLogEditeGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery rightJoinWithLogEditeGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 * @method     ChildGrupoScheduleQuery innerJoinWithLogEditeGrupoSchedule() Adds a INNER JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinLogGrupoExecution($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogGrupoExecution relation
 * @method     ChildGrupoScheduleQuery rightJoinLogGrupoExecution($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogGrupoExecution relation
 * @method     ChildGrupoScheduleQuery innerJoinLogGrupoExecution($relationAlias = null) Adds a INNER JOIN clause to the query using the LogGrupoExecution relation
 *
 * @method     ChildGrupoScheduleQuery joinWithLogGrupoExecution($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogGrupoExecution relation
 *
 * @method     ChildGrupoScheduleQuery leftJoinWithLogGrupoExecution() Adds a LEFT JOIN clause and with to the query using the LogGrupoExecution relation
 * @method     ChildGrupoScheduleQuery rightJoinWithLogGrupoExecution() Adds a RIGHT JOIN clause and with to the query using the LogGrupoExecution relation
 * @method     ChildGrupoScheduleQuery innerJoinWithLogGrupoExecution() Adds a INNER JOIN clause and with to the query using the LogGrupoExecution relation
 *
 * @method     \GrupoQuery|\ScheduleQuery|\UsuarioQuery|\LogDeleteGrupoScheduleQuery|\LogEditeGrupoScheduleQuery|\LogGrupoExecutionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGrupoSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildGrupoSchedule matching the query
 * @method     ChildGrupoSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGrupoSchedule matching the query, or a new ChildGrupoSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildGrupoSchedule|null findOneById(int $id) Return the first ChildGrupoSchedule filtered by the id column
 * @method     ChildGrupoSchedule|null findOneByDescription(string $description) Return the first ChildGrupoSchedule filtered by the description column
 * @method     ChildGrupoSchedule|null findOneByScheduleId(int $schedule_id) Return the first ChildGrupoSchedule filtered by the schedule_id column
 * @method     ChildGrupoSchedule|null findOneByUsuarioId(int $usuario_id) Return the first ChildGrupoSchedule filtered by the usuario_id column
 * @method     ChildGrupoSchedule|null findOneByGrupoId(int $grupo_id) Return the first ChildGrupoSchedule filtered by the grupo_id column
 * @method     ChildGrupoSchedule|null findOneByScheduled(string $scheduled) Return the first ChildGrupoSchedule filtered by the scheduled column
 * @method     ChildGrupoSchedule|null findOneByPushPop(string $push_pop) Return the first ChildGrupoSchedule filtered by the push_pop column
 * @method     ChildGrupoSchedule|null findOneByEnabled(string $enabled) Return the first ChildGrupoSchedule filtered by the enabled column *

 * @method     ChildGrupoSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildGrupoSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOne(ConnectionInterface $con = null) Return the first ChildGrupoSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupoSchedule requireOneById(int $id) Return the first ChildGrupoSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByDescription(string $description) Return the first ChildGrupoSchedule filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByScheduleId(int $schedule_id) Return the first ChildGrupoSchedule filtered by the schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByUsuarioId(int $usuario_id) Return the first ChildGrupoSchedule filtered by the usuario_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByGrupoId(int $grupo_id) Return the first ChildGrupoSchedule filtered by the grupo_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByScheduled(string $scheduled) Return the first ChildGrupoSchedule filtered by the scheduled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByPushPop(string $push_pop) Return the first ChildGrupoSchedule filtered by the push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupoSchedule requireOneByEnabled(string $enabled) Return the first ChildGrupoSchedule filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupoSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGrupoSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> find(ConnectionInterface $con = null) Return ChildGrupoSchedule objects based on current ModelCriteria
 * @method     ChildGrupoSchedule[]|ObjectCollection findById(int $id) Return ChildGrupoSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findById(int $id) Return ChildGrupoSchedule objects filtered by the id column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByDescription(string $description) Return ChildGrupoSchedule objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByDescription(string $description) Return ChildGrupoSchedule objects filtered by the description column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByScheduleId(int $schedule_id) Return ChildGrupoSchedule objects filtered by the schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByScheduleId(int $schedule_id) Return ChildGrupoSchedule objects filtered by the schedule_id column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByUsuarioId(int $usuario_id) Return ChildGrupoSchedule objects filtered by the usuario_id column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByUsuarioId(int $usuario_id) Return ChildGrupoSchedule objects filtered by the usuario_id column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByGrupoId(int $grupo_id) Return ChildGrupoSchedule objects filtered by the grupo_id column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByGrupoId(int $grupo_id) Return ChildGrupoSchedule objects filtered by the grupo_id column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByScheduled(string $scheduled) Return ChildGrupoSchedule objects filtered by the scheduled column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByScheduled(string $scheduled) Return ChildGrupoSchedule objects filtered by the scheduled column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByPushPop(string $push_pop) Return ChildGrupoSchedule objects filtered by the push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByPushPop(string $push_pop) Return ChildGrupoSchedule objects filtered by the push_pop column
 * @method     ChildGrupoSchedule[]|ObjectCollection findByEnabled(string $enabled) Return ChildGrupoSchedule objects filtered by the enabled column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupoSchedule> findByEnabled(string $enabled) Return ChildGrupoSchedule objects filtered by the enabled column
 * @method     ChildGrupoSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGrupoSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GrupoScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GrupoScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GrupoSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGrupoScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGrupoScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGrupoScheduleQuery) {
            return $criteria;
        }
        $query = new ChildGrupoScheduleQuery();
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
     * @return ChildGrupoSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GrupoScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGrupoSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, schedule_id, usuario_id, grupo_id, scheduled, push_pop, enabled FROM grupo_schedule WHERE id = :p0';
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
            /** @var ChildGrupoSchedule $obj */
            $obj = new ChildGrupoSchedule();
            $obj->hydrate($row);
            GrupoScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGrupoSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduleId($scheduleId = null, $comparison = null)
    {
        if (is_array($scheduleId)) {
            $useMinMax = false;
            if (isset($scheduleId['min'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleId['max'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULE_ID, $scheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULE_ID, $scheduleId, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_USUARIO_ID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_USUARIO_ID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_USUARIO_ID, $usuarioId, $comparison);
    }

    /**
     * Filter the query on the grupo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrupoId(1234); // WHERE grupo_id = 1234
     * $query->filterByGrupoId(array(12, 34)); // WHERE grupo_id IN (12, 34)
     * $query->filterByGrupoId(array('min' => 12)); // WHERE grupo_id > 12
     * </code>
     *
     * @see       filterByGrupo()
     *
     * @param     mixed $grupoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoId($grupoId = null, $comparison = null)
    {
        if (is_array($grupoId)) {
            $useMinMax = false;
            if (isset($grupoId['min'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_GRUPO_ID, $grupoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grupoId['max'])) {
                $this->addUsingAlias(GrupoScheduleTableMap::COL_GRUPO_ID, $grupoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_GRUPO_ID, $grupoId, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByScheduled($scheduled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scheduled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULED, $scheduled, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByPushPop($pushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_PUSH_POP, $pushPop, $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enabled)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoScheduleTableMap::COL_ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query by a related \Grupo object
     *
     * @param \Grupo|ObjectCollection $grupo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo, $comparison = null)
    {
        if ($grupo instanceof \Grupo) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_GRUPO_ID, $grupo->getId(), $comparison);
        } elseif ($grupo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_GRUPO_ID, $grupo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGrupo() only accepts arguments of type \Grupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Grupo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinGrupo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Grupo');

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
            $this->addJoinObject($join, 'Grupo');
        }

        return $this;
    }

    /**
     * Use the Grupo relation Grupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoQuery A secondary query class using the current class as primary query
     */
    public function useGrupoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Grupo', '\GrupoQuery');
    }

    /**
     * Use the Grupo relation Grupo object
     *
     * @param callable(\GrupoQuery):\GrupoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGrupoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGrupoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Grupo table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \GrupoQuery The inner query object of the EXISTS statement
     */
    public function useGrupoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Grupo', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Grupo table for a NOT EXISTS query.
     *
     * @see useGrupoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \GrupoQuery The inner query object of the NOT EXISTS statement
     */
    public function useGrupoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Grupo', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Schedule object
     *
     * @param \Schedule|ObjectCollection $schedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterBySchedule($schedule, $comparison = null)
    {
        if ($schedule instanceof \Schedule) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULE_ID, $schedule->getId(), $comparison);
        } elseif ($schedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_SCHEDULE_ID, $schedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
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
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_USUARIO_ID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_USUARIO_ID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \LogDeleteGrupoSchedule object
     *
     * @param \LogDeleteGrupoSchedule|ObjectCollection $logDeleteGrupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByLogDeleteGrupoSchedule($logDeleteGrupoSchedule, $comparison = null)
    {
        if ($logDeleteGrupoSchedule instanceof \LogDeleteGrupoSchedule) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_ID, $logDeleteGrupoSchedule->getGrupoScheduleId(), $comparison);
        } elseif ($logDeleteGrupoSchedule instanceof ObjectCollection) {
            return $this
                ->useLogDeleteGrupoScheduleQuery()
                ->filterByPrimaryKeys($logDeleteGrupoSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogDeleteGrupoSchedule() only accepts arguments of type \LogDeleteGrupoSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogDeleteGrupoSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinLogDeleteGrupoSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogDeleteGrupoSchedule');

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
            $this->addJoinObject($join, 'LogDeleteGrupoSchedule');
        }

        return $this;
    }

    /**
     * Use the LogDeleteGrupoSchedule relation LogDeleteGrupoSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogDeleteGrupoScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogDeleteGrupoScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogDeleteGrupoSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogDeleteGrupoSchedule', '\LogDeleteGrupoScheduleQuery');
    }

    /**
     * Use the LogDeleteGrupoSchedule relation LogDeleteGrupoSchedule object
     *
     * @param callable(\LogDeleteGrupoScheduleQuery):\LogDeleteGrupoScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogDeleteGrupoScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogDeleteGrupoScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogDeleteGrupoSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogDeleteGrupoScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogDeleteGrupoScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogDeleteGrupoSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogDeleteGrupoSchedule table for a NOT EXISTS query.
     *
     * @see useLogDeleteGrupoScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogDeleteGrupoScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogDeleteGrupoScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogDeleteGrupoSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogEditeGrupoSchedule object
     *
     * @param \LogEditeGrupoSchedule|ObjectCollection $logEditeGrupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByLogEditeGrupoSchedule($logEditeGrupoSchedule, $comparison = null)
    {
        if ($logEditeGrupoSchedule instanceof \LogEditeGrupoSchedule) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_ID, $logEditeGrupoSchedule->getGrupoScheduleId(), $comparison);
        } elseif ($logEditeGrupoSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditeGrupoScheduleQuery()
                ->filterByPrimaryKeys($logEditeGrupoSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditeGrupoSchedule() only accepts arguments of type \LogEditeGrupoSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditeGrupoSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinLogEditeGrupoSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditeGrupoSchedule');

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
            $this->addJoinObject($join, 'LogEditeGrupoSchedule');
        }

        return $this;
    }

    /**
     * Use the LogEditeGrupoSchedule relation LogEditeGrupoSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditeGrupoScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditeGrupoScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditeGrupoSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditeGrupoSchedule', '\LogEditeGrupoScheduleQuery');
    }

    /**
     * Use the LogEditeGrupoSchedule relation LogEditeGrupoSchedule object
     *
     * @param callable(\LogEditeGrupoScheduleQuery):\LogEditeGrupoScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditeGrupoScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditeGrupoScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogEditeGrupoSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditeGrupoScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditeGrupoSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogEditeGrupoSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditeGrupoScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditeGrupoScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditeGrupoSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogGrupoExecution object
     *
     * @param \LogGrupoExecution|ObjectCollection $logGrupoExecution the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByLogGrupoExecution($logGrupoExecution, $comparison = null)
    {
        if ($logGrupoExecution instanceof \LogGrupoExecution) {
            return $this
                ->addUsingAlias(GrupoScheduleTableMap::COL_ID, $logGrupoExecution->getGrupoScheduleId(), $comparison);
        } elseif ($logGrupoExecution instanceof ObjectCollection) {
            return $this
                ->useLogGrupoExecutionQuery()
                ->filterByPrimaryKeys($logGrupoExecution->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogGrupoExecution() only accepts arguments of type \LogGrupoExecution or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogGrupoExecution relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinLogGrupoExecution($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogGrupoExecution');

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
            $this->addJoinObject($join, 'LogGrupoExecution');
        }

        return $this;
    }

    /**
     * Use the LogGrupoExecution relation LogGrupoExecution object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogGrupoExecutionQuery A secondary query class using the current class as primary query
     */
    public function useLogGrupoExecutionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogGrupoExecution($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogGrupoExecution', '\LogGrupoExecutionQuery');
    }

    /**
     * Use the LogGrupoExecution relation LogGrupoExecution object
     *
     * @param callable(\LogGrupoExecutionQuery):\LogGrupoExecutionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogGrupoExecutionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogGrupoExecutionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to LogGrupoExecution table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogGrupoExecutionQuery The inner query object of the EXISTS statement
     */
    public function useLogGrupoExecutionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogGrupoExecution', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to LogGrupoExecution table for a NOT EXISTS query.
     *
     * @see useLogGrupoExecutionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogGrupoExecutionQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogGrupoExecutionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogGrupoExecution', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildGrupoSchedule $grupoSchedule Object to remove from the list of results
     *
     * @return $this|ChildGrupoScheduleQuery The current query, for fluid interface
     */
    public function prune($grupoSchedule = null)
    {
        if ($grupoSchedule) {
            $this->addUsingAlias(GrupoScheduleTableMap::COL_ID, $grupoSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the grupo_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GrupoScheduleTableMap::clearInstancePool();
            GrupoScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GrupoScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GrupoScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GrupoScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GrupoScheduleQuery
