<?php

namespace Base;

use \Host as ChildHost;
use \HostQuery as ChildHostQuery;
use \Exception;
use \PDO;
use Map\HostTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'host' table.
 *
 *
 *
 * @method     ChildHostQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHostQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildHostQuery orderByZabbixid($order = Criteria::ASC) Order by the zabbixid column
 *
 * @method     ChildHostQuery groupById() Group by the id column
 * @method     ChildHostQuery groupByNome() Group by the nome column
 * @method     ChildHostQuery groupByZabbixid() Group by the zabbixid column
 *
 * @method     ChildHostQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHostQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHostQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHostQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHostQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHostQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHostQuery leftJoinHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the HostSchedule relation
 * @method     ChildHostQuery rightJoinHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HostSchedule relation
 * @method     ChildHostQuery innerJoinHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the HostSchedule relation
 *
 * @method     ChildHostQuery joinWithHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HostSchedule relation
 *
 * @method     ChildHostQuery leftJoinWithHostSchedule() Adds a LEFT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildHostQuery rightJoinWithHostSchedule() Adds a RIGHT JOIN clause and with to the query using the HostSchedule relation
 * @method     ChildHostQuery innerJoinWithHostSchedule() Adds a INNER JOIN clause and with to the query using the HostSchedule relation
 *
 * @method     ChildHostQuery leftJoinLogEditHostScheduleRelatedByNewHostId($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditHostScheduleRelatedByNewHostId relation
 * @method     ChildHostQuery rightJoinLogEditHostScheduleRelatedByNewHostId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditHostScheduleRelatedByNewHostId relation
 * @method     ChildHostQuery innerJoinLogEditHostScheduleRelatedByNewHostId($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditHostScheduleRelatedByNewHostId relation
 *
 * @method     ChildHostQuery joinWithLogEditHostScheduleRelatedByNewHostId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditHostScheduleRelatedByNewHostId relation
 *
 * @method     ChildHostQuery leftJoinWithLogEditHostScheduleRelatedByNewHostId() Adds a LEFT JOIN clause and with to the query using the LogEditHostScheduleRelatedByNewHostId relation
 * @method     ChildHostQuery rightJoinWithLogEditHostScheduleRelatedByNewHostId() Adds a RIGHT JOIN clause and with to the query using the LogEditHostScheduleRelatedByNewHostId relation
 * @method     ChildHostQuery innerJoinWithLogEditHostScheduleRelatedByNewHostId() Adds a INNER JOIN clause and with to the query using the LogEditHostScheduleRelatedByNewHostId relation
 *
 * @method     ChildHostQuery leftJoinLogEditHostScheduleRelatedByOldHostId($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditHostScheduleRelatedByOldHostId relation
 * @method     ChildHostQuery rightJoinLogEditHostScheduleRelatedByOldHostId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditHostScheduleRelatedByOldHostId relation
 * @method     ChildHostQuery innerJoinLogEditHostScheduleRelatedByOldHostId($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditHostScheduleRelatedByOldHostId relation
 *
 * @method     ChildHostQuery joinWithLogEditHostScheduleRelatedByOldHostId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditHostScheduleRelatedByOldHostId relation
 *
 * @method     ChildHostQuery leftJoinWithLogEditHostScheduleRelatedByOldHostId() Adds a LEFT JOIN clause and with to the query using the LogEditHostScheduleRelatedByOldHostId relation
 * @method     ChildHostQuery rightJoinWithLogEditHostScheduleRelatedByOldHostId() Adds a RIGHT JOIN clause and with to the query using the LogEditHostScheduleRelatedByOldHostId relation
 * @method     ChildHostQuery innerJoinWithLogEditHostScheduleRelatedByOldHostId() Adds a INNER JOIN clause and with to the query using the LogEditHostScheduleRelatedByOldHostId relation
 *
 * @method     ChildHostQuery leftJoinMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildHostQuery rightJoinMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildHostQuery innerJoinMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the MacroSchedule relation
 *
 * @method     ChildHostQuery joinWithMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MacroSchedule relation
 *
 * @method     ChildHostQuery leftJoinWithMacroSchedule() Adds a LEFT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildHostQuery rightJoinWithMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildHostQuery innerJoinWithMacroSchedule() Adds a INNER JOIN clause and with to the query using the MacroSchedule relation
 *
 * @method     \HostScheduleQuery|\LogEditHostScheduleQuery|\MacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHost|null findOne(ConnectionInterface $con = null) Return the first ChildHost matching the query
 * @method     ChildHost findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHost matching the query, or a new ChildHost object populated from the query conditions when no match is found
 *
 * @method     ChildHost|null findOneById(int $id) Return the first ChildHost filtered by the id column
 * @method     ChildHost|null findOneByNome(string $nome) Return the first ChildHost filtered by the nome column
 * @method     ChildHost|null findOneByZabbixid(string $zabbixid) Return the first ChildHost filtered by the zabbixid column *

 * @method     ChildHost requirePk($key, ConnectionInterface $con = null) Return the ChildHost by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHost requireOne(ConnectionInterface $con = null) Return the first ChildHost matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHost requireOneById(int $id) Return the first ChildHost filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHost requireOneByNome(string $nome) Return the first ChildHost filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHost requireOneByZabbixid(string $zabbixid) Return the first ChildHost filtered by the zabbixid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHost[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHost objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildHost> find(ConnectionInterface $con = null) Return ChildHost objects based on current ModelCriteria
 * @method     ChildHost[]|ObjectCollection findById(int $id) Return ChildHost objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildHost> findById(int $id) Return ChildHost objects filtered by the id column
 * @method     ChildHost[]|ObjectCollection findByNome(string $nome) Return ChildHost objects filtered by the nome column
 * @psalm-method ObjectCollection&\Traversable<ChildHost> findByNome(string $nome) Return ChildHost objects filtered by the nome column
 * @method     ChildHost[]|ObjectCollection findByZabbixid(string $zabbixid) Return ChildHost objects filtered by the zabbixid column
 * @psalm-method ObjectCollection&\Traversable<ChildHost> findByZabbixid(string $zabbixid) Return ChildHost objects filtered by the zabbixid column
 * @method     ChildHost[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHost> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HostQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\HostQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Host', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHostQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHostQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHostQuery) {
            return $criteria;
        }
        $query = new ChildHostQuery();
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
     * @return ChildHost|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HostTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HostTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHost A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, zabbixid FROM host WHERE id = :p0';
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
            /** @var ChildHost $obj */
            $obj = new ChildHost();
            $obj->hydrate($row);
            HostTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHost|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HostTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HostTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HostTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HostTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%', Criteria::LIKE); // WHERE nome LIKE '%fooValue%'
     * $query->filterByNome(['foo', 'bar']); // WHERE nome IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $nome The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the zabbixid column
     *
     * Example usage:
     * <code>
     * $query->filterByZabbixid('fooValue');   // WHERE zabbixid = 'fooValue'
     * $query->filterByZabbixid('%fooValue%', Criteria::LIKE); // WHERE zabbixid LIKE '%fooValue%'
     * $query->filterByZabbixid(['foo', 'bar']); // WHERE zabbixid IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $zabbixid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function filterByZabbixid($zabbixid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zabbixid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HostTableMap::COL_ZABBIXID, $zabbixid, $comparison);
    }

    /**
     * Filter the query by a related \HostSchedule object
     *
     * @param \HostSchedule|ObjectCollection $hostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostQuery The current query, for fluid interface
     */
    public function filterByHostSchedule($hostSchedule, $comparison = null)
    {
        if ($hostSchedule instanceof \HostSchedule) {
            return $this
                ->addUsingAlias(HostTableMap::COL_ID, $hostSchedule->getHostId(), $comparison);
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
     * @return $this|ChildHostQuery The current query, for fluid interface
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
     * Filter the query by a related \LogEditHostSchedule object
     *
     * @param \LogEditHostSchedule|ObjectCollection $logEditHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostQuery The current query, for fluid interface
     */
    public function filterByLogEditHostScheduleRelatedByNewHostId($logEditHostSchedule, $comparison = null)
    {
        if ($logEditHostSchedule instanceof \LogEditHostSchedule) {
            return $this
                ->addUsingAlias(HostTableMap::COL_ID, $logEditHostSchedule->getNewHostId(), $comparison);
        } elseif ($logEditHostSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditHostScheduleRelatedByNewHostIdQuery()
                ->filterByPrimaryKeys($logEditHostSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditHostScheduleRelatedByNewHostId() only accepts arguments of type \LogEditHostSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditHostScheduleRelatedByNewHostId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function joinLogEditHostScheduleRelatedByNewHostId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditHostScheduleRelatedByNewHostId');

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
            $this->addJoinObject($join, 'LogEditHostScheduleRelatedByNewHostId');
        }

        return $this;
    }

    /**
     * Use the LogEditHostScheduleRelatedByNewHostId relation LogEditHostSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditHostScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditHostScheduleRelatedByNewHostIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditHostScheduleRelatedByNewHostId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditHostScheduleRelatedByNewHostId', '\LogEditHostScheduleQuery');
    }

    /**
     * Use the LogEditHostScheduleRelatedByNewHostId relation LogEditHostSchedule object
     *
     * @param callable(\LogEditHostScheduleQuery):\LogEditHostScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditHostScheduleRelatedByNewHostIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditHostScheduleRelatedByNewHostIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the LogEditHostScheduleRelatedByNewHostId relation to the LogEditHostSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditHostScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditHostScheduleRelatedByNewHostIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditHostScheduleRelatedByNewHostId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the LogEditHostScheduleRelatedByNewHostId relation to the LogEditHostSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditHostScheduleRelatedByNewHostIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditHostScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditHostScheduleRelatedByNewHostIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditHostScheduleRelatedByNewHostId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogEditHostSchedule object
     *
     * @param \LogEditHostSchedule|ObjectCollection $logEditHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostQuery The current query, for fluid interface
     */
    public function filterByLogEditHostScheduleRelatedByOldHostId($logEditHostSchedule, $comparison = null)
    {
        if ($logEditHostSchedule instanceof \LogEditHostSchedule) {
            return $this
                ->addUsingAlias(HostTableMap::COL_ID, $logEditHostSchedule->getOldHostId(), $comparison);
        } elseif ($logEditHostSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditHostScheduleRelatedByOldHostIdQuery()
                ->filterByPrimaryKeys($logEditHostSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditHostScheduleRelatedByOldHostId() only accepts arguments of type \LogEditHostSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditHostScheduleRelatedByOldHostId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function joinLogEditHostScheduleRelatedByOldHostId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditHostScheduleRelatedByOldHostId');

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
            $this->addJoinObject($join, 'LogEditHostScheduleRelatedByOldHostId');
        }

        return $this;
    }

    /**
     * Use the LogEditHostScheduleRelatedByOldHostId relation LogEditHostSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditHostScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditHostScheduleRelatedByOldHostIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditHostScheduleRelatedByOldHostId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditHostScheduleRelatedByOldHostId', '\LogEditHostScheduleQuery');
    }

    /**
     * Use the LogEditHostScheduleRelatedByOldHostId relation LogEditHostSchedule object
     *
     * @param callable(\LogEditHostScheduleQuery):\LogEditHostScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditHostScheduleRelatedByOldHostIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditHostScheduleRelatedByOldHostIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the LogEditHostScheduleRelatedByOldHostId relation to the LogEditHostSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditHostScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditHostScheduleRelatedByOldHostIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditHostScheduleRelatedByOldHostId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the LogEditHostScheduleRelatedByOldHostId relation to the LogEditHostSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditHostScheduleRelatedByOldHostIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditHostScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditHostScheduleRelatedByOldHostIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditHostScheduleRelatedByOldHostId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \MacroSchedule object
     *
     * @param \MacroSchedule|ObjectCollection $macroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHostQuery The current query, for fluid interface
     */
    public function filterByMacroSchedule($macroSchedule, $comparison = null)
    {
        if ($macroSchedule instanceof \MacroSchedule) {
            return $this
                ->addUsingAlias(HostTableMap::COL_ID, $macroSchedule->getHostId(), $comparison);
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
     * @return $this|ChildHostQuery The current query, for fluid interface
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
     * @param   ChildHost $host Object to remove from the list of results
     *
     * @return $this|ChildHostQuery The current query, for fluid interface
     */
    public function prune($host = null)
    {
        if ($host) {
            $this->addUsingAlias(HostTableMap::COL_ID, $host->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the host table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HostTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HostTableMap::clearInstancePool();
            HostTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HostTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HostTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HostTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HostTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HostQuery
