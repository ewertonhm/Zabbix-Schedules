<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \Exception;
use \PDO;
use Map\GrupoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'grupo' table.
 *
 *
 *
 * @method     ChildGrupoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGrupoQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildGrupoQuery orderByZabbixid($order = Criteria::ASC) Order by the zabbixid column
 *
 * @method     ChildGrupoQuery groupById() Group by the id column
 * @method     ChildGrupoQuery groupByNome() Group by the nome column
 * @method     ChildGrupoQuery groupByZabbixid() Group by the zabbixid column
 *
 * @method     ChildGrupoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGrupoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGrupoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGrupoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGrupoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGrupoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGrupoQuery leftJoinGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildGrupoQuery rightJoinGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GrupoSchedule relation
 * @method     ChildGrupoQuery innerJoinGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the GrupoSchedule relation
 *
 * @method     ChildGrupoQuery joinWithGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildGrupoQuery leftJoinWithGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildGrupoQuery rightJoinWithGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the GrupoSchedule relation
 * @method     ChildGrupoQuery innerJoinWithGrupoSchedule() Adds a INNER JOIN clause and with to the query using the GrupoSchedule relation
 *
 * @method     ChildGrupoQuery leftJoinLogEditeGrupoScheduleRelatedByNewGrupoId($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 * @method     ChildGrupoQuery rightJoinLogEditeGrupoScheduleRelatedByNewGrupoId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 * @method     ChildGrupoQuery innerJoinLogEditeGrupoScheduleRelatedByNewGrupoId($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 *
 * @method     ChildGrupoQuery joinWithLogEditeGrupoScheduleRelatedByNewGrupoId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 *
 * @method     ChildGrupoQuery leftJoinWithLogEditeGrupoScheduleRelatedByNewGrupoId() Adds a LEFT JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 * @method     ChildGrupoQuery rightJoinWithLogEditeGrupoScheduleRelatedByNewGrupoId() Adds a RIGHT JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 * @method     ChildGrupoQuery innerJoinWithLogEditeGrupoScheduleRelatedByNewGrupoId() Adds a INNER JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
 *
 * @method     ChildGrupoQuery leftJoinLogEditeGrupoScheduleRelatedByOldGrupoId($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 * @method     ChildGrupoQuery rightJoinLogEditeGrupoScheduleRelatedByOldGrupoId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 * @method     ChildGrupoQuery innerJoinLogEditeGrupoScheduleRelatedByOldGrupoId($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 *
 * @method     ChildGrupoQuery joinWithLogEditeGrupoScheduleRelatedByOldGrupoId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 *
 * @method     ChildGrupoQuery leftJoinWithLogEditeGrupoScheduleRelatedByOldGrupoId() Adds a LEFT JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 * @method     ChildGrupoQuery rightJoinWithLogEditeGrupoScheduleRelatedByOldGrupoId() Adds a RIGHT JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 * @method     ChildGrupoQuery innerJoinWithLogEditeGrupoScheduleRelatedByOldGrupoId() Adds a INNER JOIN clause and with to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
 *
 * @method     \GrupoScheduleQuery|\LogEditeGrupoScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGrupo|null findOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query
 * @method     ChildGrupo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGrupo matching the query, or a new ChildGrupo object populated from the query conditions when no match is found
 *
 * @method     ChildGrupo|null findOneById(int $id) Return the first ChildGrupo filtered by the id column
 * @method     ChildGrupo|null findOneByNome(string $nome) Return the first ChildGrupo filtered by the nome column
 * @method     ChildGrupo|null findOneByZabbixid(string $zabbixid) Return the first ChildGrupo filtered by the zabbixid column *

 * @method     ChildGrupo requirePk($key, ConnectionInterface $con = null) Return the ChildGrupo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOne(ConnectionInterface $con = null) Return the first ChildGrupo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo requireOneById(int $id) Return the first ChildGrupo filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOneByNome(string $nome) Return the first ChildGrupo filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGrupo requireOneByZabbixid(string $zabbixid) Return the first ChildGrupo filtered by the zabbixid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGrupo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGrupo objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildGrupo> find(ConnectionInterface $con = null) Return ChildGrupo objects based on current ModelCriteria
 * @method     ChildGrupo[]|ObjectCollection findById(int $id) Return ChildGrupo objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupo> findById(int $id) Return ChildGrupo objects filtered by the id column
 * @method     ChildGrupo[]|ObjectCollection findByNome(string $nome) Return ChildGrupo objects filtered by the nome column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupo> findByNome(string $nome) Return ChildGrupo objects filtered by the nome column
 * @method     ChildGrupo[]|ObjectCollection findByZabbixid(string $zabbixid) Return ChildGrupo objects filtered by the zabbixid column
 * @psalm-method ObjectCollection&\Traversable<ChildGrupo> findByZabbixid(string $zabbixid) Return ChildGrupo objects filtered by the zabbixid column
 * @method     ChildGrupo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGrupo> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GrupoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GrupoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Grupo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGrupoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGrupoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGrupoQuery) {
            return $criteria;
        }
        $query = new ChildGrupoQuery();
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GrupoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GrupoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGrupo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, zabbixid FROM grupo WHERE id = :p0';
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
            /** @var ChildGrupo $obj */
            $obj = new ChildGrupo();
            $obj->hydrate($row);
            GrupoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGrupo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GrupoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GrupoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_NOME, $nome, $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByZabbixid($zabbixid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zabbixid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GrupoTableMap::COL_ZABBIXID, $zabbixid, $comparison);
    }

    /**
     * Filter the query by a related \GrupoSchedule object
     *
     * @param \GrupoSchedule|ObjectCollection $grupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByGrupoSchedule($grupoSchedule, $comparison = null)
    {
        if ($grupoSchedule instanceof \GrupoSchedule) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_ID, $grupoSchedule->getGrupoId(), $comparison);
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
     * @return $this|ChildGrupoQuery The current query, for fluid interface
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
     * Filter the query by a related \LogEditeGrupoSchedule object
     *
     * @param \LogEditeGrupoSchedule|ObjectCollection $logEditeGrupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByLogEditeGrupoScheduleRelatedByNewGrupoId($logEditeGrupoSchedule, $comparison = null)
    {
        if ($logEditeGrupoSchedule instanceof \LogEditeGrupoSchedule) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_ID, $logEditeGrupoSchedule->getNewGrupoId(), $comparison);
        } elseif ($logEditeGrupoSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditeGrupoScheduleRelatedByNewGrupoIdQuery()
                ->filterByPrimaryKeys($logEditeGrupoSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditeGrupoScheduleRelatedByNewGrupoId() only accepts arguments of type \LogEditeGrupoSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditeGrupoScheduleRelatedByNewGrupoId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function joinLogEditeGrupoScheduleRelatedByNewGrupoId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditeGrupoScheduleRelatedByNewGrupoId');

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
            $this->addJoinObject($join, 'LogEditeGrupoScheduleRelatedByNewGrupoId');
        }

        return $this;
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByNewGrupoId relation LogEditeGrupoSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditeGrupoScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditeGrupoScheduleRelatedByNewGrupoIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditeGrupoScheduleRelatedByNewGrupoId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditeGrupoScheduleRelatedByNewGrupoId', '\LogEditeGrupoScheduleQuery');
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByNewGrupoId relation LogEditeGrupoSchedule object
     *
     * @param callable(\LogEditeGrupoScheduleQuery):\LogEditeGrupoScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditeGrupoScheduleRelatedByNewGrupoIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditeGrupoScheduleRelatedByNewGrupoIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the LogEditeGrupoScheduleRelatedByNewGrupoId relation to the LogEditeGrupoSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditeGrupoScheduleRelatedByNewGrupoIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditeGrupoScheduleRelatedByNewGrupoId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByNewGrupoId relation to the LogEditeGrupoSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditeGrupoScheduleRelatedByNewGrupoIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditeGrupoScheduleRelatedByNewGrupoIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditeGrupoScheduleRelatedByNewGrupoId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \LogEditeGrupoSchedule object
     *
     * @param \LogEditeGrupoSchedule|ObjectCollection $logEditeGrupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGrupoQuery The current query, for fluid interface
     */
    public function filterByLogEditeGrupoScheduleRelatedByOldGrupoId($logEditeGrupoSchedule, $comparison = null)
    {
        if ($logEditeGrupoSchedule instanceof \LogEditeGrupoSchedule) {
            return $this
                ->addUsingAlias(GrupoTableMap::COL_ID, $logEditeGrupoSchedule->getOldGrupoId(), $comparison);
        } elseif ($logEditeGrupoSchedule instanceof ObjectCollection) {
            return $this
                ->useLogEditeGrupoScheduleRelatedByOldGrupoIdQuery()
                ->filterByPrimaryKeys($logEditeGrupoSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLogEditeGrupoScheduleRelatedByOldGrupoId() only accepts arguments of type \LogEditeGrupoSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LogEditeGrupoScheduleRelatedByOldGrupoId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function joinLogEditeGrupoScheduleRelatedByOldGrupoId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LogEditeGrupoScheduleRelatedByOldGrupoId');

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
            $this->addJoinObject($join, 'LogEditeGrupoScheduleRelatedByOldGrupoId');
        }

        return $this;
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByOldGrupoId relation LogEditeGrupoSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LogEditeGrupoScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLogEditeGrupoScheduleRelatedByOldGrupoIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLogEditeGrupoScheduleRelatedByOldGrupoId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LogEditeGrupoScheduleRelatedByOldGrupoId', '\LogEditeGrupoScheduleQuery');
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByOldGrupoId relation LogEditeGrupoSchedule object
     *
     * @param callable(\LogEditeGrupoScheduleQuery):\LogEditeGrupoScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLogEditeGrupoScheduleRelatedByOldGrupoIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLogEditeGrupoScheduleRelatedByOldGrupoIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the LogEditeGrupoScheduleRelatedByOldGrupoId relation to the LogEditeGrupoSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the EXISTS statement
     */
    public function useLogEditeGrupoScheduleRelatedByOldGrupoIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('LogEditeGrupoScheduleRelatedByOldGrupoId', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the LogEditeGrupoScheduleRelatedByOldGrupoId relation to the LogEditeGrupoSchedule table for a NOT EXISTS query.
     *
     * @see useLogEditeGrupoScheduleRelatedByOldGrupoIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LogEditeGrupoScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLogEditeGrupoScheduleRelatedByOldGrupoIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('LogEditeGrupoScheduleRelatedByOldGrupoId', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildGrupo $grupo Object to remove from the list of results
     *
     * @return $this|ChildGrupoQuery The current query, for fluid interface
     */
    public function prune($grupo = null)
    {
        if ($grupo) {
            $this->addUsingAlias(GrupoTableMap::COL_ID, $grupo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the grupo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GrupoTableMap::clearInstancePool();
            GrupoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GrupoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GrupoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GrupoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GrupoQuery
