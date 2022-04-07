<?php

namespace Map;

use \LogMacroExecution;
use \LogMacroExecutionQuery;
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
 * This class defines the structure of the 'log_macro_execution' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogMacroExecutionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogMacroExecutionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_macro_execution';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogMacroExecution';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogMacroExecution';

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
    const COL_ID = 'log_macro_execution.id';

    /**
     * the column name for the macro_schedule_id field
     */
    const COL_MACRO_SCHEDULE_ID = 'log_macro_execution.macro_schedule_id';

    /**
     * the column name for the push_pop field
     */
    const COL_PUSH_POP = 'log_macro_execution.push_pop';

    /**
     * the column name for the logtime field
     */
    const COL_LOGTIME = 'log_macro_execution.logtime';

    /**
     * the column name for the details field
     */
    const COL_DETAILS = 'log_macro_execution.details';

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
        self::TYPE_PHPNAME       => array('Id', 'MacroScheduleId', 'PushPop', 'Logtime', 'Details', ),
        self::TYPE_CAMELNAME     => array('id', 'macroScheduleId', 'pushPop', 'logtime', 'details', ),
        self::TYPE_COLNAME       => array(LogMacroExecutionTableMap::COL_ID, LogMacroExecutionTableMap::COL_MACRO_SCHEDULE_ID, LogMacroExecutionTableMap::COL_PUSH_POP, LogMacroExecutionTableMap::COL_LOGTIME, LogMacroExecutionTableMap::COL_DETAILS, ),
        self::TYPE_FIELDNAME     => array('id', 'macro_schedule_id', 'push_pop', 'logtime', 'details', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'MacroScheduleId' => 1, 'PushPop' => 2, 'Logtime' => 3, 'Details' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'macroScheduleId' => 1, 'pushPop' => 2, 'logtime' => 3, 'details' => 4, ),
        self::TYPE_COLNAME       => array(LogMacroExecutionTableMap::COL_ID => 0, LogMacroExecutionTableMap::COL_MACRO_SCHEDULE_ID => 1, LogMacroExecutionTableMap::COL_PUSH_POP => 2, LogMacroExecutionTableMap::COL_LOGTIME => 3, LogMacroExecutionTableMap::COL_DETAILS => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'macro_schedule_id' => 1, 'push_pop' => 2, 'logtime' => 3, 'details' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogMacroExecution.Id' => 'ID',
        'id' => 'ID',
        'logMacroExecution.id' => 'ID',
        'LogMacroExecutionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_macro_execution.id' => 'ID',
        'MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogMacroExecution.MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'logMacroExecution.macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogMacroExecutionTableMap::COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'log_macro_execution.macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'PushPop' => 'PUSH_POP',
        'LogMacroExecution.PushPop' => 'PUSH_POP',
        'pushPop' => 'PUSH_POP',
        'logMacroExecution.pushPop' => 'PUSH_POP',
        'LogMacroExecutionTableMap::COL_PUSH_POP' => 'PUSH_POP',
        'COL_PUSH_POP' => 'PUSH_POP',
        'push_pop' => 'PUSH_POP',
        'log_macro_execution.push_pop' => 'PUSH_POP',
        'Logtime' => 'LOGTIME',
        'LogMacroExecution.Logtime' => 'LOGTIME',
        'logtime' => 'LOGTIME',
        'logMacroExecution.logtime' => 'LOGTIME',
        'LogMacroExecutionTableMap::COL_LOGTIME' => 'LOGTIME',
        'COL_LOGTIME' => 'LOGTIME',
        'log_macro_execution.logtime' => 'LOGTIME',
        'Details' => 'DETAILS',
        'LogMacroExecution.Details' => 'DETAILS',
        'details' => 'DETAILS',
        'logMacroExecution.details' => 'DETAILS',
        'LogMacroExecutionTableMap::COL_DETAILS' => 'DETAILS',
        'COL_DETAILS' => 'DETAILS',
        'log_macro_execution.details' => 'DETAILS',
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
        $this->setName('log_macro_execution');
        $this->setPhpName('LogMacroExecution');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogMacroExecution');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_macro_execution_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('macro_schedule_id', 'MacroScheduleId', 'INTEGER', 'macro_schedule', 'id', true, null, null);
        $this->addColumn('push_pop', 'PushPop', 'VARCHAR', true, 1, null);
        $this->addColumn('logtime', 'Logtime', 'VARCHAR', true, 50, null);
        $this->addColumn('details', 'Details', 'VARCHAR', false, 100, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('MacroSchedule', '\\MacroSchedule', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':macro_schedule_id',
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
        return $withPrefix ? LogMacroExecutionTableMap::CLASS_DEFAULT : LogMacroExecutionTableMap::OM_CLASS;
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
     * @return array           (LogMacroExecution object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogMacroExecutionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogMacroExecutionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogMacroExecutionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogMacroExecutionTableMap::OM_CLASS;
            /** @var LogMacroExecution $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogMacroExecutionTableMap::addInstanceToPool($obj, $key);
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
            $key = LogMacroExecutionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogMacroExecutionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogMacroExecution $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogMacroExecutionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LogMacroExecutionTableMap::COL_ID);
            $criteria->addSelectColumn(LogMacroExecutionTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->addSelectColumn(LogMacroExecutionTableMap::COL_PUSH_POP);
            $criteria->addSelectColumn(LogMacroExecutionTableMap::COL_LOGTIME);
            $criteria->addSelectColumn(LogMacroExecutionTableMap::COL_DETAILS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.macro_schedule_id');
            $criteria->addSelectColumn($alias . '.push_pop');
            $criteria->addSelectColumn($alias . '.logtime');
            $criteria->addSelectColumn($alias . '.details');
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
            $criteria->removeSelectColumn(LogMacroExecutionTableMap::COL_ID);
            $criteria->removeSelectColumn(LogMacroExecutionTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogMacroExecutionTableMap::COL_PUSH_POP);
            $criteria->removeSelectColumn(LogMacroExecutionTableMap::COL_LOGTIME);
            $criteria->removeSelectColumn(LogMacroExecutionTableMap::COL_DETAILS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.macro_schedule_id');
            $criteria->removeSelectColumn($alias . '.push_pop');
            $criteria->removeSelectColumn($alias . '.logtime');
            $criteria->removeSelectColumn($alias . '.details');
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
        return Propel::getServiceContainer()->getDatabaseMap(LogMacroExecutionTableMap::DATABASE_NAME)->getTable(LogMacroExecutionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogMacroExecution or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogMacroExecution object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogMacroExecutionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogMacroExecution) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogMacroExecutionTableMap::DATABASE_NAME);
            $criteria->add(LogMacroExecutionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogMacroExecutionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogMacroExecutionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogMacroExecutionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_macro_execution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogMacroExecutionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogMacroExecution or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogMacroExecution object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogMacroExecutionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogMacroExecution object
        }

        if ($criteria->containsKey(LogMacroExecutionTableMap::COL_ID) && $criteria->keyContainsValue(LogMacroExecutionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogMacroExecutionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogMacroExecutionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogMacroExecutionTableMap
