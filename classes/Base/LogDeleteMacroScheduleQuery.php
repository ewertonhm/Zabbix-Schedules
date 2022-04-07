<?php

namespace Base;

use \LogDeleteMacroSchedule as ChildLogDeleteMacroSchedule;
use \LogDeleteMacroScheduleQuery as ChildLogDeleteMacroScheduleQuery;
use \Exception;
use \PDO;
use Map\LogDeleteMacroScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log_delete_macro_schedule' table.
 *
 *
 *
 * @method     ChildLogDeleteMacroScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogDeleteMacroScheduleQuery orderByMacroScheduleId($order = Criteria::ASC) Order by the macro_schedule_id column
 * @method     ChildLogDeleteMacroScheduleQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 *
 * @method     ChildLogDeleteMacroScheduleQuery groupById() Group by the id column
 * @method     ChildLogDeleteMacroScheduleQuery groupByMacroScheduleId() Group by the macro_schedule_id column
 * @method     ChildLogDeleteMacroScheduleQuery groupByLogId() Group by the log_id column
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogDeleteMacroScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogDeleteMacroScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogDeleteMacroScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogDeleteMacroScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoinLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Log relation
 * @method     ChildLogDeleteMacroScheduleQuery rightJoinLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Log relation
 * @method     ChildLogDeleteMacroScheduleQuery innerJoinLog($relationAlias = null) Adds a INNER JOIN clause to the query using the Log relation
 *
 * @method     ChildLogDeleteMacroScheduleQuery joinWithLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Log relation
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoinWithLog() Adds a LEFT JOIN clause and with to the query using the Log relation
 * @method     ChildLogDeleteMacroScheduleQuery rightJoinWithLog() Adds a RIGHT JOIN clause and with to the query using the Log relation
 * @method     ChildLogDeleteMacroScheduleQuery innerJoinWithLog() Adds a INNER JOIN clause and with to the query using the Log relation
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoinMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildLogDeleteMacroScheduleQuery rightJoinMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildLogDeleteMacroScheduleQuery innerJoinMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the MacroSchedule relation
 *
 * @method     ChildLogDeleteMacroScheduleQuery joinWithMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MacroSchedule relation
 *
 * @method     ChildLogDeleteMacroScheduleQuery leftJoinWithMacroSchedule() Adds a LEFT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildLogDeleteMacroScheduleQuery rightJoinWithMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildLogDeleteMacroScheduleQuery innerJoinWithMacroSchedule() Adds a INNER JOIN clause and with to the query using the MacroSchedule relation
 *
 * @method     \LogQuery|\MacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLogDeleteMacroSchedule|null findOne(ConnectionInterface $con = null) Return the first ChildLogDeleteMacroSchedule matching the query
 * @method     ChildLogDeleteMacroSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLogDeleteMacroSchedule matching the query, or a new ChildLogDeleteMacroSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildLogDeleteMacroSchedule|null findOneById(int $id) Return the first ChildLogDeleteMacroSchedule filtered by the id column
 * @method     ChildLogDeleteMacroSchedule|null findOneByMacroScheduleId(int $macro_schedule_id) Return the first ChildLogDeleteMacroSchedule filtered by the macro_schedule_id column
 * @method     ChildLogDeleteMacroSchedule|null findOneByLogId(int $log_id) Return the first ChildLogDeleteMacroSchedule filtered by the log_id column *

 * @method     ChildLogDeleteMacroSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildLogDeleteMacroSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogDeleteMacroSchedule requireOne(ConnectionInterface $con = null) Return the first ChildLogDeleteMacroSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogDeleteMacroSchedule requireOneById(int $id) Return the first ChildLogDeleteMacroSchedule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogDeleteMacroSchedule requireOneByMacroScheduleId(int $macro_schedule_id) Return the first ChildLogDeleteMacroSchedule filtered by the macro_schedule_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLogDeleteMacroSchedule requireOneByLogId(int $log_id) Return the first ChildLogDeleteMacroSchedule filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLogDeleteMacroSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLogDeleteMacroSchedule objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> find(ConnectionInterface $con = null) Return ChildLogDeleteMacroSchedule objects based on current ModelCriteria
 * @method     ChildLogDeleteMacroSchedule[]|ObjectCollection findById(int $id) Return ChildLogDeleteMacroSchedule objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> findById(int $id) Return ChildLogDeleteMacroSchedule objects filtered by the id column
 * @method     ChildLogDeleteMacroSchedule[]|ObjectCollection findByMacroScheduleId(int $macro_schedule_id) Return ChildLogDeleteMacroSchedule objects filtered by the macro_schedule_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> findByMacroScheduleId(int $macro_schedule_id) Return ChildLogDeleteMacroSchedule objects filtered by the macro_schedule_id column
 * @method     ChildLogDeleteMacroSchedule[]|ObjectCollection findByLogId(int $log_id) Return ChildLogDeleteMacroSchedule objects filtered by the log_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> findByLogId(int $log_id) Return ChildLogDeleteMacroSchedule objects filtered by the log_id column
 * @method     ChildLogDeleteMacroSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLogDeleteMacroSchedule> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogDeleteMacroScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogDeleteMacroScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\LogDeleteMacroSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogDeleteMacroScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogDeleteMacroScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogDeleteMacroScheduleQuery) {
            return $criteria;
        }
        $query = new ChildLogDeleteMacroScheduleQuery();
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
     * @return ChildLogDeleteMacroSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogDeleteMacroScheduleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLogDeleteMacroSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, macro_schedule_id, log_id FROM log_delete_macro_schedule WHERE id = :p0';
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
            /** @var ChildLogDeleteMacroSchedule $obj */
            $obj = new ChildLogDeleteMacroSchedule();
            $obj->hydrate($row);
            LogDeleteMacroScheduleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLogDeleteMacroSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroScheduleId($macroScheduleId = null, $comparison = null)
    {
        if (is_array($macroScheduleId)) {
            $useMinMax = false;
            if (isset($macroScheduleId['min'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($macroScheduleId['max'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroScheduleId, $comparison);
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLogId($logId = null, $comparison = null)
    {
        if (is_array($logId)) {
            $useMinMax = false;
            if (isset($logId['min'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_LOG_ID, $logId, $comparison);
    }

    /**
     * Filter the query by a related \Log object
     *
     * @param \Log|ObjectCollection $log The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByLog($log, $comparison = null)
    {
        if ($log instanceof \Log) {
            return $this
                ->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_LOG_ID, $log->getId(), $comparison);
        } elseif ($log instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_LOG_ID, $log->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
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
     * @return ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function filterByMacroSchedule($macroSchedule, $comparison = null)
    {
        if ($macroSchedule instanceof \MacroSchedule) {
            return $this
                ->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroSchedule->getId(), $comparison);
        } elseif ($macroSchedule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $macroSchedule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
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
     * @param   ChildLogDeleteMacroSchedule $logDeleteMacroSchedule Object to remove from the list of results
     *
     * @return $this|ChildLogDeleteMacroScheduleQuery The current query, for fluid interface
     */
    public function prune($logDeleteMacroSchedule = null)
    {
        if ($logDeleteMacroSchedule) {
            $this->addUsingAlias(LogDeleteMacroScheduleTableMap::COL_ID, $logDeleteMacroSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log_delete_macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogDeleteMacroScheduleTableMap::clearInstancePool();
            LogDeleteMacroScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogDeleteMacroScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogDeleteMacroScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogDeleteMacroScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogDeleteMacroScheduleQuery
