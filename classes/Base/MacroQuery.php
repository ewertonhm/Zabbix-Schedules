<?php

namespace Base;

use \Macro as ChildMacro;
use \MacroQuery as ChildMacroQuery;
use \Exception;
use \PDO;
use Map\MacroTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'macro' table.
 *
 *
 *
 * @method     ChildMacroQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMacroQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildMacroQuery orderByZabbixid($order = Criteria::ASC) Order by the zabbixid column
 *
 * @method     ChildMacroQuery groupById() Group by the id column
 * @method     ChildMacroQuery groupByNome() Group by the nome column
 * @method     ChildMacroQuery groupByZabbixid() Group by the zabbixid column
 *
 * @method     ChildMacroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMacroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMacroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMacroQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMacroQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMacroQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMacroQuery leftJoinMacroSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildMacroQuery rightJoinMacroSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MacroSchedule relation
 * @method     ChildMacroQuery innerJoinMacroSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the MacroSchedule relation
 *
 * @method     ChildMacroQuery joinWithMacroSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MacroSchedule relation
 *
 * @method     ChildMacroQuery leftJoinWithMacroSchedule() Adds a LEFT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildMacroQuery rightJoinWithMacroSchedule() Adds a RIGHT JOIN clause and with to the query using the MacroSchedule relation
 * @method     ChildMacroQuery innerJoinWithMacroSchedule() Adds a INNER JOIN clause and with to the query using the MacroSchedule relation
 *
 * @method     \MacroScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMacro|null findOne(ConnectionInterface $con = null) Return the first ChildMacro matching the query
 * @method     ChildMacro findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMacro matching the query, or a new ChildMacro object populated from the query conditions when no match is found
 *
 * @method     ChildMacro|null findOneById(int $id) Return the first ChildMacro filtered by the id column
 * @method     ChildMacro|null findOneByNome(string $nome) Return the first ChildMacro filtered by the nome column
 * @method     ChildMacro|null findOneByZabbixid(string $zabbixid) Return the first ChildMacro filtered by the zabbixid column *

 * @method     ChildMacro requirePk($key, ConnectionInterface $con = null) Return the ChildMacro by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacro requireOne(ConnectionInterface $con = null) Return the first ChildMacro matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMacro requireOneById(int $id) Return the first ChildMacro filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacro requireOneByNome(string $nome) Return the first ChildMacro filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMacro requireOneByZabbixid(string $zabbixid) Return the first ChildMacro filtered by the zabbixid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMacro[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMacro objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildMacro> find(ConnectionInterface $con = null) Return ChildMacro objects based on current ModelCriteria
 * @method     ChildMacro[]|ObjectCollection findById(int $id) Return ChildMacro objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildMacro> findById(int $id) Return ChildMacro objects filtered by the id column
 * @method     ChildMacro[]|ObjectCollection findByNome(string $nome) Return ChildMacro objects filtered by the nome column
 * @psalm-method ObjectCollection&\Traversable<ChildMacro> findByNome(string $nome) Return ChildMacro objects filtered by the nome column
 * @method     ChildMacro[]|ObjectCollection findByZabbixid(string $zabbixid) Return ChildMacro objects filtered by the zabbixid column
 * @psalm-method ObjectCollection&\Traversable<ChildMacro> findByZabbixid(string $zabbixid) Return ChildMacro objects filtered by the zabbixid column
 * @method     ChildMacro[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMacro> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MacroQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MacroQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Macro', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMacroQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMacroQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMacroQuery) {
            return $criteria;
        }
        $query = new ChildMacroQuery();
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
     * @return ChildMacro|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MacroTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MacroTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMacro A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, zabbixid FROM macro WHERE id = :p0';
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
            /** @var ChildMacro $obj */
            $obj = new ChildMacro();
            $obj->hydrate($row);
            MacroTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMacro|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MacroTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MacroTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MacroTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MacroTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroTableMap::COL_NOME, $nome, $comparison);
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
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function filterByZabbixid($zabbixid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zabbixid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MacroTableMap::COL_ZABBIXID, $zabbixid, $comparison);
    }

    /**
     * Filter the query by a related \MacroSchedule object
     *
     * @param \MacroSchedule|ObjectCollection $macroSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMacroQuery The current query, for fluid interface
     */
    public function filterByMacroSchedule($macroSchedule, $comparison = null)
    {
        if ($macroSchedule instanceof \MacroSchedule) {
            return $this
                ->addUsingAlias(MacroTableMap::COL_ID, $macroSchedule->getMacroId(), $comparison);
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
     * @return $this|ChildMacroQuery The current query, for fluid interface
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
     * @param   ChildMacro $macro Object to remove from the list of results
     *
     * @return $this|ChildMacroQuery The current query, for fluid interface
     */
    public function prune($macro = null)
    {
        if ($macro) {
            $this->addUsingAlias(MacroTableMap::COL_ID, $macro->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the macro table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MacroTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MacroTableMap::clearInstancePool();
            MacroTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MacroTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MacroTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MacroTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MacroTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MacroQuery
