<?php

namespace Map;

use \LogEditHostSchedule;
use \LogEditHostScheduleQuery;
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
 * This class defines the structure of the 'log_edit_host_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogEditHostScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogEditHostScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_edit_host_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogEditHostSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogEditHostSchedule';

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
    const COL_ID = 'log_edit_host_schedule.id';

    /**
     * the column name for the host_schedule_id field
     */
    const COL_HOST_SCHEDULE_ID = 'log_edit_host_schedule.host_schedule_id';

    /**
     * the column name for the old_host_id field
     */
    const COL_OLD_HOST_ID = 'log_edit_host_schedule.old_host_id';

    /**
     * the column name for the new_host_id field
     */
    const COL_NEW_HOST_ID = 'log_edit_host_schedule.new_host_id';

    /**
     * the column name for the log_id field
     */
    const COL_LOG_ID = 'log_edit_host_schedule.log_id';

    /**
     * the column name for the old_data_from field
     */
    const COL_OLD_DATA_FROM = 'log_edit_host_schedule.old_data_from';

    /**
     * the column name for the new_date_from field
     */
    const COL_NEW_DATE_FROM = 'log_edit_host_schedule.new_date_from';

    /**
     * the column name for the old_date_until field
     */
    const COL_OLD_DATE_UNTIL = 'log_edit_host_schedule.old_date_until';

    /**
     * the column name for the new_date_until field
     */
    const COL_NEW_DATE_UNTIL = 'log_edit_host_schedule.new_date_until';

    /**
     * the column name for the old_push_pop field
     */
    const COL_OLD_PUSH_POP = 'log_edit_host_schedule.old_push_pop';

    /**
     * the column name for the new_push_pop field
     */
    const COL_NEW_PUSH_POP = 'log_edit_host_schedule.new_push_pop';

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
        self::TYPE_PHPNAME       => array('Id', 'HostScheduleId', 'OldHostId', 'NewHostId', 'LogId', 'OldDataFrom', 'NewDateFrom', 'OldDateUntil', 'NewDateUntil', 'OldPushPop', 'NewPushPop', ),
        self::TYPE_CAMELNAME     => array('id', 'hostScheduleId', 'oldHostId', 'newHostId', 'logId', 'oldDataFrom', 'newDateFrom', 'oldDateUntil', 'newDateUntil', 'oldPushPop', 'newPushPop', ),
        self::TYPE_COLNAME       => array(LogEditHostScheduleTableMap::COL_ID, LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID, LogEditHostScheduleTableMap::COL_OLD_HOST_ID, LogEditHostScheduleTableMap::COL_NEW_HOST_ID, LogEditHostScheduleTableMap::COL_LOG_ID, LogEditHostScheduleTableMap::COL_OLD_DATA_FROM, LogEditHostScheduleTableMap::COL_NEW_DATE_FROM, LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL, LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL, LogEditHostScheduleTableMap::COL_OLD_PUSH_POP, LogEditHostScheduleTableMap::COL_NEW_PUSH_POP, ),
        self::TYPE_FIELDNAME     => array('id', 'host_schedule_id', 'old_host_id', 'new_host_id', 'log_id', 'old_data_from', 'new_date_from', 'old_date_until', 'new_date_until', 'old_push_pop', 'new_push_pop', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'HostScheduleId' => 1, 'OldHostId' => 2, 'NewHostId' => 3, 'LogId' => 4, 'OldDataFrom' => 5, 'NewDateFrom' => 6, 'OldDateUntil' => 7, 'NewDateUntil' => 8, 'OldPushPop' => 9, 'NewPushPop' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'hostScheduleId' => 1, 'oldHostId' => 2, 'newHostId' => 3, 'logId' => 4, 'oldDataFrom' => 5, 'newDateFrom' => 6, 'oldDateUntil' => 7, 'newDateUntil' => 8, 'oldPushPop' => 9, 'newPushPop' => 10, ),
        self::TYPE_COLNAME       => array(LogEditHostScheduleTableMap::COL_ID => 0, LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID => 1, LogEditHostScheduleTableMap::COL_OLD_HOST_ID => 2, LogEditHostScheduleTableMap::COL_NEW_HOST_ID => 3, LogEditHostScheduleTableMap::COL_LOG_ID => 4, LogEditHostScheduleTableMap::COL_OLD_DATA_FROM => 5, LogEditHostScheduleTableMap::COL_NEW_DATE_FROM => 6, LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL => 7, LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL => 8, LogEditHostScheduleTableMap::COL_OLD_PUSH_POP => 9, LogEditHostScheduleTableMap::COL_NEW_PUSH_POP => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'host_schedule_id' => 1, 'old_host_id' => 2, 'new_host_id' => 3, 'log_id' => 4, 'old_data_from' => 5, 'new_date_from' => 6, 'old_date_until' => 7, 'new_date_until' => 8, 'old_push_pop' => 9, 'new_push_pop' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogEditHostSchedule.Id' => 'ID',
        'id' => 'ID',
        'logEditHostSchedule.id' => 'ID',
        'LogEditHostScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_edit_host_schedule.id' => 'ID',
        'HostScheduleId' => 'HOST_SCHEDULE_ID',
        'LogEditHostSchedule.HostScheduleId' => 'HOST_SCHEDULE_ID',
        'hostScheduleId' => 'HOST_SCHEDULE_ID',
        'logEditHostSchedule.hostScheduleId' => 'HOST_SCHEDULE_ID',
        'LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID' => 'HOST_SCHEDULE_ID',
        'COL_HOST_SCHEDULE_ID' => 'HOST_SCHEDULE_ID',
        'host_schedule_id' => 'HOST_SCHEDULE_ID',
        'log_edit_host_schedule.host_schedule_id' => 'HOST_SCHEDULE_ID',
        'OldHostId' => 'OLD_HOST_ID',
        'LogEditHostSchedule.OldHostId' => 'OLD_HOST_ID',
        'oldHostId' => 'OLD_HOST_ID',
        'logEditHostSchedule.oldHostId' => 'OLD_HOST_ID',
        'LogEditHostScheduleTableMap::COL_OLD_HOST_ID' => 'OLD_HOST_ID',
        'COL_OLD_HOST_ID' => 'OLD_HOST_ID',
        'old_host_id' => 'OLD_HOST_ID',
        'log_edit_host_schedule.old_host_id' => 'OLD_HOST_ID',
        'NewHostId' => 'NEW_HOST_ID',
        'LogEditHostSchedule.NewHostId' => 'NEW_HOST_ID',
        'newHostId' => 'NEW_HOST_ID',
        'logEditHostSchedule.newHostId' => 'NEW_HOST_ID',
        'LogEditHostScheduleTableMap::COL_NEW_HOST_ID' => 'NEW_HOST_ID',
        'COL_NEW_HOST_ID' => 'NEW_HOST_ID',
        'new_host_id' => 'NEW_HOST_ID',
        'log_edit_host_schedule.new_host_id' => 'NEW_HOST_ID',
        'LogId' => 'LOG_ID',
        'LogEditHostSchedule.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'logEditHostSchedule.logId' => 'LOG_ID',
        'LogEditHostScheduleTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'log_edit_host_schedule.log_id' => 'LOG_ID',
        'OldDataFrom' => 'OLD_DATA_FROM',
        'LogEditHostSchedule.OldDataFrom' => 'OLD_DATA_FROM',
        'oldDataFrom' => 'OLD_DATA_FROM',
        'logEditHostSchedule.oldDataFrom' => 'OLD_DATA_FROM',
        'LogEditHostScheduleTableMap::COL_OLD_DATA_FROM' => 'OLD_DATA_FROM',
        'COL_OLD_DATA_FROM' => 'OLD_DATA_FROM',
        'old_data_from' => 'OLD_DATA_FROM',
        'log_edit_host_schedule.old_data_from' => 'OLD_DATA_FROM',
        'NewDateFrom' => 'NEW_DATE_FROM',
        'LogEditHostSchedule.NewDateFrom' => 'NEW_DATE_FROM',
        'newDateFrom' => 'NEW_DATE_FROM',
        'logEditHostSchedule.newDateFrom' => 'NEW_DATE_FROM',
        'LogEditHostScheduleTableMap::COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'new_date_from' => 'NEW_DATE_FROM',
        'log_edit_host_schedule.new_date_from' => 'NEW_DATE_FROM',
        'OldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditHostSchedule.OldDateUntil' => 'OLD_DATE_UNTIL',
        'oldDateUntil' => 'OLD_DATE_UNTIL',
        'logEditHostSchedule.oldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'old_date_until' => 'OLD_DATE_UNTIL',
        'log_edit_host_schedule.old_date_until' => 'OLD_DATE_UNTIL',
        'NewDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditHostSchedule.NewDateUntil' => 'NEW_DATE_UNTIL',
        'newDateUntil' => 'NEW_DATE_UNTIL',
        'logEditHostSchedule.newDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'new_date_until' => 'NEW_DATE_UNTIL',
        'log_edit_host_schedule.new_date_until' => 'NEW_DATE_UNTIL',
        'OldPushPop' => 'OLD_PUSH_POP',
        'LogEditHostSchedule.OldPushPop' => 'OLD_PUSH_POP',
        'oldPushPop' => 'OLD_PUSH_POP',
        'logEditHostSchedule.oldPushPop' => 'OLD_PUSH_POP',
        'LogEditHostScheduleTableMap::COL_OLD_PUSH_POP' => 'OLD_PUSH_POP',
        'COL_OLD_PUSH_POP' => 'OLD_PUSH_POP',
        'old_push_pop' => 'OLD_PUSH_POP',
        'log_edit_host_schedule.old_push_pop' => 'OLD_PUSH_POP',
        'NewPushPop' => 'NEW_PUSH_POP',
        'LogEditHostSchedule.NewPushPop' => 'NEW_PUSH_POP',
        'newPushPop' => 'NEW_PUSH_POP',
        'logEditHostSchedule.newPushPop' => 'NEW_PUSH_POP',
        'LogEditHostScheduleTableMap::COL_NEW_PUSH_POP' => 'NEW_PUSH_POP',
        'COL_NEW_PUSH_POP' => 'NEW_PUSH_POP',
        'new_push_pop' => 'NEW_PUSH_POP',
        'log_edit_host_schedule.new_push_pop' => 'NEW_PUSH_POP',
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
        $this->setName('log_edit_host_schedule');
        $this->setPhpName('LogEditHostSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogEditHostSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_edit_host_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('host_schedule_id', 'HostScheduleId', 'INTEGER', 'host_schedule', 'id', true, null, null);
        $this->addForeignKey('old_host_id', 'OldHostId', 'INTEGER', 'host', 'id', true, null, null);
        $this->addForeignKey('new_host_id', 'NewHostId', 'INTEGER', 'host', 'id', true, null, null);
        $this->addForeignKey('log_id', 'LogId', 'INTEGER', 'log', 'id', true, null, null);
        $this->addColumn('old_data_from', 'OldDataFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_from', 'NewDateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('old_date_until', 'OldDateUntil', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_until', 'NewDateUntil', 'VARCHAR', true, 50, null);
        $this->addColumn('old_push_pop', 'OldPushPop', 'VARCHAR', true, 1, null);
        $this->addColumn('new_push_pop', 'NewPushPop', 'VARCHAR', true, 1, null);
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
        $this->addRelation('Log', '\\Log', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':log_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('HostRelatedByNewHostId', '\\Host', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':new_host_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('HostRelatedByOldHostId', '\\Host', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':old_host_id',
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
        return $withPrefix ? LogEditHostScheduleTableMap::CLASS_DEFAULT : LogEditHostScheduleTableMap::OM_CLASS;
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
     * @return array           (LogEditHostSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogEditHostScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogEditHostScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogEditHostScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogEditHostScheduleTableMap::OM_CLASS;
            /** @var LogEditHostSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogEditHostScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = LogEditHostScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogEditHostScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogEditHostSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogEditHostScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_OLD_HOST_ID);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_NEW_HOST_ID);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_LOG_ID);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_OLD_DATA_FROM);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_OLD_PUSH_POP);
            $criteria->addSelectColumn(LogEditHostScheduleTableMap::COL_NEW_PUSH_POP);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.host_schedule_id');
            $criteria->addSelectColumn($alias . '.old_host_id');
            $criteria->addSelectColumn($alias . '.new_host_id');
            $criteria->addSelectColumn($alias . '.log_id');
            $criteria->addSelectColumn($alias . '.old_data_from');
            $criteria->addSelectColumn($alias . '.new_date_from');
            $criteria->addSelectColumn($alias . '.old_date_until');
            $criteria->addSelectColumn($alias . '.new_date_until');
            $criteria->addSelectColumn($alias . '.old_push_pop');
            $criteria->addSelectColumn($alias . '.new_push_pop');
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
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_HOST_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_OLD_HOST_ID);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_NEW_HOST_ID);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_LOG_ID);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_OLD_DATA_FROM);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_OLD_PUSH_POP);
            $criteria->removeSelectColumn(LogEditHostScheduleTableMap::COL_NEW_PUSH_POP);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.host_schedule_id');
            $criteria->removeSelectColumn($alias . '.old_host_id');
            $criteria->removeSelectColumn($alias . '.new_host_id');
            $criteria->removeSelectColumn($alias . '.log_id');
            $criteria->removeSelectColumn($alias . '.old_data_from');
            $criteria->removeSelectColumn($alias . '.new_date_from');
            $criteria->removeSelectColumn($alias . '.old_date_until');
            $criteria->removeSelectColumn($alias . '.new_date_until');
            $criteria->removeSelectColumn($alias . '.old_push_pop');
            $criteria->removeSelectColumn($alias . '.new_push_pop');
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
        return Propel::getServiceContainer()->getDatabaseMap(LogEditHostScheduleTableMap::DATABASE_NAME)->getTable(LogEditHostScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogEditHostSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogEditHostSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditHostScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogEditHostSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogEditHostScheduleTableMap::DATABASE_NAME);
            $criteria->add(LogEditHostScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogEditHostScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogEditHostScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogEditHostScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_edit_host_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogEditHostScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogEditHostSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogEditHostSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditHostScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogEditHostSchedule object
        }

        if ($criteria->containsKey(LogEditHostScheduleTableMap::COL_ID) && $criteria->keyContainsValue(LogEditHostScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogEditHostScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogEditHostScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogEditHostScheduleTableMap
