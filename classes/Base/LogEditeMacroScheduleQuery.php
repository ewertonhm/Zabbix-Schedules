<?php

namespace Base;

use \LogEditeMacroSchedule as ChildLogEditeMacroSchedule;
use \LogEditeMacroScheduleQuery as ChildLogEditeMacroScheduleQuery;
use \Exception;
use \PDO;
use Map\LogEditeMacroScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_edite_macro_schedule' table.
 *
 *
 *
 * @method     ChildLogEditeMacroScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogEditeMacroScheduleQuery orderByMacroScheduleId($order = Criteria::ASC) Order by the macro_schedule_id column
 * @method     ChildLogEditeMacroScheduleQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 * @method     ChildLogEditeMacroScheduleQuery orderByOldDateFrom($order = Criteria::ASC) Order by the old_date_from column
 * @method     ChildLogEditeMacroScheduleQuery orderByNewDateFrom($order = Criteria::ASC) Order by the new_date_from column
 * @method     ChildLogEditeMacroScheduleQuery orderByOldDateUntil($order = Criteria::ASC) Order by the old_date_until column
 * @method     ChildLogEditeMacroScheduleQuery orderByNewDateUntil($order = Criteria::ASC) Order by the new_date_until column
 * @method     ChildLogEditeMacroScheduleQuery orderByOldOriginalValue($order = Criteria::ASC) Order by the old_original_value column
 * @method     ChildLogEditeMacroScheduleQuery orderByNewOriginalValue($order = Criteria::ASC) Order by the new_original_value column
 * @method     ChildLogEditeMacroScheduleQuery orderByOldNewValue($order = Criteria::ASC) Order by the old_new_value column
 * @method     ChildLogEditeMacroScheduleQuery orderByNewNewValue($order = Criteria::ASC) Order by the new_new_value column
 *
 * @method     ChildLogEditeMacroScheduleQuery groupById() Group by the id column
 * @method     ChildLogEditeMacroScheduleQuery groupByMacroScheduleId() Group by the macro_schedule_id column
 * @method     ChildLogEditeMacroScheduleQuery groupByLogId() Group by the log_id column
 * @method     ChildLogEditeMacroScheduleQuery groupByOldDateFrom() Group by the old_date_from column
 * @method     ChildLogEditeMacroScheduleQuery groupByNewDateFrom() Group by the new_date_from column
 * @method     ChildLogEditeMacroScheduleQuery groupByOldDateUntil() Group by the old_date_until column
 * @method     ChildLogEditeMacroScheduleQuery groupByNewDateUntil() Group by the new_date_until column
 * @method     ChildLogEditeMacroScheduleQuery groupByOldOriginalValue() Group by the old_original_value column
 * @method     ChildLogEditeMacroScheduleQuery groupByNewOriginalValue() Group by the new_original_value column
 * @method     ChildLogEditeMacroScheduleQuery groupByOldNewValue() Group by the old_new_value column
 * @method     ChildLogEditeMacroScheduleQuery groupByNewNewValue() Group by the new_new_value column
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogEditeMacroScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogEditeMacroScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogEditeMacroScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogEditeMacroScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoinLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Log relation
 * @method     ChildLogEditeMacroScheduleQuery rightJoinLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Log relation
 * @method     ChildLogEditeMacroScheduleQuery innerJoinLog($relationAlias = null) Adds a INNER JOIN clause to the query using the Log relation
 *
 * @method     ChildLogEditeMacroScheduleQuery joinWithLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Log relation
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoinWithLog() Adds a LEFT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditeMacroScheduleQuery rightJoinWithLog() Adds a RIGHT JOIN clause and with to the query using the Log relation
 * @method     ChildLogEditeMacroScheduleQuery innerJoinWithLog() Adds a INNER JOIN clause and with to the query using the Log relation
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoinMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildLogEditeMacroScheduleQuery rightJoinMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildLogEditeMacroScheduleQuery innerJoinMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the MacroSchedule relation
 *
 * @method     ChildLogEditeMacroScheduleQuery joinWithMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MacroSchedule relation
 *
 * @method     ChildLogEditeMacroScheduleQuery leftJoinWithMacroSchedule() Adds a LEFT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildLogEditeMacroScheduleQuery rightJoinWithMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildLogEditeMacroScheduleQuery innerJoinWithMacroSchedule() Adds a INNER JOIN clause and with to the query using the MacroSchedule relation
 *
 * @method     \LogQuery|\MacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogEditeMacroSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildLogEditeMacroSchedule matching the query
 * @method     ChildLogEditeMacroSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogEditeMacroSchedule matching the query, or a new ChildLogEditeMacroSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildLogEditeMacroSchedule|null findOneById(int $id) Return the first ChildLogEditeMacroSchedule filtered by the id column
 * @method     ChildLogEditeMacroSchedule|null findOneByMacroScheduleId(int $macro_schedule_id) Return the first ChildLogEditeMacroSchedule filtered by the macro_schedule_id column
 * @method     ChildLogEditeMacroSchedule|null findOneByLogId(int $log_id) Return the first ChildLogEditeMacroSchedule filtered by the log_id column
 * @method     ChildLogEditeMacroSchedule|null findOneByOldDateFrom(string $old_date_from) Return the first ChildLogEditeMacroSchedule filtered by the old_date_from column
 * @method     ChildLogEditeMacroSchedule|null findOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditeMacroSchedule filtered by the new_date_from column
 * @method     ChildLogEditeMacroSchedule|null findOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditeMacroSchedule filtered by the old_date_until column
 * @method     ChildLogEditeMacroSchedule|null findOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditeMacroSchedule filtered by the new_date_until column
 * @method     ChildLogEditeMacroSchedule|null findOneByOldOriginalValue(string $old_original_value) Return the first ChildLogEditeMacroSchedule filtered by the old_original_value column
 * @method     ChildLogEditeMacroSchedule|null findOneByNewOriginalValue(string $new_original_value) Return the first ChildLogEditeMacroSchedule filtered by the new_original_value column
 * @method     ChildLogEditeMacroSchedule|null findOneByOldNewValue(string $old_new_value) Return the first ChildLogEditeMacroSchedule filtered by the old_new_value column
 * @method     ChildLogEditeMacroSchedule|null findOneByNewNewValue(string $new_new_value) Return the first ChildLogEditeMacroSchedule filtered by the new_new_value column *

 * @method     ChildLogEditeMacroSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildLogEditeMacroSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOne(ConnectionInterface $con = null) Return the first ChildLogEditeMacroSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditeMacroSchedule requireOneById(int $id) Return the first ChildLogEditeMacroSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByMacroScheduleId(int $macro_schedule_id) Return the first ChildLogEditeMacroSchedule filtered by the macro_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByLogId(int $log_id) Return the first ChildLogEditeMacroSchedule filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByOldDateFrom(string $old_date_from) Return the first ChildLogEditeMacroSchedule filtered by the old_date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByNewDateFrom(string $new_date_from) Return the first ChildLogEditeMacroSchedule filtered by the new_date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByOldDateUntil(string $old_date_until) Return the first ChildLogEditeMacroSchedule filtered by the old_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByNewDateUntil(string $new_date_until) Return the first ChildLogEditeMacroSchedule filtered by the new_date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByOldOriginalValue(string $old_original_value) Return the first ChildLogEditeMacroSchedule filtered by the old_original_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByNewOriginalValue(string $new_original_value) Return the first ChildLogEditeMacroSchedule filtered by the new_original_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByOldNewValue(string $old_new_value) Return the first ChildLogEditeMacroSchedule filtered by the old_new_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogEditeMacroSchedule requireOneByNewNewValue(string $new_new_value) Return the first ChildLogEditeMacroSchedule filtered by the new_new_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogEditeMacroSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> find(ConnectionInterface $con = null) Return ChildLogEditeMacroSchedule objects based on current ModelCriteria
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findById(int $id) Return ChildLogEditeMacroSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findById(int $id) Return ChildLogEditeMacroSchedule objects filtered by the id column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByMacroScheduleId(int $macro_schedule_id) Return ChildLogEditeMacroSchedule objects filtered by the macro_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByMacroScheduleId(int $macro_schedule_id) Return ChildLogEditeMacroSchedule objects filtered by the macro_schedule_id column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByLogId(int $log_id) Return ChildLogEditeMacroSchedule objects filtered by the log_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByLogId(int $log_id) Return ChildLogEditeMacroSchedule objects filtered by the log_id column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByOldDateFrom(string $old_date_from) Return ChildLogEditeMacroSchedule objects filtered by the old_date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByOldDateFrom(string $old_date_from) Return ChildLogEditeMacroSchedule objects filtered by the old_date_from column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByNewDateFrom(string $new_date_from) Return ChildLogEditeMacroSchedule objects filtered by the new_date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByNewDateFrom(string $new_date_from) Return ChildLogEditeMacroSchedule objects filtered by the new_date_from column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByOldDateUntil(string $old_date_until) Return ChildLogEditeMacroSchedule objects filtered by the old_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByOldDateUntil(string $old_date_until) Return ChildLogEditeMacroSchedule objects filtered by the old_date_until column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByNewDateUntil(string $new_date_until) Return ChildLogEditeMacroSchedule objects filtered by the new_date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByNewDateUntil(string $new_date_until) Return ChildLogEditeMacroSchedule objects filtered by the new_date_until column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByOldOriginalValue(string $old_original_value) Return ChildLogEditeMacroSchedule objects filtered by the old_original_value column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByOldOriginalValue(string $old_original_value) Return ChildLogEditeMacroSchedule objects filtered by the old_original_value column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByNewOriginalValue(string $new_original_value) Return ChildLogEditeMacroSchedule objects filtered by the new_original_value column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByNewOriginalValue(string $new_original_value) Return ChildLogEditeMacroSchedule objects filtered by the new_original_value column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByOldNewValue(string $old_new_value) Return ChildLogEditeMacroSchedule objects filtered by the old_new_value column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByOldNewValue(string $old_new_value) Return ChildLogEditeMacroSchedule objects filtered by the old_new_value column
 * @method     ChildLogEditeMacroSchedule[]|ObjectCollection findByNewNewValue(string $new_new_value) Return ChildLogEditeMacroSchedule objects filtered by the new_new_value column
 * @psalm-method ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> findByNewNewValue(string $new_new_value) Return ChildLogEditeMacroSchedule objects filtered by the new_new_value column
 * @method     ChildLogEditeMacroSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogEditeMacroSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogEditeMacroScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogEditeMacroScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogEditeMacroSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogEditeMacroScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogEditeMacroScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogEditeMacroScheduleQuery) {
            return $criteria;
        }
        $query = new ChildLogEditeMacroScheduleQuery();
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
     * @return ChildLogEditeMacroSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogEditeMacroScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogEditeMacroSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, macro_schedule_id, log_id, old_date_from, new_date_from, old_date_until, new_date_until, old_original_value, new_original_value, old_new_value, new_new_value FROM log_edite_macro_schedule WHERE id = :p0';
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
            /** @var ChildLogEditeMacroSchedule $obj */
            $obj = new ChildLogEditeMacroSchedule();
            $obj->hydrate($row);
            LogEditeMacroScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogEditeMacroSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the macro_schedule_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMacroScheduleId(1234); // WHERE macro_schedule_id = 1234
     * $query->filterByMacroScheduleId(array(12, 34)); // WHERE macro_schedule_id IN (12, 34)
     * $query->filterByMacroScheduleId(array('min' => 12)); // WHERE macro_schedule_id > 12
     * </code>
     *
     * @see       filterByMacroSchedule()
     *
     * @param     mixed $macroScheduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroScheduleId($macroScheduleId = null, $comparison = null)
    {
        if (is_array($macroScheduleId)) {
            $useMinMax = false;
            if (isset($macroScheduleId['min'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($macroScheduleId['max'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId, $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLogId($logId = null, $comparison = null)
    {
        if (is_array($logId)) {
            $useMinMax = false;
            if (isset($logId['min'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_LOG_ID, $logId, $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDateFrom($oldDateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM, $oldDateFrom, $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateFrom($newDateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM, $newDateFrom, $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByOldDateUntil($oldDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL, $oldDateUntil, $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByNewDateUntil($newDateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newDateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL, $newDateUntil, $comparison);
    }

    /**
     * Filter the query on the old_original_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOldOriginalValue('fooValue');   // WHERE old_original_value = 'fooValue'
     * $query->filterByOldOriginalValue('%fooValue%', Criteria::LIKE); // WHERE old_original_value LIKE '%fooValue%'
     * $query->filterByOldOriginalValue(['foo', 'bar']); // WHERE old_original_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldOriginalValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByOldOriginalValue($oldOriginalValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldOriginalValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE, $oldOriginalValue, $comparison);
    }

    /**
     * Filter the query on the new_original_value column
     *
     * Example usage:
     * <code>
     * $query->filterByNewOriginalValue('fooValue');   // WHERE new_original_value = 'fooValue'
     * $query->filterByNewOriginalValue('%fooValue%', Criteria::LIKE); // WHERE new_original_value LIKE '%fooValue%'
     * $query->filterByNewOriginalValue(['foo', 'bar']); // WHERE new_original_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newOriginalValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByNewOriginalValue($newOriginalValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newOriginalValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE, $newOriginalValue, $comparison);
    }

    /**
     * Filter the query on the old_new_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOldNewValue('fooValue');   // WHERE old_new_value = 'fooValue'
     * $query->filterByOldNewValue('%fooValue%', Criteria::LIKE); // WHERE old_new_value LIKE '%fooValue%'
     * $query->filterByOldNewValue(['foo', 'bar']); // WHERE old_new_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $oldNewValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByOldNewValue($oldNewValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldNewValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE, $oldNewValue, $comparison);
    }

    /**
     * Filter the query on the new_new_value column
     *
     * Example usage:
     * <code>
     * $query->filterByNewNewValue('fooValue');   // WHERE new_new_value = 'fooValue'
     * $query->filterByNewNewValue('%fooValue%', Criteria::LIKE); // WHERE new_new_value LIKE '%fooValue%'
     * $query->filterByNewNewValue(['foo', 'bar']); // WHERE new_new_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newNewValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByNewNewValue($newNewValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newNewValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE, $newNewValue, $comparison);
    }

    /**
     * Filter the query by a related \Log object
     *
     * @param \Log|ObjectCollection $log The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLog($log, $comparison = null)
    {
        if ($log instanceof \Log) {
            return $this
                ->addUsingAlias(LogEditeMacroScheduleTableMap::COL_LOG_ID, $log->getId(), $comparison);
        } elseif ($log instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeMacroScheduleTableMap::COL_LOG_ID, $log->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \MacroSchedule object
     *
     * @param \MacroSchedule|ObjectCollection $macroSchedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroSchedule($macroSchedule, $comparison = null)
    {
        if ($macroSchedule instanceof \MacroSchedule) {
            return $this
                ->addUsingAlias(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroSchedule->getId(), $comparison);
        } elseif ($macroSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMacroSchedule() only accepts arguments of type \MacroSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MacroSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function joinMacroSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MacroSchedule');

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
            $this->addJoinObject($join, 'MacroSchedule');
        }

        return $this;
    }

    /**
     * Use the MacroSchedule relation MacroSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MacroScheduleQuery A secondary query class using the current class as primary query
     */
    public function useMacroScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMacroSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MacroSchedule', '\MacroScheduleQuery');
    }

    /**
     * Use the MacroSchedule relation MacroSchedule object
     *
     * @param callable(\MacroScheduleQuery):\MacroScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMacroScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMacroScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to MacroSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \MacroScheduleQuery The inner query object of the EXISTS statement
     */
    public function useMacroScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('MacroSchedule', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to MacroSchedule table for a NOT EXISTS query.
     *
     * @see useMacroScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \MacroScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useMacroScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('MacroSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildLogEditeMacroSchedule $logEditeMacroSchedule Object to remove from the list of results
     *
     * @return $this|ChildLogEditeMacroScheduleQuery The current query, for fluid interface
     */
    public function prune($logEditeMacroSchedule = null)
    {
        if ($logEditeMacroSchedule) {
            $this->addUsingAlias(LogEditeMacroScheduleTableMap::COL_ID, $logEditeMacroSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_edite_macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogEditeMacroScheduleTableMap::clearInstancePool();
            LogEditeMacroScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogEditeMacroScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogEditeMacroScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogEditeMacroScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogEditeMacroScheduleQuery
