<?php

namespace Base;

use \Log as ChildLog;
use \LogQuery as ChildLogQuery;
use \Exception;
use \PDO;
use Map\LogTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'log' table.
 *
 *
 *
 * @method     ChildLogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLogQuery orderByLogtime($order = Criteria::ASC) Order by the logtime column
 * @method     ChildLogQuery orderByUsuarioId($order = Criteria::ASC) Order by the usuario_id column
 *
 * @method     ChildLogQuery groupById() Group by the id column
 * @method     ChildLogQuery groupByLogtime() Group by the logtime column
 * @method     ChildLogQuery groupByUsuarioId() Group by the usuario_id column
 *
 * @method     ChildLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLogQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildLogQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildLogQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildLogQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildLogQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildLogQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildLogQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildLogQuery leftJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildLogQuery rightJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildLogQuery innerJoinLogDeleteGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildLogQuery joinWithLogDeleteGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogDeleteGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildLogQuery rightJoinWithLogDeleteGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 * @method     ChildLogQuery innerJoinWithLogDeleteGrupoSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteGrupoSchedule relation
 *
 * @method     ChildLogQuery leftJoinLogDeleteHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteHostSchedule relation
 * @method     ChildLogQuery rightJoinLogDeleteHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteHostSchedule relation
 * @method     ChildLogQuery innerJoinLogDeleteHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildLogQuery joinWithLogDeleteHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogDeleteHostSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteHostSchedule relation
 * @method     ChildLogQuery rightJoinWithLogDeleteHostSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteHostSchedule relation
 * @method     ChildLogQuery innerJoinWithLogDeleteHostSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteHostSchedule relation
 *
 * @method     ChildLogQuery leftJoinLogDeleteMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogDeleteMacroSchedule relation
 * @method     ChildLogQuery rightJoinLogDeleteMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogDeleteMacroSchedule relation
 * @method     ChildLogQuery innerJoinLogDeleteMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildLogQuery joinWithLogDeleteMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogDeleteMacroSchedule() Adds a LEFT JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 * @method     ChildLogQuery rightJoinWithLogDeleteMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 * @method     ChildLogQuery innerJoinWithLogDeleteMacroSchedule() Adds a INNER JOIN clause and with to the query using the LogDeleteMacroSchedule relation
 *
 * @method     ChildLogQuery leftJoinLogEditHostSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditHostSchedule relation
 * @method     ChildLogQuery rightJoinLogEditHostSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditHostSchedule relation
 * @method     ChildLogQuery innerJoinLogEditHostSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditHostSchedule relation
 *
 * @method     ChildLogQuery joinWithLogEditHostSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditHostSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogEditHostSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditHostSchedule relation
 * @method     ChildLogQuery rightJoinWithLogEditHostSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditHostSchedule relation
 * @method     ChildLogQuery innerJoinWithLogEditHostSchedule() Adds a INNER JOIN clause and with to the query using the LogEditHostSchedule relation
 *
 * @method     ChildLogQuery leftJoinLogEditeGrupoSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeGrupoSchedule relation
 * @method     ChildLogQuery rightJoinLogEditeGrupoSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeGrupoSchedule relation
 * @method     ChildLogQuery innerJoinLogEditeGrupoSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildLogQuery joinWithLogEditeGrupoSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogEditeGrupoSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 * @method     ChildLogQuery rightJoinWithLogEditeGrupoSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 * @method     ChildLogQuery innerJoinWithLogEditeGrupoSchedule() Adds a INNER JOIN clause and with to the query using the LogEditeGrupoSchedule relation
 *
 * @method     ChildLogQuery leftJoinLogEditeMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogEditeMacroSchedule relation
 * @method     ChildLogQuery rightJoinLogEditeMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogEditeMacroSchedule relation
 * @method     ChildLogQuery innerJoinLogEditeMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LogEditeMacroSchedule relation
 *
 * @method     ChildLogQuery joinWithLogEditeMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LogEditeMacroSchedule relation
 *
 * @method     ChildLogQuery leftJoinWithLogEditeMacroSchedule() Adds a LEFT JOIN clause and with to the query using the LogEditeMacroSchedule relation
 * @method     ChildLogQuery rightJoinWithLogEditeMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the LogEditeMacroSchedule relation
 * @method     ChildLogQuery innerJoinWithLogEditeMacroSchedule() Adds a INNER JOIN clause and with to the query using the LogEditeMacroSchedule relation
 *
 * @method     \UsuarioQuery|\LogDeleteGrupoScheduleQuery|\LogDeleteHostScheduleQuery|\LogDeleteMacroScheduleQuery|\LogEditHostScheduleQuery|\LogEditeGrupoScheduleQuery|\LogEditeMacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLog|null findOne(ConnectionInterface $con = null) Return the first ChildLog matching the query
 * @method     ChildLog findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLog matching the query, or a new ChildLog object populated from the query conditions when no match is found
 *
 * @method     ChildLog|null findOneById(int $id) Return the first ChildLog filtered by the id column
 * @method     ChildLog|null findOneByLogtime(string $logtime) Return the first ChildLog filtered by the logtime column
 * @method     ChildLog|null findOneByUsuarioId(int $usuario_id) Return the first ChildLog filtered by the usuario_id column *

 * @method     ChildLog requirePk($key, ConnectionInterface $con = null) Return the ChildLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLog requireOne(ConnectionInterface $con = null) Return the first ChildLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLog requireOneById(int $id) Return the first ChildLog filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLog requireOneByLogtime(string $logtime) Return the first ChildLog filtered by the logtime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLog requireOneByUsuarioId(int $usuario_id) Return the first ChildLog filtered by the usuario_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLog[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLog objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildLog> find(ConnectionInterface $con = null) Return ChildLog objects based on current ModelCriteria
 * @method     ChildLog[]|ObjectCollection findById(int $id) Return ChildLog objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildLog> findById(int $id) Return ChildLog objects filtered by the id column
 * @method     ChildLog[]|ObjectCollection findByLogtime(string $logtime) Return ChildLog objects filtered by the logtime column
 * @psalm-method ObjectCollection&\Traversable<ChildLog> findByLogtime(string $logtime) Return ChildLog objects filtered by the logtime column
 * @method     ChildLog[]|ObjectCollection findByUsuarioId(int $usuario_id) Return ChildLog objects filtered by the usuario_id column
 * @psalm-method ObjectCollection&\Traversable<ChildLog> findByUsuarioId(int $usuario_id) Return ChildLog objects filtered by the usuario_id column
 * @method     ChildLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLog> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LogQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Log', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLogQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLogQuery) {
            return $criteria;
        }
        $query = new ChildLogQuery();
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
     * @return ChildLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, logtime, usuario_id FROM log WHERE id = :p0';
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
            /** @var ChildLog $obj */
            $obj = new ChildLog();
            $obj->hydrate($row);
            LogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLog|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LogTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LogTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LogTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LogTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogtime($logtime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logtime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogTableMap::COL_LOGTIME, $logtime, $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function filterByUsuarioId($usuarioId = null, $comparison = null)
    {
        if (is_array($usuarioId)) {
            $useMinMax = false;
            if (isset($usuarioId['min'])) {
                $this->addUsingAlias(LogTableMap::COL_USUARIO_ID, $usuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuarioId['max'])) {
                $this->addUsingAlias(LogTableMap::COL_USUARIO_ID, $usuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LogTableMap::COL_USUARIO_ID, $usuarioId, $comparison);
    }

    /**
     * Filter the query by a related \Usuario object
     *
     * @param \Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Usuario) {
            return $this
                ->addUsingAlias(LogTableMap::COL_USUARIO_ID, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LogTableMap::COL_USUARIO_ID, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogDeleteGrupoSchedule($logDeleteGrupoSchedule, $comparison = null)
    {
        if ($logDeleteGrupoSchedule instanceof \LogDeleteGrupoSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logDeleteGrupoSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Filter the query by a related \LogDeleteHostSchedule object
     *
     * @param \LogDeleteHostSchedule|ObjectCollection $logDeleteHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogDeleteHostSchedule($logDeleteHostSchedule, $comparison = null)
    {
        if ($logDeleteHostSchedule instanceof \LogDeleteHostSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logDeleteHostSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Filter the query by a related \LogDeleteMacroSchedule object
     *
     * @param \LogDeleteMacroSchedule|ObjectCollection $logDeleteMacroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogDeleteMacroSchedule($logDeleteMacroSchedule, $comparison = null)
    {
        if ($logDeleteMacroSchedule instanceof \LogDeleteMacroSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logDeleteMacroSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Filter the query by a related \LogEditHostSchedule object
     *
     * @param \LogEditHostSchedule|ObjectCollection $logEditHostSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogEditHostSchedule($logEditHostSchedule, $comparison = null)
    {
        if ($logEditHostSchedule instanceof \LogEditHostSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logEditHostSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Filter the query by a related \LogEditeGrupoSchedule object
     *
     * @param \LogEditeGrupoSchedule|ObjectCollection $logEditeGrupoSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogEditeGrupoSchedule($logEditeGrupoSchedule, $comparison = null)
    {
        if ($logEditeGrupoSchedule instanceof \LogEditeGrupoSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logEditeGrupoSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Filter the query by a related \LogEditeMacroSchedule object
     *
     * @param \LogEditeMacroSchedule|ObjectCollection $logEditeMacroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLogQuery The current query, for fluid interface
     */
    public function filterByLogEditeMacroSchedule($logEditeMacroSchedule, $comparison = null)
    {
        if ($logEditeMacroSchedule instanceof \LogEditeMacroSchedule) {
            return $this
                ->addUsingAlias(LogTableMap::COL_ID, $logEditeMacroSchedule->getLogId(), $comparison);
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
     * @return $this|ChildLogQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildLog $log Object to remove from the list of results
     *
     * @return $this|ChildLogQuery The current query, for fluid interface
     */
    public function prune($log = null)
    {
        if ($log) {
            $this->addUsingAlias(LogTableMap::COL_ID, $log->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LogTableMap::clearInstancePool();
            LogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LogQuery
