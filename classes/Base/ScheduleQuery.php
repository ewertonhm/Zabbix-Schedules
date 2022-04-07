<?php

namespace Base;

use \Schedule as ChildSchedule;
use \ScheduleQuery as ChildScheduleQuery;
use \Exception;
use \PDO;
use Map\ScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'schedule' table.
 *
 *
 *
 * @method     ChildScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildScheduleQuery orderByOriginalValue($order = Criteria::ASC) Order by the original_value column
 * @method     ChildScheduleQuery orderByNewValue($order = Criteria::ASC) Order by the new_value column
 * @method     ChildScheduleQuery orderByDateFrom($order = Criteria::ASC) Order by the date_from column
 * @method     ChildScheduleQuery orderByDateUntil($order = Criteria::ASC) Order by the date_until column
 * @method     ChildScheduleQuery orderByExecuted($order = Criteria::ASC) Order by the executed column
 * @method     ChildScheduleQuery orderByReverted($order = Criteria::ASC) Order by the reverted column
 *
 * @method     ChildScheduleQuery groupById() Group by the id column
 * @method     ChildScheduleQuery groupByOriginalValue() Group by the original_value column
 * @method     ChildScheduleQuery groupByNewValue() Group by the new_value column
 * @method     ChildScheduleQuery groupByDateFrom() Group by the date_from column
 * @method     ChildScheduleQuery groupByDateUntil() Group by the date_until column
 * @method     ChildScheduleQuery groupByExecuted() Group by the executed column
 * @method     ChildScheduleQuery groupByReverted() Group by the reverted column
 *
 * @method     ChildScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildScheduleQuery leftJoinGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildScheduleQuery rightJoinGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildScheduleQuery innerJoinGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoSchedule relation
 *
 * @method     ChildScheduleQuery joinWithGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildScheduleQuery leftJoinWithGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildScheduleQuery rightJoinWithGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildScheduleQuery innerJoinWithGrupoSchedule() Adds a INNER JOIN clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildScheduleQuery leftJoinHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostSchedule relation
 * @method     ChildScheduleQuery rightJoinHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostSchedule relation
 * @method     ChildScheduleQuery innerJoinHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the HostSchedule relation
 *
 * @method     ChildScheduleQuery joinWithHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostSchedule relation
 *
 * @method     ChildScheduleQuery leftJoinWithHostSchedule() Adds a LEFT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildScheduleQuery rightJoinWithHostSchedule() Adds a RIGHT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildScheduleQuery innerJoinWithHostSchedule() Adds a INNER JOIN clause and with to the query using the HostSchedule relation
 *
 * @method     ChildScheduleQuery leftJoinMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildScheduleQuery rightJoinMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildScheduleQuery innerJoinMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the MacroSchedule relation
 *
 * @method     ChildScheduleQuery joinWithMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MacroSchedule relation
 *
 * @method     ChildScheduleQuery leftJoinWithMacroSchedule() Adds a LEFT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildScheduleQuery rightJoinWithMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildScheduleQuery innerJoinWithMacroSchedule() Adds a INNER JOIN clause and with to the query using the MacroSchedule relation
 *
 * @method     \GrupoScheduleQuery|\HostScheduleQuery|\MacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildSchedule matching the query
 * @method     ChildSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSchedule matching the query, or a new ChildSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildSchedule|null findOneById(int $id) Return the first ChildSchedule filtered by the id column
 * @method     ChildSchedule|null findOneByOriginalValue(string $original_value) Return the first ChildSchedule filtered by the original_value column
 * @method     ChildSchedule|null findOneByNewValue(string $new_value) Return the first ChildSchedule filtered by the new_value column
 * @method     ChildSchedule|null findOneByDateFrom(string $date_from) Return the first ChildSchedule filtered by the date_from column
 * @method     ChildSchedule|null findOneByDateUntil(string $date_until) Return the first ChildSchedule filtered by the date_until column
 * @method     ChildSchedule|null findOneByExecuted(boolean $executed) Return the first ChildSchedule filtered by the executed column
 * @method     ChildSchedule|null findOneByReverted(boolean $reverted) Return the first ChildSchedule filtered by the reverted column *

 * @method     ChildSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOne(ConnectionInterface $con = null) Return the first ChildSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSchedule requireOneById(int $id) Return the first ChildSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByOriginalValue(string $original_value) Return the first ChildSchedule filtered by the original_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByNewValue(string $new_value) Return the first ChildSchedule filtered by the new_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByDateFrom(string $date_from) Return the first ChildSchedule filtered by the date_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByDateUntil(string $date_until) Return the first ChildSchedule filtered by the date_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByExecuted(boolean $executed) Return the first ChildSchedule filtered by the executed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedule requireOneByReverted(boolean $reverted) Return the first ChildSchedule filtered by the reverted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> find(ConnectionInterface $con = null) Return ChildSchedule objects based on current ModelCriteria
 * @method     ChildSchedule[]|ObjectCollection findById(int $id) Return ChildSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findById(int $id) Return ChildSchedule objects filtered by the id column
 * @method     ChildSchedule[]|ObjectCollection findByOriginalValue(string $original_value) Return ChildSchedule objects filtered by the original_value column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByOriginalValue(string $original_value) Return ChildSchedule objects filtered by the original_value column
 * @method     ChildSchedule[]|ObjectCollection findByNewValue(string $new_value) Return ChildSchedule objects filtered by the new_value column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByNewValue(string $new_value) Return ChildSchedule objects filtered by the new_value column
 * @method     ChildSchedule[]|ObjectCollection findByDateFrom(string $date_from) Return ChildSchedule objects filtered by the date_from column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByDateFrom(string $date_from) Return ChildSchedule objects filtered by the date_from column
 * @method     ChildSchedule[]|ObjectCollection findByDateUntil(string $date_until) Return ChildSchedule objects filtered by the date_until column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByDateUntil(string $date_until) Return ChildSchedule objects filtered by the date_until column
 * @method     ChildSchedule[]|ObjectCollection findByExecuted(boolean $executed) Return ChildSchedule objects filtered by the executed column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByExecuted(boolean $executed) Return ChildSchedule objects filtered by the executed column
 * @method     ChildSchedule[]|ObjectCollection findByReverted(boolean $reverted) Return ChildSchedule objects filtered by the reverted column
 * @psalm-method ObjectCollection&\Traversable<ChildSchedule> findByReverted(boolean $reverted) Return ChildSchedule objects filtered by the reverted column
 * @method     ChildSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Schedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildScheduleQuery) {
            return $criteria;
        }
        $query = new ChildScheduleQuery();
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
     * @return ChildSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, original_value, new_value, date_from, date_until, executed, reverted FROM schedule WHERE id = :p0';
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
            /** @var ChildSchedule $obj */
            $obj = new ChildSchedule();
            $obj->hydrate($row);
            ScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the original_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOriginalValue('fooValue');   // WHERE original_value = 'fooValue'
     * $query->filterByOriginalValue('%fooValue%', Criteria::LIKE); // WHERE original_value LIKE '%fooValue%'
     * $query->filterByOriginalValue(['foo', 'bar']); // WHERE original_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $originalValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByOriginalValue($originalValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($originalValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_ORIGINAL_VALUE, $originalValue, $comparison);
    }

    /**
     * Filter the query on the new_value column
     *
     * Example usage:
     * <code>
     * $query->filterByNewValue('fooValue');   // WHERE new_value = 'fooValue'
     * $query->filterByNewValue('%fooValue%', Criteria::LIKE); // WHERE new_value LIKE '%fooValue%'
     * $query->filterByNewValue(['foo', 'bar']); // WHERE new_value IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $newValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByNewValue($newValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_NEW_VALUE, $newValue, $comparison);
    }

    /**
     * Filter the query on the date_from column
     *
     * Example usage:
     * <code>
     * $query->filterByDateFrom('fooValue');   // WHERE date_from = 'fooValue'
     * $query->filterByDateFrom('%fooValue%', Criteria::LIKE); // WHERE date_from LIKE '%fooValue%'
     * $query->filterByDateFrom(['foo', 'bar']); // WHERE date_from IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $dateFrom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByDateFrom($dateFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_DATE_FROM, $dateFrom, $comparison);
    }

    /**
     * Filter the query on the date_until column
     *
     * Example usage:
     * <code>
     * $query->filterByDateUntil('fooValue');   // WHERE date_until = 'fooValue'
     * $query->filterByDateUntil('%fooValue%', Criteria::LIKE); // WHERE date_until LIKE '%fooValue%'
     * $query->filterByDateUntil(['foo', 'bar']); // WHERE date_until IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $dateUntil The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByDateUntil($dateUntil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateUntil)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_DATE_UNTIL, $dateUntil, $comparison);
    }

    /**
     * Filter the query on the executed column
     *
     * Example usage:
     * <code>
     * $query->filterByExecuted(true); // WHERE executed = true
     * $query->filterByExecuted('yes'); // WHERE executed = true
     * </code>
     *
     * @param     boolean|string $executed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByExecuted($executed = null, $comparison = null)
    {
        if (is_string($executed)) {
            $executed = in_array(strtolower($executed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_EXECUTED, $executed, $comparison);
    }

    /**
     * Filter the query on the reverted column
     *
     * Example usage:
     * <code>
     * $query->filterByReverted(true); // WHERE reverted = true
     * $query->filterByReverted('yes'); // WHERE reverted = true
     * </code>
     *
     * @param     boolean|string $reverted The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByReverted($reverted = null, $comparison = null)
    {
        if (is_string($reverted)) {
            $reverted = in_array(strtolower($reverted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ScheduleTableMap::COL_REVERTED, $reverted, $comparison);
    }

    /**
     * Filter the query by a related \GrupoSchedule object
     *
     * @param \GrupoSchedule|ObjectCollection $grupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByGrupoSchedule($grupoSchedule, $comparison = null)
    {
        if ($grupoSchedule instanceof \GrupoSchedule) {
            return $this
                ->addUsingAlias(ScheduleTableMap::COL_ID, $grupoSchedule->getScheduleId(), $comparison);
        } elseif ($grupoSchedule instanceof ObjectCollection) {
            return $this
                ->useGrupoScheduleQuery()
                ->filterByPrimaryKeys($grupoSchedule->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \HostSchedule object
     *
     * @param \HostSchedule|ObjectCollection $hostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByHostSchedule($hostSchedule, $comparison = null)
    {
        if ($hostSchedule instanceof \HostSchedule) {
            return $this
                ->addUsingAlias(ScheduleTableMap::COL_ID, $hostSchedule->getScheduleId(), $comparison);
        } elseif ($hostSchedule instanceof ObjectCollection) {
            return $this
                ->useHostScheduleQuery()
                ->filterByPrimaryKeys($hostSchedule->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \MacroSchedule object
     *
     * @param \MacroSchedule|ObjectCollection $macroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroSchedule($macroSchedule, $comparison = null)
    {
        if ($macroSchedule instanceof \MacroSchedule) {
            return $this
                ->addUsingAlias(ScheduleTableMap::COL_ID, $macroSchedule->getScheduleId(), $comparison);
        } elseif ($macroSchedule instanceof ObjectCollection) {
            return $this
                ->useMacroScheduleQuery()
                ->filterByPrimaryKeys($macroSchedule->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildScheduleQuery The current query, for fluid interface
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
     * @param   ChildSchedule $schedule Object to remove from the list of results
     *
     * @return $this|ChildScheduleQuery The current query, for fluid interface
     */
    public function prune($schedule = null)
    {
        if ($schedule) {
            $this->addUsingAlias(ScheduleTableMap::COL_ID, $schedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ScheduleTableMap::clearInstancePool();
            ScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ScheduleQuery
