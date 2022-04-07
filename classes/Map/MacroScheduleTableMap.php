<?php

namespace Map;

use \MacroSchedule;
use \MacroScheduleQuery;
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
 * This class defines the structure of the 'macro_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MacroScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MacroScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'macro_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\MacroSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'MacroSchedule';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'macro_schedule.id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'macro_schedule.description';

    /**
     * the column name for the schedule_id field
     */
    const COL_SCHEDULE_ID = 'macro_schedule.schedule_id';

    /**
     * the column name for the host_id field
     */
    const COL_HOST_ID = 'macro_schedule.host_id';

    /**
     * the column name for the usuario_id field
     */
    const COL_USUARIO_ID = 'macro_schedule.usuario_id';

    /**
     * the column name for the macro_id field
     */
    const COL_MACRO_ID = 'macro_schedule.macro_id';

    /**
     * the column name for the scheduled field
     */
    const COL_SCHEDULED = 'macro_schedule.scheduled';

    /**
     * the column name for the enabled field
     */
    const COL_ENABLED = 'macro_schedule.enabled';

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
        self::TYPE_PHPNAME       => array('Id', 'Description', 'ScheduleId', 'HostId', 'UsuarioId', 'MacroId', 'Scheduled', 'Enabled', ),
        self::TYPE_CAMELNAME     => array('id', 'description', 'scheduleId', 'hostId', 'usuarioId', 'macroId', 'scheduled', 'enabled', ),
        self::TYPE_COLNAME       => array(MacroScheduleTableMap::COL_ID, MacroScheduleTableMap::COL_DESCRIPTION, MacroScheduleTableMap::COL_SCHEDULE_ID, MacroScheduleTableMap::COL_HOST_ID, MacroScheduleTableMap::COL_USUARIO_ID, MacroScheduleTableMap::COL_MACRO_ID, MacroScheduleTableMap::COL_SCHEDULED, MacroScheduleTableMap::COL_ENABLED, ),
        self::TYPE_FIELDNAME     => array('id', 'description', 'schedule_id', 'host_id', 'usuario_id', 'macro_id', 'scheduled', 'enabled', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Description' => 1, 'ScheduleId' => 2, 'HostId' => 3, 'UsuarioId' => 4, 'MacroId' => 5, 'Scheduled' => 6, 'Enabled' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'description' => 1, 'scheduleId' => 2, 'hostId' => 3, 'usuarioId' => 4, 'macroId' => 5, 'scheduled' => 6, 'enabled' => 7, ),
        self::TYPE_COLNAME       => array(MacroScheduleTableMap::COL_ID => 0, MacroScheduleTableMap::COL_DESCRIPTION => 1, MacroScheduleTableMap::COL_SCHEDULE_ID => 2, MacroScheduleTableMap::COL_HOST_ID => 3, MacroScheduleTableMap::COL_USUARIO_ID => 4, MacroScheduleTableMap::COL_MACRO_ID => 5, MacroScheduleTableMap::COL_SCHEDULED => 6, MacroScheduleTableMap::COL_ENABLED => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'description' => 1, 'schedule_id' => 2, 'host_id' => 3, 'usuario_id' => 4, 'macro_id' => 5, 'scheduled' => 6, 'enabled' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'MacroSchedule.Id' => 'ID',
        'id' => 'ID',
        'macroSchedule.id' => 'ID',
        'MacroScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'macro_schedule.id' => 'ID',
        'Description' => 'DESCRIPTION',
        'MacroSchedule.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'macroSchedule.description' => 'DESCRIPTION',
        'MacroScheduleTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'macro_schedule.description' => 'DESCRIPTION',
        'ScheduleId' => 'SCHEDULE_ID',
        'MacroSchedule.ScheduleId' => 'SCHEDULE_ID',
        'scheduleId' => 'SCHEDULE_ID',
        'macroSchedule.scheduleId' => 'SCHEDULE_ID',
        'MacroScheduleTableMap::COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'schedule_id' => 'SCHEDULE_ID',
        'macro_schedule.schedule_id' => 'SCHEDULE_ID',
        'HostId' => 'HOST_ID',
        'MacroSchedule.HostId' => 'HOST_ID',
        'hostId' => 'HOST_ID',
        'macroSchedule.hostId' => 'HOST_ID',
        'MacroScheduleTableMap::COL_HOST_ID' => 'HOST_ID',
        'COL_HOST_ID' => 'HOST_ID',
        'host_id' => 'HOST_ID',
        'macro_schedule.host_id' => 'HOST_ID',
        'UsuarioId' => 'USUARIO_ID',
        'MacroSchedule.UsuarioId' => 'USUARIO_ID',
        'usuarioId' => 'USUARIO_ID',
        'macroSchedule.usuarioId' => 'USUARIO_ID',
        'MacroScheduleTableMap::COL_USUARIO_ID' => 'USUARIO_ID',
        'COL_USUARIO_ID' => 'USUARIO_ID',
        'usuario_id' => 'USUARIO_ID',
        'macro_schedule.usuario_id' => 'USUARIO_ID',
        'MacroId' => 'MACRO_ID',
        'MacroSchedule.MacroId' => 'MACRO_ID',
        'macroId' => 'MACRO_ID',
        'macroSchedule.macroId' => 'MACRO_ID',
        'MacroScheduleTableMap::COL_MACRO_ID' => 'MACRO_ID',
        'COL_MACRO_ID' => 'MACRO_ID',
        'macro_id' => 'MACRO_ID',
        'macro_schedule.macro_id' => 'MACRO_ID',
        'Scheduled' => 'SCHEDULED',
        'MacroSchedule.Scheduled' => 'SCHEDULED',
        'scheduled' => 'SCHEDULED',
        'macroSchedule.scheduled' => 'SCHEDULED',
        'MacroScheduleTableMap::COL_SCHEDULED' => 'SCHEDULED',
        'COL_SCHEDULED' => 'SCHEDULED',
        'macro_schedule.scheduled' => 'SCHEDULED',
        'Enabled' => 'ENABLED',
        'MacroSchedule.Enabled' => 'ENABLED',
        'enabled' => 'ENABLED',
        'macroSchedule.enabled' => 'ENABLED',
        'MacroScheduleTableMap::COL_ENABLED' => 'ENABLED',
        'COL_ENABLED' => 'ENABLED',
        'macro_schedule.enabled' => 'ENABLED',
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
        $this->setName('macro_schedule');
        $this->setPhpName('MacroSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\MacroSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('macro_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->addForeignKey('schedule_id', 'ScheduleId', 'INTEGER', 'schedule', 'id', true, null, null);
        $this->addForeignKey('host_id', 'HostId', 'INTEGER', 'host', 'id', true, null, null);
        $this->addForeignKey('usuario_id', 'UsuarioId', 'INTEGER', 'usuario', 'id', true, null, null);
        $this->addForeignKey('macro_id', 'MacroId', 'INTEGER', 'macro', 'id', true, null, null);
        $this->addColumn('scheduled', 'Scheduled', 'VARCHAR', true, 50, null);
        $this->addColumn('enabled', 'Enabled', 'VARCHAR', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('Host', '\\Host', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':host_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Macro', '\\Macro', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':macro_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Schedule', '\\Schedule', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':schedule_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Usuario', '\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':usuario_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('LogDeleteMacroSchedule', '\\LogDeleteMacroSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':macro_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogDeleteMacroSchedules', false);
        $this->addRelation('LogEditeMacroSchedule', '\\LogEditeMacroSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':macro_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogEditeMacroSchedules', false);
        $this->addRelation('LogMacroExecution', '\\LogMacroExecution', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':macro_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogMacroExecutions', false);
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
        return $withPrefix ? MacroScheduleTableMap::CLASS_DEFAULT : MacroScheduleTableMap::OM_CLASS;
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
     * @return array           (MacroSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MacroScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MacroScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MacroScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MacroScheduleTableMap::OM_CLASS;
            /** @var MacroSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = MacroScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MacroScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MacroSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MacroScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_HOST_ID);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_USUARIO_ID);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_MACRO_ID);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_SCHEDULED);
            $criteria->addSelectColumn(MacroScheduleTableMap::COL_ENABLED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.schedule_id');
            $criteria->addSelectColumn($alias . '.host_id');
            $criteria->addSelectColumn($alias . '.usuario_id');
            $criteria->addSelectColumn($alias . '.macro_id');
            $criteria->addSelectColumn($alias . '.scheduled');
            $criteria->addSelectColumn($alias . '.enabled');
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
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_HOST_ID);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_USUARIO_ID);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_MACRO_ID);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_SCHEDULED);
            $criteria->removeSelectColumn(MacroScheduleTableMap::COL_ENABLED);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.schedule_id');
            $criteria->removeSelectColumn($alias . '.host_id');
            $criteria->removeSelectColumn($alias . '.usuario_id');
            $criteria->removeSelectColumn($alias . '.macro_id');
            $criteria->removeSelectColumn($alias . '.scheduled');
            $criteria->removeSelectColumn($alias . '.enabled');
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
        return Propel::getServiceContainer()->getDatabaseMap(MacroScheduleTableMap::DATABASE_NAME)->getTable(MacroScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MacroSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or MacroSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MacroScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \MacroSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MacroScheduleTableMap::DATABASE_NAME);
            $criteria->add(MacroScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MacroScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MacroScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MacroScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the macro_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MacroScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MacroSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or MacroSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MacroScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MacroSchedule object
        }

        if ($criteria->containsKey(MacroScheduleTableMap::COL_ID) && $criteria->keyContainsValue(MacroScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MacroScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MacroScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MacroScheduleTableMap
