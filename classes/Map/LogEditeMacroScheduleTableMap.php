<?php

namespace Map;

use \LogEditeMacroSchedule;
use \LogEditeMacroScheduleQuery;
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
 * This class defines the structure of the 'log_edite_macro_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogEditeMacroScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogEditeMacroScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_edite_macro_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogEditeMacroSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogEditeMacroSchedule';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'log_edite_macro_schedule.id';

    /**
     * the column name for the macro_schedule_id field
     */
    const COL_MACRO_SCHEDULE_ID = 'log_edite_macro_schedule.macro_schedule_id';

    /**
     * the column name for the log_id field
     */
    const COL_LOG_ID = 'log_edite_macro_schedule.log_id';

    /**
     * the column name for the old_date_from field
     */
    const COL_OLD_DATE_FROM = 'log_edite_macro_schedule.old_date_from';

    /**
     * the column name for the new_date_from field
     */
    const COL_NEW_DATE_FROM = 'log_edite_macro_schedule.new_date_from';

    /**
     * the column name for the old_date_until field
     */
    const COL_OLD_DATE_UNTIL = 'log_edite_macro_schedule.old_date_until';

    /**
     * the column name for the new_date_until field
     */
    const COL_NEW_DATE_UNTIL = 'log_edite_macro_schedule.new_date_until';

    /**
     * the column name for the old_original_value field
     */
    const COL_OLD_ORIGINAL_VALUE = 'log_edite_macro_schedule.old_original_value';

    /**
     * the column name for the new_original_value field
     */
    const COL_NEW_ORIGINAL_VALUE = 'log_edite_macro_schedule.new_original_value';

    /**
     * the column name for the old_new_value field
     */
    const COL_OLD_NEW_VALUE = 'log_edite_macro_schedule.old_new_value';

    /**
     * the column name for the new_new_value field
     */
    const COL_NEW_NEW_VALUE = 'log_edite_macro_schedule.new_new_value';

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
        self::TYPE_PHPNAME       => array('Id', 'MacroScheduleId', 'LogId', 'OldDateFrom', 'NewDateFrom', 'OldDateUntil', 'NewDateUntil', 'OldOriginalValue', 'NewOriginalValue', 'OldNewValue', 'NewNewValue', ),
        self::TYPE_CAMELNAME     => array('id', 'macroScheduleId', 'logId', 'oldDateFrom', 'newDateFrom', 'oldDateUntil', 'newDateUntil', 'oldOriginalValue', 'newOriginalValue', 'oldNewValue', 'newNewValue', ),
        self::TYPE_COLNAME       => array(LogEditeMacroScheduleTableMap::COL_ID, LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, LogEditeMacroScheduleTableMap::COL_LOG_ID, LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM, LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM, LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL, LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL, LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE, LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE, LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE, LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE, ),
        self::TYPE_FIELDNAME     => array('id', 'macro_schedule_id', 'log_id', 'old_date_from', 'new_date_from', 'old_date_until', 'new_date_until', 'old_original_value', 'new_original_value', 'old_new_value', 'new_new_value', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'MacroScheduleId' => 1, 'LogId' => 2, 'OldDateFrom' => 3, 'NewDateFrom' => 4, 'OldDateUntil' => 5, 'NewDateUntil' => 6, 'OldOriginalValue' => 7, 'NewOriginalValue' => 8, 'OldNewValue' => 9, 'NewNewValue' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'macroScheduleId' => 1, 'logId' => 2, 'oldDateFrom' => 3, 'newDateFrom' => 4, 'oldDateUntil' => 5, 'newDateUntil' => 6, 'oldOriginalValue' => 7, 'newOriginalValue' => 8, 'oldNewValue' => 9, 'newNewValue' => 10, ),
        self::TYPE_COLNAME       => array(LogEditeMacroScheduleTableMap::COL_ID => 0, LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID => 1, LogEditeMacroScheduleTableMap::COL_LOG_ID => 2, LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM => 3, LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM => 4, LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL => 5, LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL => 6, LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE => 7, LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE => 8, LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE => 9, LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'macro_schedule_id' => 1, 'log_id' => 2, 'old_date_from' => 3, 'new_date_from' => 4, 'old_date_until' => 5, 'new_date_until' => 6, 'old_original_value' => 7, 'new_original_value' => 8, 'old_new_value' => 9, 'new_new_value' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogEditeMacroSchedule.Id' => 'ID',
        'id' => 'ID',
        'logEditeMacroSchedule.id' => 'ID',
        'LogEditeMacroScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_edite_macro_schedule.id' => 'ID',
        'MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogEditeMacroSchedule.MacroScheduleId' => 'MACRO_SCHEDULE_ID',
        'macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'logEditeMacroSchedule.macroScheduleId' => 'MACRO_SCHEDULE_ID',
        'LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'COL_MACRO_SCHEDULE_ID' => 'MACRO_SCHEDULE_ID',
        'macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'log_edite_macro_schedule.macro_schedule_id' => 'MACRO_SCHEDULE_ID',
        'LogId' => 'LOG_ID',
        'LogEditeMacroSchedule.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'logEditeMacroSchedule.logId' => 'LOG_ID',
        'LogEditeMacroScheduleTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'log_edite_macro_schedule.log_id' => 'LOG_ID',
        'OldDateFrom' => 'OLD_DATE_FROM',
        'LogEditeMacroSchedule.OldDateFrom' => 'OLD_DATE_FROM',
        'oldDateFrom' => 'OLD_DATE_FROM',
        'logEditeMacroSchedule.oldDateFrom' => 'OLD_DATE_FROM',
        'LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM' => 'OLD_DATE_FROM',
        'COL_OLD_DATE_FROM' => 'OLD_DATE_FROM',
        'old_date_from' => 'OLD_DATE_FROM',
        'log_edite_macro_schedule.old_date_from' => 'OLD_DATE_FROM',
        'NewDateFrom' => 'NEW_DATE_FROM',
        'LogEditeMacroSchedule.NewDateFrom' => 'NEW_DATE_FROM',
        'newDateFrom' => 'NEW_DATE_FROM',
        'logEditeMacroSchedule.newDateFrom' => 'NEW_DATE_FROM',
        'LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'new_date_from' => 'NEW_DATE_FROM',
        'log_edite_macro_schedule.new_date_from' => 'NEW_DATE_FROM',
        'OldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditeMacroSchedule.OldDateUntil' => 'OLD_DATE_UNTIL',
        'oldDateUntil' => 'OLD_DATE_UNTIL',
        'logEditeMacroSchedule.oldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'old_date_until' => 'OLD_DATE_UNTIL',
        'log_edite_macro_schedule.old_date_until' => 'OLD_DATE_UNTIL',
        'NewDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditeMacroSchedule.NewDateUntil' => 'NEW_DATE_UNTIL',
        'newDateUntil' => 'NEW_DATE_UNTIL',
        'logEditeMacroSchedule.newDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'new_date_until' => 'NEW_DATE_UNTIL',
        'log_edite_macro_schedule.new_date_until' => 'NEW_DATE_UNTIL',
        'OldOriginalValue' => 'OLD_ORIGINAL_VALUE',
        'LogEditeMacroSchedule.OldOriginalValue' => 'OLD_ORIGINAL_VALUE',
        'oldOriginalValue' => 'OLD_ORIGINAL_VALUE',
        'logEditeMacroSchedule.oldOriginalValue' => 'OLD_ORIGINAL_VALUE',
        'LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE' => 'OLD_ORIGINAL_VALUE',
        'COL_OLD_ORIGINAL_VALUE' => 'OLD_ORIGINAL_VALUE',
        'old_original_value' => 'OLD_ORIGINAL_VALUE',
        'log_edite_macro_schedule.old_original_value' => 'OLD_ORIGINAL_VALUE',
        'NewOriginalValue' => 'NEW_ORIGINAL_VALUE',
        'LogEditeMacroSchedule.NewOriginalValue' => 'NEW_ORIGINAL_VALUE',
        'newOriginalValue' => 'NEW_ORIGINAL_VALUE',
        'logEditeMacroSchedule.newOriginalValue' => 'NEW_ORIGINAL_VALUE',
        'LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE' => 'NEW_ORIGINAL_VALUE',
        'COL_NEW_ORIGINAL_VALUE' => 'NEW_ORIGINAL_VALUE',
        'new_original_value' => 'NEW_ORIGINAL_VALUE',
        'log_edite_macro_schedule.new_original_value' => 'NEW_ORIGINAL_VALUE',
        'OldNewValue' => 'OLD_NEW_VALUE',
        'LogEditeMacroSchedule.OldNewValue' => 'OLD_NEW_VALUE',
        'oldNewValue' => 'OLD_NEW_VALUE',
        'logEditeMacroSchedule.oldNewValue' => 'OLD_NEW_VALUE',
        'LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE' => 'OLD_NEW_VALUE',
        'COL_OLD_NEW_VALUE' => 'OLD_NEW_VALUE',
        'old_new_value' => 'OLD_NEW_VALUE',
        'log_edite_macro_schedule.old_new_value' => 'OLD_NEW_VALUE',
        'NewNewValue' => 'NEW_NEW_VALUE',
        'LogEditeMacroSchedule.NewNewValue' => 'NEW_NEW_VALUE',
        'newNewValue' => 'NEW_NEW_VALUE',
        'logEditeMacroSchedule.newNewValue' => 'NEW_NEW_VALUE',
        'LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE' => 'NEW_NEW_VALUE',
        'COL_NEW_NEW_VALUE' => 'NEW_NEW_VALUE',
        'new_new_value' => 'NEW_NEW_VALUE',
        'log_edite_macro_schedule.new_new_value' => 'NEW_NEW_VALUE',
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
        $this->setName('log_edite_macro_schedule');
        $this->setPhpName('LogEditeMacroSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogEditeMacroSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_edite_macro_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('macro_schedule_id', 'MacroScheduleId', 'INTEGER', 'macro_schedule', 'id', true, null, null);
        $this->addForeignKey('log_id', 'LogId', 'INTEGER', 'log', 'id', true, null, null);
        $this->addColumn('old_date_from', 'OldDateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_from', 'NewDateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('old_date_until', 'OldDateUntil', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_until', 'NewDateUntil', 'VARCHAR', true, 50, null);
        $this->addColumn('old_original_value', 'OldOriginalValue', 'VARCHAR', true, 50, null);
        $this->addColumn('new_original_value', 'NewOriginalValue', 'VARCHAR', true, 50, null);
        $this->addColumn('old_new_value', 'OldNewValue', 'VARCHAR', true, 50, null);
        $this->addColumn('new_new_value', 'NewNewValue', 'VARCHAR', true, 50, null);
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
        return $withPrefix ? LogEditeMacroScheduleTableMap::CLASS_DEFAULT : LogEditeMacroScheduleTableMap::OM_CLASS;
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
     * @return array           (LogEditeMacroSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogEditeMacroScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogEditeMacroScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogEditeMacroScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogEditeMacroScheduleTableMap::OM_CLASS;
            /** @var LogEditeMacroSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogEditeMacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = LogEditeMacroScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogEditeMacroScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogEditeMacroSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogEditeMacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_LOG_ID);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE);
            $criteria->addSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.macro_schedule_id');
            $criteria->addSelectColumn($alias . '.log_id');
            $criteria->addSelectColumn($alias . '.old_date_from');
            $criteria->addSelectColumn($alias . '.new_date_from');
            $criteria->addSelectColumn($alias . '.old_date_until');
            $criteria->addSelectColumn($alias . '.new_date_until');
            $criteria->addSelectColumn($alias . '.old_original_value');
            $criteria->addSelectColumn($alias . '.new_original_value');
            $criteria->addSelectColumn($alias . '.old_new_value');
            $criteria->addSelectColumn($alias . '.new_new_value');
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
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_LOG_ID);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE);
            $criteria->removeSelectColumn(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.macro_schedule_id');
            $criteria->removeSelectColumn($alias . '.log_id');
            $criteria->removeSelectColumn($alias . '.old_date_from');
            $criteria->removeSelectColumn($alias . '.new_date_from');
            $criteria->removeSelectColumn($alias . '.old_date_until');
            $criteria->removeSelectColumn($alias . '.new_date_until');
            $criteria->removeSelectColumn($alias . '.old_original_value');
            $criteria->removeSelectColumn($alias . '.new_original_value');
            $criteria->removeSelectColumn($alias . '.old_new_value');
            $criteria->removeSelectColumn($alias . '.new_new_value');
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
        return Propel::getServiceContainer()->getDatabaseMap(LogEditeMacroScheduleTableMap::DATABASE_NAME)->getTable(LogEditeMacroScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogEditeMacroSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogEditeMacroSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogEditeMacroSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogEditeMacroScheduleTableMap::DATABASE_NAME);
            $criteria->add(LogEditeMacroScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogEditeMacroScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogEditeMacroScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogEditeMacroScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_edite_macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogEditeMacroScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogEditeMacroSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogEditeMacroSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogEditeMacroSchedule object
        }

        if ($criteria->containsKey(LogEditeMacroScheduleTableMap::COL_ID) && $criteria->keyContainsValue(LogEditeMacroScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogEditeMacroScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogEditeMacroScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogEditeMacroScheduleTableMap
