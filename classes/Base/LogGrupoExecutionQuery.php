<?php

namespace Base;

use \LogGrupoExecution as ChildLogGrupoExecution;
use \LogGrupoExecutionQuery as ChildLogGrupoExecutionQuery;
use \Exception;
use \PDO;
use Map\LogGrupoExecutionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_grupo_execution' table.
 *
 *
 *
 * @method     ChildLogGrupoExecutionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogGrupoExecutionQuery orderByGrupoScheduleId($order = Criteria::ASC) Order by the grupo_schedule_id column
 * @method     ChildLogGrupoExecutionQuery orderByPushPop($order = Criteria::ASC) Order by the push_pop column
 * @method     ChildLogGrupoExecutionQuery orderByLogtime($order = Criteria::ASC) Order by the logtime column
 * @method     ChildLogGrupoExecutionQuery orderByDetails($order = Criteria::ASC) Order by the details column
 *
 * @method     ChildLogGrupoExecutionQuery groupById() Group by the id column
 * @method     ChildLogGrupoExecutionQuery groupByGrupoScheduleId() Group by the grupo_schedule_id column
 * @method     ChildLogGrupoExecutionQuery groupByPushPop() Group by the push_pop column
 * @method     ChildLogGrupoExecutionQuery groupByLogtime() Group by the logtime column
 * @method     ChildLogGrupoExecutionQuery groupByDetails() Group by the details column
 *
 * @method     ChildLogGrupoExecutionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogGrupoExecutionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogGrupoExecutionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogGrupoExecutionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogGrupoExecutionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogGrupoExecutionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogGrupoExecutionQuery leftJoinGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildLogGrupoExecutionQuery rightJoinGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildLogGrupoExecutionQuery innerJoinGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoSchedule relation
 *
 * @method     ChildLogGrupoExecutionQuery joinWithGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildLogGrupoExecutionQuery leftJoinWithGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildLogGrupoExecutionQuery rightJoinWithGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildLogGrupoExecutionQuery innerJoinWithGrupoSchedule() Adds a INNER JOIN clause and with to the query using the GrupoSchedule relation
 *
 * @method     \GrupoScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogGrupoExecution|null findOne(ConnectionInterface $con = null) Return the first ChildLogGrupoExecution matching the query
 * @method     ChildLogGrupoExecution findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogGrupoExecution matching the query, or a new ChildLogGrupoExecution object populated from the query conditions when no match is found
 *
 * @method     ChildLogGrupoExecution|null findOneById(int $id) Return the first ChildLogGrupoExecution filtered by the id column
 * @method     ChildLogGrupoExecution|null findOneByGrupoScheduleId(int $grupo_schedule_id) Return the first ChildLogGrupoExecution filtered by the grupo_schedule_id column
 * @method     ChildLogGrupoExecution|null findOneByPushPop(string $push_pop) Return the first ChildLogGrupoExecution filtered by the push_pop column
 * @method     ChildLogGrupoExecution|null findOneByLogtime(string $logtime) Return the first ChildLogGrupoExecution filtered by the logtime column
 * @method     ChildLogGrupoExecution|null findOneByDetails(string $details) Return the first ChildLogGrupoExecution filtered by the details column *

 * @method     ChildLogGrupoExecution requirePk($key, ConnectionInterface $con = null) Return the ChildLogGrupoExecution by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogGrupoExecution requireOne(ConnectionInterface $con = null) Return the first ChildLogGrupoExecution matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogGrupoExecution requireOneById(int $id) Return the first ChildLogGrupoExecution filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogGrupoExecution requireOneByGrupoScheduleId(int $grupo_schedule_id) Return the first ChildLogGrupoExecution filtered by the grupo_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogGrupoExecution requireOneByPushPop(string $push_pop) Return the first ChildLogGrupoExecution filtered by the push_pop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogGrupoExecution requireOneByLogtime(string $logtime) Return the first ChildLogGrupoExecution filtered by the logtime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogGrupoExecution requireOneByDetails(string $details) Return the first ChildLogGrupoExecution filtered by the details column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogGrupoExecution[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogGrupoExecution objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> find(ConnectionInterface $con = null) Return ChildLogGrupoExecution objects based on current ModelCriteria
 * @method     ChildLogGrupoExecution[]|ObjectCollection findById(int $id) Return ChildLogGrupoExecution objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> findById(int $id) Return ChildLogGrupoExecution objects filtered by the id column
 * @method     ChildLogGrupoExecution[]|ObjectCollection findByGrupoScheduleId(int $grupo_schedule_id) Return ChildLogGrupoExecution objects filtered by the grupo_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> findByGrupoScheduleId(int $grupo_schedule_id) Return ChildLogGrupoExecution objects filtered by the grupo_schedule_id column
 * @method     ChildLogGrupoExecution[]|ObjectCollection findByPushPop(string $push_pop) Return ChildLogGrupoExecution objects filtered by the push_pop column
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> findByPushPop(string $push_pop) Return ChildLogGrupoExecution objects filtered by the push_pop column
 * @method     ChildLogGrupoExecution[]|ObjectCollection findByLogtime(string $logtime) Return ChildLogGrupoExecution objects filtered by the logtime column
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> findByLogtime(string $logtime) Return ChildLogGrupoExecution objects filtered by the logtime column
 * @method     ChildLogGrupoExecution[]|ObjectCollection findByDetails(string $details) Return ChildLogGrupoExecution objects filtered by the details column
 * @psalm-method ObjectCollection&\Traversable<ChildLogGrupoExecution> findByDetails(string $details) Return ChildLogGrupoExecution objects filtered by the details column
 * @method     ChildLogGrupoExecution[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogGrupoExecution> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogGrupoExecutionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogGrupoExecutionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogGrupoExecution', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogGrupoExecutionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogGrupoExecutionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogGrupoExecutionQuery) {
            return $criteria;
        }
        $query = new ChildLogGrupoExecutionQuery();
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
     * @return ChildLogGrupoExecution|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogGrupoExecutionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogGrupoExecutionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogGrupoExecution A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, grupo_schedule_id, push_pop, logtime, details FROM log_grupo_execution WHERE id = :p0';
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
            /** @var ChildLogGrupoExecution $obj */
            $obj = new ChildLogGrupoExecution();
            $obj->hydrate($row);
            LogGrupoExecutionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogGrupoExecution|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByGrupoScheduleId($grupoScheduleId = null, $comparison = null)
    {
        if (is_array($grupoScheduleId)) {
            $useMinMax = false;
            if (isset($grupoScheduleId['min'])) {
                $this->addUsingAlias(LogGrupoExecutionTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grupoScheduleId['max'])) {
                $this->addUsingAlias(LogGrupoExecutionTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_GRUPO_SCHEDULE_ID, $grupoScheduleId, $comparison);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByPushPop($pushPop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushPop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_PUSH_POP, $pushPop, $comparison);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByLogtime($logtime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logtime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_LOGTIME, $logtime, $comparison);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByDetails($details = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($details)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogGrupoExecutionTableMap::COL_DETAILS, $details, $comparison);
    }

    /**
     * Filter the query by a related \GrupoSchedule object
     *
     * @param \GrupoSchedule|ObjectCollection $grupoSchedule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function filterByGrupoSchedule($grupoSchedule, $comparison = null)
    {
        if ($grupoSchedule instanceof \GrupoSchedule) {
            return $this
                ->addUsingAlias(LogGrupoExecutionTableMap::COL_GRUPO_SCHEDULE_ID, $grupoSchedule->getId(), $comparison);
        } elseif ($grupoSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogGrupoExecutionTableMap::COL_GRUPO_SCHEDULE_ID, $grupoSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildLogGrupoExecution $logGrupoExecution Object to remove from the list of results
     *
     * @return $this|ChildLogGrupoExecutionQuery The current query, for fluid interface
     */
    public function prune($logGrupoExecution = null)
    {
        if ($logGrupoExecution) {
            $this->addUsingAlias(LogGrupoExecutionTableMap::COL_ID, $logGrupoExecution->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_grupo_execution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogGrupoExecutionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogGrupoExecutionTableMap::clearInstancePool();
            LogGrupoExecutionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogGrupoExecutionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogGrupoExecutionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogGrupoExecutionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogGrupoExecutionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogGrupoExecutionQuery
