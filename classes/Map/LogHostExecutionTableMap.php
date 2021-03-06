<?php

namespace Map;

use \LogHostExecution;
use \LogHostExecutionQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'log_host_execution' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogHostExecutionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogHostExecutionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_host_execution';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogHostExecution';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogHostExecution';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'log_host_execution.id';

    /**
     * the column name for the logtime field
     */
    const COL_LOGTIME = 'log_host_execution.logtime';

    /**
     * the column name for the host_schedule_id field
     */
    const COL_HOST_SCHEDULE_ID = 'log_host_execution.host_schedule_id';

    /**
     * the column name for the details field
     */
    const COL_DETAILS = 'log_host_execution.details';

    /**
     * the column name for the push_pop field
     */
    const COL_PUSH_POP = 'log_host_execution.push_pop';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Logtime', 'HostScheduleId', 'Details', 'PushPop', ),
        self::TYPE_CAMELNAME     => array('id', 'logtime', 'hostScheduleId', 'details', 'pushPop', ),
        self::TYPE_COLNAME       => array(LogHostExecutionTableMap::COL_ID, LogHostExecutionTableMap::COL_LOGTIME, LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID, LogHostExecutionTableMap::COL_DETAILS, LogHostExecutionTableMap::COL_PUSH_POP, ),
        self::TYPE_FIELDNAME     => array('id', 'logtime', 'host_schedule_id', 'details', 'push_pop', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Logtime' => 1, 'HostScheduleId' => 2, 'Details' => 3, 'PushPop' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'logtime' => 1, 'hostScheduleId' => 2, 'details' => 3, 'pushPop' => 4, ),
        self::TYPE_COLNAME       => array(LogHostExecutionTableMap::COL_ID => 0, LogHostExecutionTableMap::COL_LOGTIME => 1, LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID => 2, LogHostExecutionTableMap::COL_DETAILS => 3, LogHostExecutionTableMap::COL_PUSH_POP => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'logtime' => 1, 'host_schedule_id' => 2, 'details' => 3, 'push_pop' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogHostExecution.Id' => 'ID',
        'id' => 'ID',
        'logHostExecution.id' => 'ID',
        'LogHostExecutionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_host_execution.id' => 'ID',
        'Logtime' => 'LOGTIME',
        'LogHostExecution.Logtime' => 'LOGTIME',
        'logtime' => 'LOGTIME',
        'logHostExecution.logtime' => 'LOGTIME',
        'LogHostExecutionTableMap::COL_LOGTIME' => 'LOGTIME',
        'COL_LOGTIME' => 'LOGTIME',
        'log_host_execution.logtime' => 'LOGTIME',
        'HostScheduleId' => 'HOST_SCHEDULE_ID',
        'LogHostExecution.HostScheduleId' => 'HOST_SCHEDULE_ID',
        'hostScheduleId' => 'HOST_SCHEDULE_ID',
        'logHostExecution.hostScheduleId' => 'HOST_SCHEDULE_ID',
        'LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID' => 'HOST_SCHEDULE_ID',
        'COL_HOST_SCHEDULE_ID' => 'HOST_SCHEDULE_ID',
        'host_schedule_id' => 'HOST_SCHEDULE_ID',
        'log_host_execution.host_schedule_id' => 'HOST_SCHEDULE_ID',
        'Details' => 'DETAILS',
        'LogHostExecution.Details' => 'DETAILS',
        'details' => 'DETAILS',
        'logHostExecution.details' => 'DETAILS',
        'LogHostExecutionTableMap::COL_DETAILS' => 'DETAILS',
        'COL_DETAILS' => 'DETAILS',
        'log_host_execution.details' => 'DETAILS',
        'PushPop' => 'PUSH_POP',
        'LogHostExecution.PushPop' => 'PUSH_POP',
        'pushPop' => 'PUSH_POP',
        'logHostExecution.pushPop' => 'PUSH_POP',
        'LogHostExecutionTableMap::COL_PUSH_POP' => 'PUSH_POP',
        'COL_PUSH_POP' => 'PUSH_POP',
        'push_pop' => 'PUSH_POP',
        'log_host_execution.push_pop' => 'PUSH_POP',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('log_host_execution');
        $this->setPhpName('LogHostExecution');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogHostExecution');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_host_execution_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('logtime', 'Logtime', 'VARCHAR', true, 50, null);
        $this->addForeignKey('host_schedule_id', 'HostScheduleId', 'INTEGER', 'host_schedule', 'id', true, null, null);
        $this->addColumn('details', 'Details', 'VARCHAR', false, 50, null);
        $this->addColumn('push_pop', 'PushPop', 'VARCHAR', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('HostSchedule', '\\HostSchedule', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':host_schedule_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? LogHostExecutionTableMap::CLASS_DEFAULT : LogHostExecutionTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (LogHostExecution object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogHostExecutionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogHostExecutionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogHostExecutionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogHostExecutionTableMap::OM_CLASS;
            /** @var LogHostExecution $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogHostExecutionTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = LogHostExecutionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogHostExecutionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogHostExecution $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogHostExecutionTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LogHostExecutionTableMap::COL_ID);
            $criteria->addSelectColumn(LogHostExecutionTableMap::COL_LOGTIME);
            $criteria->addSelectColumn(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID);
            $criteria->addSelectColumn(LogHostExecutionTableMap::COL_DETAILS);
            $criteria->addSelectColumn(LogHostExecutionTableMap::COL_PUSH_POP);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.logtime');
            $criteria->addSelectColumn($alias . '.host_schedule_id');
            $criteria->addSelectColumn($alias . '.details');
            $criteria->addSelectColumn($alias . '.push_pop');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(LogHostExecutionTableMap::COL_ID);
            $criteria->removeSelectColumn(LogHostExecutionTableMap::COL_LOGTIME);
            $criteria->removeSelectColumn(LogHostExecutionTableMap::COL_HOST_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogHostExecutionTableMap::COL_DETAILS);
            $criteria->removeSelectColumn(LogHostExecutionTableMap::COL_PUSH_POP);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.logtime');
            $criteria->removeSelectColumn($alias . '.host_schedule_id');
            $criteria->removeSelectColumn($alias . '.details');
            $criteria->removeSelectColumn($alias . '.push_pop');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(LogHostExecutionTableMap::DATABASE_NAME)->getTable(LogHostExecutionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogHostExecution or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogHostExecution object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogHostExecutionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogHostExecution) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogHostExecutionTableMap::DATABASE_NAME);
            $criteria->add(LogHostExecutionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogHostExecutionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogHostExecutionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogHostExecutionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_host_execution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogHostExecutionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogHostExecution or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogHostExecution object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogHostExecutionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogHostExecution object
        }

        if ($criteria->containsKey(LogHostExecutionTableMap::COL_ID) && $criteria->keyContainsValue(LogHostExecutionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogHostExecutionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogHostExecutionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogHostExecutionTableMap
