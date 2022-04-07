<?php

namespace Map;

use \LogDeleteMacroSchedule;
use \LogDeleteMacroScheduleQuery;
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
 * This class defines the structure of the 'log_delete_macro_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogDeleteMacroScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogDeleteMacroScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_delete_macro_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogDeleteMacroSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogDeleteMacroSchedule';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id field
     */
    const COL_ID = 'log_delete_macro_schedule.id';

    /**
     * the column name for the macro_schedule_id field
     */
    const COL_MACRO_SCHEDULE_ID = 'log_delete_macro_schedule.macro_schedule_id';

    /**
     * the column name for the log_id field
     */
    const COL_LOG_ID = 'log_delete_macro_schedule.log_id';

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
        self::TYPE_PHPNAME       => array('Id', 'MacroScheduleId', 'LogId', ),
        self::TYPE_CAMELNAME     => array('id', 'macroScheduleId', 'logId', ),
        self::TYPE_COLNAME       => array(LogDeleteMacroScheduleTableMap::COL_ID, LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, LogDeleteMacroScheduleTableMap::COL_LOG_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'macro_schedule_id', 'log_id', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'MacroScheduleId' => 1, 'LogId' => 2, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'macroScheduleId' => 1, 'logId' => 2, ),
        self::TYPE_COLNAME       => array(LogDeleteMacroScheduleTableMap::COL_ID => 0, LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID => 1, LogDeleteMacroScheduleTableMap::COL_LOG_ID => 2, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'macro_schedule_id' => 1, 'log_id' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogDeleteMacroSchedule.Id' => 'ID',
        'id' => 'ID',
        'logDeleteMacroSchedule.id' => 'ID',
        'LogDeleteMacroScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_delete_macro_schedule.id' => 'ID',
        'MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogDeleteMacroSchedule.MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'logDeleteMacroSchedule.macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'log_delete_macro_schedule.macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'LogId' => 'LOG_ID',
        'LogDeleteMacroSchedule.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'logDeleteMacroSchedule.logId' => 'LOG_ID',
        'LogDeleteMacroScheduleTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'log_delete_macro_schedule.log_id' => 'LOG_ID',
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
        $this->setName('log_delete_macro_schedule');
        $this->setPhpName('LogDeleteMacroSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogDeleteMacroSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_delete_macro_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('macro_schedule_id', 'MacroScheduleId', 'INTEGER', 'macro_schedule', 'id', true, null, null);
        $this->addForeignKey('log_id', 'LogId', 'INTEGER', 'log', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('Log', '\\Log', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':log_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? LogDeleteMacroScheduleTableMap::CLASS_DEFAULT : LogDeleteMacroScheduleTableMap::OM_CLASS;
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
     * @return array           (LogDeleteMacroSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogDeleteMacroScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogDeleteMacroScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogDeleteMacroScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogDeleteMacroScheduleTableMap::OM_CLASS;
            /** @var LogDeleteMacroSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogDeleteMacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = LogDeleteMacroScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogDeleteMacroScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogDeleteMacroSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogDeleteMacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LogDeleteMacroScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->addSelectColumn(LogDeleteMacroScheduleTableMap::COL_LOG_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.macro_schedule_id');
            $criteria->addSelectColumn($alias . '.log_id');
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
            $criteria->removeSelectColumn(LogDeleteMacroScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(LogDeleteMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogDeleteMacroScheduleTableMap::COL_LOG_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.macro_schedule_id');
            $criteria->removeSelectColumn($alias . '.log_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(LogDeleteMacroScheduleTableMap::DATABASE_NAME)->getTable(LogDeleteMacroScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogDeleteMacroSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogDeleteMacroSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogDeleteMacroSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
            $criteria->add(LogDeleteMacroScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogDeleteMacroScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogDeleteMacroScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogDeleteMacroScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_delete_macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogDeleteMacroScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogDeleteMacroSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogDeleteMacroSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogDeleteMacroScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogDeleteMacroSchedule object
        }

        if ($criteria->containsKey(LogDeleteMacroScheduleTableMap::COL_ID) && $criteria->keyContainsValue(LogDeleteMacroScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogDeleteMacroScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogDeleteMacroScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogDeleteMacroScheduleTableMap
