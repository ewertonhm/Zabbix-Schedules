<?php

namespace Base;

use \LogEditeGrupoSchedule as ChildLogEditeGrupoSchedule;
use \LogEditeGrupoScheduleQuery as ChildLogEditeGrupoScheduleQuery;
use \Exception;
use \PDO;
use Map\LogEditeGrupoScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_edite_grupo_schedule' table.
 *
 *
 *
 * @method     ChildLogEditeGrupoScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogEditeGrupoScheduleQuery orderByGrupoScheduleId($order = Criteria::ASC) Order by the grupo_schedule_id column
 * @method     ChildLogEditeGrupoScheduleQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 * @method     ChildLogEditeGrupoScheduleQuery orderByOldDateFrom($order = Criteria::ASC) Order by the old_date_from column
 * @method     ChildLogEditeGrupoScheduleQuery orderByNewDateFrom($order = Criteria::ASC) Order by the new_date_from column
 * @method     ChildLogEditeGrupoScheduleQuery orderByOldDateUntil($order = Criteria::ASC) Order by the old_date_until column
 * @method     ChildLogEditeGrupoScheduleQuery orderByNewDateUntil($order = Criteria::ASC) Order by the new_date_until column
 * @method     ChildLogEditeGrupoScheduleQuery orderByOldGrupoId($order = Criteria::ASC) Order by the old_grupo_id column
 * @method     ChildLogEditeGrupoScheduleQuery orderByNewGrupoId($order = Criteria::ASC) Order by the new_grupo_id column
 * @method     ChildLogEditeGrupoScheduleQuery orderByOldPushPop($order = Criteria::ASC) Order by the old_push_pop column
 * @method     ChildLogEditeGrupoScheduleQuery orderByNewPushPop($order = Criteria::ASC) Order by the new_push_pop column
 *
 * @method     ChildLogEditeGrupoScheduleQuery groupById() Group by the id column
 * @method     ChildLogEditeGrupoScheduleQuery groupByGrupoScheduleId() Group by the grupo_schedule_id column
 * @method     ChildLogEditeGrupoScheduleQuery groupByLogId() Group by the log_id column
 * @method     ChildLogEditeGrupoScheduleQuery groupByOldDateFrom() Group by the old_date_from column
 * @method     ChildLogEditeGrupoScheduleQuery groupByNewDateFrom() Group by the new_date_from column
 * @method     ChildLogEditeGrupoScheduleQuery groupByOldDateUntil() Group by the old_date_until column
 * @method     ChildLogEditeGrupoScheduleQuery groupByNewDateUntil() Group by the new_date_until column
 * @method     ChildLogEditeGrupoScheduleQuery groupByOldGrupoId() Group by the old_grupo_id column
 * @method     ChildLogEditeGrupoScheduleQuery groupByNewGrupoId() Group by the new_grupo_id column
 * @method     ChildLogEditeGrupoScheduleQuery groupByOldPushPop() Group by the old_push_pop column
 * @method     ChildLogEditeGrupoScheduleQuery groupByNewPushPop() Group by the new_push_pop column
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogEditeGrupoScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogEditeGrupoScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoSchedule relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery joinWithGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinWithGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinWithGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinWithGrupoSchedule() Adds a INNER JOIN clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Log relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Log relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinLog($relationAlias = null) Adds a INNER JOIN clause to the query using the Log relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery joinWithLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Log relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinWithLog() Adds a LEFT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinWithLog() Adds a RIGHT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinWithLog() Adds a INNER JOIN clause and with to the query using the Log relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinGrupoRelatedByNewGrupoId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoRelatedByNewGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinGrupoRelatedByNewGrupoId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoRelatedByNewGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinGrupoRelatedByNewGrupoId($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoRelatedByNewGrupoId relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery joinWithGrupoRelatedByNewGrupoId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoRelatedByNewGrupoId relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinWithGrupoRelatedByNewGrupoId() Adds a LEFT JOIN clause and with to the query using the GrupoRelatedByNewGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinWithGrupoRelatedByNewGrupoId() Adds a RIGHT JOIN clause and with to the query using the GrupoRelatedByNewGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinWithGrupoRelatedByNewGrupoId() Adds a INNER JOIN clause and with to the query using the GrupoRelatedByNewGrupoId relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinGrupoRelatedByOldGrupoId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoRelatedByOldGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinGrupoRelatedByOldGrupoId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoRelatedByOldGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinGrupoRelatedByOldGrupoId($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoRelatedByOldGrupoId relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery joinWithGrupoRelatedByOldGrupoId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoRelatedByOldGrupoId relation
 *
 * @method     ChildLogEditeGrupoScheduleQuery leftJoinWithGrupoRelatedByOldGrupoId() Adds a LEFT JOIN clause and with to the query using the GrupoRelatedByOldGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery rightJoinWithGrupoRelatedByOldGrupoId() Adds a RIGHT JOIN clause and with to the query using the GrupoRelatedByOldGrupoId relation
 * @method     ChildLogEditeGrupoScheduleQuery innerJoinWithGrupoRelatedByOldGrupoId() Adds a INNER JOIN clause and with to the query using the GrupoRelatedByOldGrupoId relation
 *
 * @method     \GrupoScheduleQuery|\LogQuery|\GrupoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogEditeGrupoSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildLogEditeGrupoSchedule matching the query
 * @method     ChildLogEditeGrupoSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogEditeGrupoSchedule matching the query, or a new ChildLogEditeGrupoSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildLogEditeGrupoSchedule|null findOneById(int $id) Return the first ChildLogEditeGrupoSchedule filtered by the id column
 * @method     ChildLogEditeGrupoSchedule|null findOneByGrupoScheduleId(int $grupo_schedule_id) Return the first ChildLogEditeGrupoSchedule filtered by the grupo_schedule_id column
 * @method     ChildLogEditeGrupoSchedule|null findOneByLogId(int $log_id) Return the first ChildLogEditeGrupoSchedule filtered by the log_id column
 * @method     ChildLogEditeGrupoSchedule|null findOneByOldDateFrom(string $old_date_from) Return the first ChildLogEditeGrupoSchedule filtered by the old_date_from column
 * @method     ChildLogEditeGrupoSchedule|null findOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditeGrupoSchedule filtered by the new_date_from column
 * @method     ChildLogEditeGrupoSchedule|null findOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditeGrupoSchedule filtered by the old_date_until column
 * @method     ChildLogEditeGrupoSchedule|null findOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditeGrupoSchedule filtered by the new_date_until column
 * @method     ChildLogEditeGrupoSchedule|null findOneByOldGrupoId(int $old_grupo_id) Return the first ChildLogEditeGrupoSchedule filtered by the old_grupo_id column
 * @method     ChildLogEditeGrupoSchedule|null findOneByNewGrupoId(int $new_grupo_id) Return the first ChildLogEditeGrupoSchedule filtered by the new_grupo_id column
 * @method     ChildLogEditeGrupoSchedule|null findOneByOldPushPop(string $old_push_pop) Return the first ChildLogEditeGrupoSchedule filtered by the old_push_pop column
 * @method     ChildLogEditeGrupoSchedule|null findOneByNewPushPop(string $new_push_pop) Return the first ChildLogEditeGrupoSchedule filtered by the new_push_pop column *

 * @method     ChildLogEditeGrupoSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildLogEditeGrupoSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOne(ConnectionInterface $con = null) Return the first ChildLogEditeGrupoSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditeGrupoSchedule requireOneById(int $id) Return the first ChildLogEditeGrupoSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByGrupoScheduleId(int $grupo_schedule_id) Return the first ChildLogEditeGrupoSchedule filtered by the grupo_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByLogId(int $log_id) Return the first ChildLogEditeGrupoSchedule filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByOldDateFrom(string $old_date_from) Return the first ChildLogEditeGrupoSchedule filtered by the old_date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditeGrupoSchedule filtered by the new_date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditeGrupoSchedule filtered by the old_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditeGrupoSchedule filtered by the new_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByOldGrupoId(int $old_grupo_id) Return the first ChildLogEditeGrupoSchedule filtered by the old_grupo_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByNewGrupoId(int $new_grupo_id) Return the first ChildLogEditeGrupoSchedule filtered by the new_grupo_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByOldPushPop(string $old_push_pop) Return the first ChildLogEditeGrupoSchedule filtered by the old_push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeGrupoSchedule requireOneByNewPushPop(string $new_push_pop) Return the first ChildLogEditeGrupoSchedule filtered by the new_push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogEditeGrupoSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> find(ConnectionInterface $con = null) Return ChildLogEditeGrupoSchedule objects based on current ModelCriteria
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findById(int $id) Return ChildLogEditeGrupoSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findById(int $id) Return ChildLogEditeGrupoSchedule objects filtered by the id column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByGrupoScheduleId(int $grupo_schedule_id) Return ChildLogEditeGrupoSchedule objects filtered by the grupo_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByGrupoScheduleId(int $grupo_schedule_id) Return ChildLogEditeGrupoSchedule objects filtered by the grupo_schedule_id column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByLogId(int $log_id) Return ChildLogEditeGrupoSchedule objects filtered by the log_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByLogId(int $log_id) Return ChildLogEditeGrupoSchedule objects filtered by the log_id column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByOldDateFrom(string $old_date_from) Return ChildLogEditeGrupoSchedule objects filtered by the old_date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByOldDateFrom(string $old_date_from) Return ChildLogEditeGrupoSchedule objects filtered by the old_date_from column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByNewDateFrom(string $new_date_from) Return ChildLogEditeGrupoSchedule objects filtered by the new_date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByNewDateFrom(string $new_date_from) Return ChildLogEditeGrupoSchedule objects filtered by the new_date_from column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByOldDateUntil(string $old_date_until) Return ChildLogEditeGrupoSchedule objects filtered by the old_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByOldDateUntil(string $old_date_until) Return ChildLogEditeGrupoSchedule objects filtered by the old_date_until column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByNewDateUntil(string $new_date_until) Return ChildLogEditeGrupoSchedule objects filtered by the new_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByNewDateUntil(string $new_date_until) Return ChildLogEditeGrupoSchedule objects filtered by the new_date_until column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByOldGrupoId(int $old_grupo_id) Return ChildLogEditeGrupoSchedule objects filtered by the old_grupo_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByOldGrupoId(int $old_grupo_id) Return ChildLogEditeGrupoSchedule objects filtered by the old_grupo_id column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByNewGrupoId(int $new_grupo_id) Return ChildLogEditeGrupoSchedule objects filtered by the new_grupo_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByNewGrupoId(int $new_grupo_id) Return ChildLogEditeGrupoSchedule objects filtered by the new_grupo_id column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByOldPushPop(string $old_push_pop) Return ChildLogEditeGrupoSchedule objects filtered by the old_push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByOldPushPop(string $old_push_pop) Return ChildLogEditeGrupoSchedule objects filtered by the old_push_pop column
 * @method     ChildLogEditeGrupoSchedule[]|ObjectCollection findByNewPushPop(string $new_push_pop) Return ChildLogEditeGrupoSchedule objects filtered by the new_push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> findByNewPushPop(string $new_push_pop) Return ChildLogEditeGrupoSchedule objects filtered by the new_push_pop column
 * @method     ChildLogEditeGrupoSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogEditeGrupoSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogEditeGrupoScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogEditeGrupoScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogEditeGrupoSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogEditeGrupoScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogEditeGrupoScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogEditeGrupoScheduleQuery) {
            return $criteria;
        }
        $query = new ChildLogEditeGrupoScheduleQuery();
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
     * @return ChildLogEditeGrupoSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogEditeGrupoScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogEditeGrupoSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, grupo_schedule_id, log_id, old_date_from, new_date_from, old_date_until, new_date_until, old_grupo_id, new_grupo_id, old_push_pop, new_push_pop FROM log_edite_grupo_schedule WHERE id = :p0';
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
            /** @var ChildLogEditeGrupoSchedule $obj */
            $obj = new ChildLogEditeGrupoSchedule();
            $obj->hydrate($row);
            LogEditeGrupoScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogEditeGrupoSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the grupo_schedule_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrupoScheduleId(1234); // WHERE grupo_schedule_id = 1234
     * $query->filterByGrupoScheduleId(array(12, 34)); // WHERE grupo_schedule_id IN (12, 34)
     * $query->filterByGrupoScheduleId(array('min' => 12)); // WHERE grupo_schedule_id > 12
     * </code>
     *
     * @see       filterByGrupoSchedule()
     *
     * @param     mixed $grupoScheduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoScheduleId($grupoScheduleId = null, $comparison = null)
    {
        if (is_array($grupoScheduleId)) {
            $useMinMax = false;
            if (isset($grupoScheduleId['min'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grupoScheduleId['max'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByLogId($logId = null, $comparison = null)
    {
        if (is_array($logId)) {
            $useMinMax = false;
            if (isset($logId['min'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_LOG_ID, $logId, $comparison);
    }

    /**
     * Filter the query on the old_date_from column
     *
     * Example usage:
     * <code>
     * $query->filterByOldDateFrom('fooValue');   // WHERE old_date_from = 'fooValue'
     * $query->filterByOldDateFrom('%fooValue%', Criteria::LIKE); // WHERE old_date_from LIKE '%fooValue%'
     * $query->filterByOldDateFrom(['foo', 'bar']); // WHERE old_date_from IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldDateFrom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDateFrom($oldDateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM, $oldDateFrom, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateFrom($newDateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM, $newDateFrom, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDateUntil($oldDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL, $oldDateUntil, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateUntil($newDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL, $newDateUntil, $comparison);
    }

    /**
     * Filter the query on the old_grupo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOldGrupoId(1234); // WHERE old_grupo_id = 1234
     * $query->filterByOldGrupoId(array(12, 34)); // WHERE old_grupo_id IN (12, 34)
     * $query->filterByOldGrupoId(array('min' => 12)); // WHERE old_grupo_id > 12
     * </code>
     *
     * @see       filterByGrupoRelatedByOldGrupoId()
     *
     * @param     mixed $oldGrupoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByOldGrupoId($oldGrupoId = null, $comparison = null)
    {
        if (is_array($oldGrupoId)) {
            $useMinMax = false;
            if (isset($oldGrupoId['min'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, $oldGrupoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oldGrupoId['max'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, $oldGrupoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, $oldGrupoId, $comparison);
    }

    /**
     * Filter the query on the new_grupo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNewGrupoId(1234); // WHERE new_grupo_id = 1234
     * $query->filterByNewGrupoId(array(12, 34)); // WHERE new_grupo_id IN (12, 34)
     * $query->filterByNewGrupoId(array('min' => 12)); // WHERE new_grupo_id > 12
     * </code>
     *
     * @see       filterByGrupoRelatedByNewGrupoId()
     *
     * @param     mixed $newGrupoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByNewGrupoId($newGrupoId = null, $comparison = null)
    {
        if (is_array($newGrupoId)) {
            $useMinMax = false;
            if (isset($newGrupoId['min'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, $newGrupoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newGrupoId['max'])) {
                $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, $newGrupoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, $newGrupoId, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByOldPushPop($oldPushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldPushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP, $oldPushPop, $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByNewPushPop($newPushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newPushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP, $newPushPop, $comparison);
    }

    /**
     * Filter the query by a related \GrupoSchedule object
     *
     * @param \GrupoSchedule|ObjectCollection $grupoSchedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoSchedule($grupoSchedule, $comparison = null)
    {
        if ($grupoSchedule instanceof \GrupoSchedule) {
            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, $grupoSchedule->getId(), $comparison);
        } elseif ($grupoSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, $grupoSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGrupoSchedule() only accepts arguments of type \GrupoSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GrupoSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinGrupoSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GrupoSchedule');

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
            $this->addJoinObject($join, 'GrupoSchedule');
        }

        return $this;
    }

    /**
     * Use the GrupoSchedule relation GrupoSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoScheduleQuery A secondary query class using the current class as primary query
     */
    public function useGrupoScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupoSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GrupoSchedule', '\GrupoScheduleQuery');
    }

    /**
     * Use the GrupoSchedule relation GrupoSchedule object
     *
     * @param callable(\GrupoScheduleQuery):\GrupoScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGrupoScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGrupoScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to GrupoSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \GrupoScheduleQuery The inner query object of the EXISTS statement
     */
    public function useGrupoScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('GrupoSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to GrupoSchedule table for a NOT EXISTS query.
     *
     * @see useGrupoScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \GrupoScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useGrupoScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('GrupoSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Log object
     *
     * @param \Log|ObjectCollection $log The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByLog($log, $comparison = null)
    {
        if ($log instanceof \Log) {
            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_LOG_ID, $log->getId(), $comparison);
        } elseif ($log instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_LOG_ID, $log->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \Grupo object
     *
     * @param \Grupo|ObjectCollection $grupo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoRelatedByNewGrupoId($grupo, $comparison = null)
    {
        if ($grupo instanceof \Grupo) {
            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, $grupo->getId(), $comparison);
        } elseif ($grupo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, $grupo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGrupoRelatedByNewGrupoId() only accepts arguments of type \Grupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GrupoRelatedByNewGrupoId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinGrupoRelatedByNewGrupoId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GrupoRelatedByNewGrupoId');

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
            $this->addJoinObject($join, 'GrupoRelatedByNewGrupoId');
        }

        return $this;
    }

    /**
     * Use the GrupoRelatedByNewGrupoId relation Grupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoQuery A secondary query class using the current class as primary query
     */
    public function useGrupoRelatedByNewGrupoIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupoRelatedByNewGrupoId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GrupoRelatedByNewGrupoId', '\GrupoQuery');
    }

    /**
     * Use the GrupoRelatedByNewGrupoId relation Grupo object
     *
     * @param callable(\GrupoQuery):\GrupoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGrupoRelatedByNewGrupoIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGrupoRelatedByNewGrupoIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the GrupoRelatedByNewGrupoId relation to the Grupo table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \GrupoQuery The inner query object of the EXISTS statement
     */
    public function useGrupoRelatedByNewGrupoIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('GrupoRelatedByNewGrupoId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the GrupoRelatedByNewGrupoId relation to the Grupo table for a NOT EXISTS query.
     *
     * @see useGrupoRelatedByNewGrupoIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \GrupoQuery The inner query object of the NOT EXISTS statement
     */
    public function useGrupoRelatedByNewGrupoIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('GrupoRelatedByNewGrupoId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Grupo object
     *
     * @param \Grupo|ObjectCollection $grupo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoRelatedByOldGrupoId($grupo, $comparison = null)
    {
        if ($grupo instanceof \Grupo) {
            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, $grupo->getId(), $comparison);
        } elseif ($grupo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, $grupo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGrupoRelatedByOldGrupoId() only accepts arguments of type \Grupo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GrupoRelatedByOldGrupoId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function joinGrupoRelatedByOldGrupoId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GrupoRelatedByOldGrupoId');

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
            $this->addJoinObject($join, 'GrupoRelatedByOldGrupoId');
        }

        return $this;
    }

    /**
     * Use the GrupoRelatedByOldGrupoId relation Grupo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GrupoQuery A secondary query class using the current class as primary query
     */
    public function useGrupoRelatedByOldGrupoIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGrupoRelatedByOldGrupoId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GrupoRelatedByOldGrupoId', '\GrupoQuery');
    }

    /**
     * Use the GrupoRelatedByOldGrupoId relation Grupo object
     *
     * @param callable(\GrupoQuery):\GrupoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGrupoRelatedByOldGrupoIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGrupoRelatedByOldGrupoIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the GrupoRelatedByOldGrupoId relation to the Grupo table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \GrupoQuery The inner query object of the EXISTS statement
     */
    public function useGrupoRelatedByOldGrupoIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('GrupoRelatedByOldGrupoId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the GrupoRelatedByOldGrupoId relation to the Grupo table for a NOT EXISTS query.
     *
     * @see useGrupoRelatedByOldGrupoIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \GrupoQuery The inner query object of the NOT EXISTS statement
     */
    public function useGrupoRelatedByOldGrupoIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('GrupoRelatedByOldGrupoId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildLogEditeGrupoSchedule $logEditeGrupoSchedule Object to remove from the list of results
     *
     * @return $this|ChildLogEditeGrupoScheduleQuery The current query, for fluid interface
     */
    public function prune($logEditeGrupoSchedule = null)
    {
        if ($logEditeGrupoSchedule) {
            $this->addUsingAlias(LogEditeGrupoScheduleTableMap::COL_ID, $logEditeGrupoSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_edite_grupo_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogEditeGrupoScheduleTableMap::clearInstancePool();
            LogEditeGrupoScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogEditeGrupoScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogEditeGrupoScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogEditeGrupoScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogEditeGrupoScheduleQuery
