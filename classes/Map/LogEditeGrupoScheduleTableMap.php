<?php

namespace Map;

use \LogEditeGrupoSchedule;
use \LogEditeGrupoScheduleQuery;
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
 * This class defines the structure of the 'log_edite_grupo_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LogEditeGrupoScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LogEditeGrupoScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'log_edite_grupo_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\LogEditeGrupoSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'LogEditeGrupoSchedule';

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
    const COL_ID = 'log_edite_grupo_schedule.id';

    /**
     * the column name for the grupo_schedule_id field
     */
    const COL_GRUPO_SCHEDULE_ID = 'log_edite_grupo_schedule.grupo_schedule_id';

    /**
     * the column name for the log_id field
     */
    const COL_LOG_ID = 'log_edite_grupo_schedule.log_id';

    /**
     * the column name for the old_date_from field
     */
    const COL_OLD_DATE_FROM = 'log_edite_grupo_schedule.old_date_from';

    /**
     * the column name for the new_date_from field
     */
    const COL_NEW_DATE_FROM = 'log_edite_grupo_schedule.new_date_from';

    /**
     * the column name for the old_date_until field
     */
    const COL_OLD_DATE_UNTIL = 'log_edite_grupo_schedule.old_date_until';

    /**
     * the column name for the new_date_until field
     */
    const COL_NEW_DATE_UNTIL = 'log_edite_grupo_schedule.new_date_until';

    /**
     * the column name for the old_grupo_id field
     */
    const COL_OLD_GRUPO_ID = 'log_edite_grupo_schedule.old_grupo_id';

    /**
     * the column name for the new_grupo_id field
     */
    const COL_NEW_GRUPO_ID = 'log_edite_grupo_schedule.new_grupo_id';

    /**
     * the column name for the old_push_pop field
     */
    const COL_OLD_PUSH_POP = 'log_edite_grupo_schedule.old_push_pop';

    /**
     * the column name for the new_push_pop field
     */
    const COL_NEW_PUSH_POP = 'log_edite_grupo_schedule.new_push_pop';

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
        self::TYPE_PHPNAME       => array('Id', 'GrupoScheduleId', 'LogId', 'OldDateFrom', 'NewDateFrom', 'OldDateUntil', 'NewDateUntil', 'OldGrupoId', 'NewGrupoId', 'OldPushPop', 'NewPushPop', ),
        self::TYPE_CAMELNAME     => array('id', 'grupoScheduleId', 'logId', 'oldDateFrom', 'newDateFrom', 'oldDateUntil', 'newDateUntil', 'oldGrupoId', 'newGrupoId', 'oldPushPop', 'newPushPop', ),
        self::TYPE_COLNAME       => array(LogEditeGrupoScheduleTableMap::COL_ID, LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID, LogEditeGrupoScheduleTableMap::COL_LOG_ID, LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM, LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM, LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL, LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL, LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID, LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID, LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP, LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP, ),
        self::TYPE_FIELDNAME     => array('id', 'grupo_schedule_id', 'log_id', 'old_date_from', 'new_date_from', 'old_date_until', 'new_date_until', 'old_grupo_id', 'new_grupo_id', 'old_push_pop', 'new_push_pop', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'GrupoScheduleId' => 1, 'LogId' => 2, 'OldDateFrom' => 3, 'NewDateFrom' => 4, 'OldDateUntil' => 5, 'NewDateUntil' => 6, 'OldGrupoId' => 7, 'NewGrupoId' => 8, 'OldPushPop' => 9, 'NewPushPop' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'grupoScheduleId' => 1, 'logId' => 2, 'oldDateFrom' => 3, 'newDateFrom' => 4, 'oldDateUntil' => 5, 'newDateUntil' => 6, 'oldGrupoId' => 7, 'newGrupoId' => 8, 'oldPushPop' => 9, 'newPushPop' => 10, ),
        self::TYPE_COLNAME       => array(LogEditeGrupoScheduleTableMap::COL_ID => 0, LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID => 1, LogEditeGrupoScheduleTableMap::COL_LOG_ID => 2, LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM => 3, LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM => 4, LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL => 5, LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL => 6, LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID => 7, LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID => 8, LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP => 9, LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'grupo_schedule_id' => 1, 'log_id' => 2, 'old_date_from' => 3, 'new_date_from' => 4, 'old_date_until' => 5, 'new_date_until' => 6, 'old_grupo_id' => 7, 'new_grupo_id' => 8, 'old_push_pop' => 9, 'new_push_pop' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LogEditeGrupoSchedule.Id' => 'ID',
        'id' => 'ID',
        'logEditeGrupoSchedule.id' => 'ID',
        'LogEditeGrupoScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'log_edite_grupo_schedule.id' => 'ID',
        'GrupoScheduleId' => 'GRUPO_SCHEDULE_ID',
        'LogEditeGrupoSchedule.GrupoScheduleId' => 'GRUPO_SCHEDULE_ID',
        'grupoScheduleId' => 'GRUPO_SCHEDULE_ID',
        'logEditeGrupoSchedule.grupoScheduleId' => 'GRUPO_SCHEDULE_ID',
        'LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID' => 'GRUPO_SCHEDULE_ID',
        'COL_GRUPO_SCHEDULE_ID' => 'GRUPO_SCHEDULE_ID',
        'grupo_schedule_id' => 'GRUPO_SCHEDULE_ID',
        'log_edite_grupo_schedule.grupo_schedule_id' => 'GRUPO_SCHEDULE_ID',
        'LogId' => 'LOG_ID',
        'LogEditeGrupoSchedule.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'logEditeGrupoSchedule.logId' => 'LOG_ID',
        'LogEditeGrupoScheduleTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'log_edite_grupo_schedule.log_id' => 'LOG_ID',
        'OldDateFrom' => 'OLD_DATE_FROM',
        'LogEditeGrupoSchedule.OldDateFrom' => 'OLD_DATE_FROM',
        'oldDateFrom' => 'OLD_DATE_FROM',
        'logEditeGrupoSchedule.oldDateFrom' => 'OLD_DATE_FROM',
        'LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM' => 'OLD_DATE_FROM',
        'COL_OLD_DATE_FROM' => 'OLD_DATE_FROM',
        'old_date_from' => 'OLD_DATE_FROM',
        'log_edite_grupo_schedule.old_date_from' => 'OLD_DATE_FROM',
        'NewDateFrom' => 'NEW_DATE_FROM',
        'LogEditeGrupoSchedule.NewDateFrom' => 'NEW_DATE_FROM',
        'newDateFrom' => 'NEW_DATE_FROM',
        'logEditeGrupoSchedule.newDateFrom' => 'NEW_DATE_FROM',
        'LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'COL_NEW_DATE_FROM' => 'NEW_DATE_FROM',
        'new_date_from' => 'NEW_DATE_FROM',
        'log_edite_grupo_schedule.new_date_from' => 'NEW_DATE_FROM',
        'OldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditeGrupoSchedule.OldDateUntil' => 'OLD_DATE_UNTIL',
        'oldDateUntil' => 'OLD_DATE_UNTIL',
        'logEditeGrupoSchedule.oldDateUntil' => 'OLD_DATE_UNTIL',
        'LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'COL_OLD_DATE_UNTIL' => 'OLD_DATE_UNTIL',
        'old_date_until' => 'OLD_DATE_UNTIL',
        'log_edite_grupo_schedule.old_date_until' => 'OLD_DATE_UNTIL',
        'NewDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditeGrupoSchedule.NewDateUntil' => 'NEW_DATE_UNTIL',
        'newDateUntil' => 'NEW_DATE_UNTIL',
        'logEditeGrupoSchedule.newDateUntil' => 'NEW_DATE_UNTIL',
        'LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'COL_NEW_DATE_UNTIL' => 'NEW_DATE_UNTIL',
        'new_date_until' => 'NEW_DATE_UNTIL',
        'log_edite_grupo_schedule.new_date_until' => 'NEW_DATE_UNTIL',
        'OldGrupoId' => 'OLD_GRUPO_ID',
        'LogEditeGrupoSchedule.OldGrupoId' => 'OLD_GRUPO_ID',
        'oldGrupoId' => 'OLD_GRUPO_ID',
        'logEditeGrupoSchedule.oldGrupoId' => 'OLD_GRUPO_ID',
        'LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID' => 'OLD_GRUPO_ID',
        'COL_OLD_GRUPO_ID' => 'OLD_GRUPO_ID',
        'old_grupo_id' => 'OLD_GRUPO_ID',
        'log_edite_grupo_schedule.old_grupo_id' => 'OLD_GRUPO_ID',
        'NewGrupoId' => 'NEW_GRUPO_ID',
        'LogEditeGrupoSchedule.NewGrupoId' => 'NEW_GRUPO_ID',
        'newGrupoId' => 'NEW_GRUPO_ID',
        'logEditeGrupoSchedule.newGrupoId' => 'NEW_GRUPO_ID',
        'LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID' => 'NEW_GRUPO_ID',
        'COL_NEW_GRUPO_ID' => 'NEW_GRUPO_ID',
        'new_grupo_id' => 'NEW_GRUPO_ID',
        'log_edite_grupo_schedule.new_grupo_id' => 'NEW_GRUPO_ID',
        'OldPushPop' => 'OLD_PUSH_POP',
        'LogEditeGrupoSchedule.OldPushPop' => 'OLD_PUSH_POP',
        'oldPushPop' => 'OLD_PUSH_POP',
        'logEditeGrupoSchedule.oldPushPop' => 'OLD_PUSH_POP',
        'LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP' => 'OLD_PUSH_POP',
        'COL_OLD_PUSH_POP' => 'OLD_PUSH_POP',
        'old_push_pop' => 'OLD_PUSH_POP',
        'log_edite_grupo_schedule.old_push_pop' => 'OLD_PUSH_POP',
        'NewPushPop' => 'NEW_PUSH_POP',
        'LogEditeGrupoSchedule.NewPushPop' => 'NEW_PUSH_POP',
        'newPushPop' => 'NEW_PUSH_POP',
        'logEditeGrupoSchedule.newPushPop' => 'NEW_PUSH_POP',
        'LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP' => 'NEW_PUSH_POP',
        'COL_NEW_PUSH_POP' => 'NEW_PUSH_POP',
        'new_push_pop' => 'NEW_PUSH_POP',
        'log_edite_grupo_schedule.new_push_pop' => 'NEW_PUSH_POP',
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
        $this->setName('log_edite_grupo_schedule');
        $this->setPhpName('LogEditeGrupoSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\LogEditeGrupoSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('log_edite_grupo_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('grupo_schedule_id', 'GrupoScheduleId', 'INTEGER', 'grupo_schedule', 'id', true, null, null);
        $this->addForeignKey('log_id', 'LogId', 'INTEGER', 'log', 'id', true, null, null);
        $this->addColumn('old_date_from', 'OldDateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_from', 'NewDateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('old_date_until', 'OldDateUntil', 'VARCHAR', true, 50, null);
        $this->addColumn('new_date_until', 'NewDateUntil', 'VARCHAR', true, 50, null);
        $this->addForeignKey('old_grupo_id', 'OldGrupoId', 'INTEGER', 'grupo', 'id', true, null, null);
        $this->addForeignKey('new_grupo_id', 'NewGrupoId', 'INTEGER', 'grupo', 'id', true, null, null);
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
        $this->addRelation('GrupoSchedule', '\\GrupoSchedule', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':grupo_schedule_id',
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
        $this->addRelation('GrupoRelatedByNewGrupoId', '\\Grupo', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':new_grupo_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('GrupoRelatedByOldGrupoId', '\\Grupo', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':old_grupo_id',
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
        return $withPrefix ? LogEditeGrupoScheduleTableMap::CLASS_DEFAULT : LogEditeGrupoScheduleTableMap::OM_CLASS;
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
     * @return array           (LogEditeGrupoSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LogEditeGrupoScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LogEditeGrupoScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LogEditeGrupoScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LogEditeGrupoScheduleTableMap::OM_CLASS;
            /** @var LogEditeGrupoSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LogEditeGrupoScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = LogEditeGrupoScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LogEditeGrupoScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LogEditeGrupoSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LogEditeGrupoScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_LOG_ID);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP);
            $criteria->addSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.grupo_schedule_id');
            $criteria->addSelectColumn($alias . '.log_id');
            $criteria->addSelectColumn($alias . '.old_date_from');
            $criteria->addSelectColumn($alias . '.new_date_from');
            $criteria->addSelectColumn($alias . '.old_date_until');
            $criteria->addSelectColumn($alias . '.new_date_until');
            $criteria->addSelectColumn($alias . '.old_grupo_id');
            $criteria->addSelectColumn($alias . '.new_grupo_id');
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
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_GRUPO_SCHEDULE_ID);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_LOG_ID);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_FROM);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_FROM);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_DATE_UNTIL);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_GRUPO_ID);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_GRUPO_ID);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_OLD_PUSH_POP);
            $criteria->removeSelectColumn(LogEditeGrupoScheduleTableMap::COL_NEW_PUSH_POP);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.grupo_schedule_id');
            $criteria->removeSelectColumn($alias . '.log_id');
            $criteria->removeSelectColumn($alias . '.old_date_from');
            $criteria->removeSelectColumn($alias . '.new_date_from');
            $criteria->removeSelectColumn($alias . '.old_date_until');
            $criteria->removeSelectColumn($alias . '.new_date_until');
            $criteria->removeSelectColumn($alias . '.old_grupo_id');
            $criteria->removeSelectColumn($alias . '.new_grupo_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(LogEditeGrupoScheduleTableMap::DATABASE_NAME)->getTable(LogEditeGrupoScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LogEditeGrupoSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LogEditeGrupoSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \LogEditeGrupoSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
            $criteria->add(LogEditeGrupoScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LogEditeGrupoScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LogEditeGrupoScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LogEditeGrupoScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the log_edite_grupo_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LogEditeGrupoScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LogEditeGrupoSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or LogEditeGrupoSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeGrupoScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LogEditeGrupoSchedule object
        }

        if ($criteria->containsKey(LogEditeGrupoScheduleTableMap::COL_ID) && $criteria->keyContainsValue(LogEditeGrupoScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LogEditeGrupoScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LogEditeGrupoScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LogEditeGrupoScheduleTableMap
