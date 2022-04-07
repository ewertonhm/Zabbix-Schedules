<?php

namespace Map;

use \HostSchedule;
use \HostScheduleQuery;
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
 * This class defines the structure of the 'host_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HostScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.HostScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'host_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\HostSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'HostSchedule';

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
    const COL_ID = 'host_schedule.id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'host_schedule.description';

    /**
     * the column name for the scheduled field
     */
    const COL_SCHEDULED = 'host_schedule.scheduled';

    /**
     * the column name for the schedule_id field
     */
    const COL_SCHEDULE_ID = 'host_schedule.schedule_id';

    /**
     * the column name for the host_id field
     */
    const COL_HOST_ID = 'host_schedule.host_id';

    /**
     * the column name for the push_pop field
     */
    const COL_PUSH_POP = 'host_schedule.push_pop';

    /**
     * the column name for the enabled field
     */
    const COL_ENABLED = 'host_schedule.enabled';

    /**
     * the column name for the usuario_id field
     */
    const COL_USUARIO_ID = 'host_schedule.usuario_id';

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
        self::TYPE_PHPNAME       => array('Id', 'Description', 'Scheduled', 'ScheduleId', 'HostId', 'PushPop', 'Enabled', 'UsuarioId', ),
        self::TYPE_CAMELNAME     => array('id', 'description', 'scheduled', 'scheduleId', 'hostId', 'pushPop', 'enabled', 'usuarioId', ),
        self::TYPE_COLNAME       => array(HostScheduleTableMap::COL_ID, HostScheduleTableMap::COL_DESCRIPTION, HostScheduleTableMap::COL_SCHEDULED, HostScheduleTableMap::COL_SCHEDULE_ID, HostScheduleTableMap::COL_HOST_ID, HostScheduleTableMap::COL_PUSH_POP, HostScheduleTableMap::COL_ENABLED, HostScheduleTableMap::COL_USUARIO_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'description', 'scheduled', 'schedule_id', 'host_id', 'push_pop', 'enabled', 'usuario_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Description' => 1, 'Scheduled' => 2, 'ScheduleId' => 3, 'HostId' => 4, 'PushPop' => 5, 'Enabled' => 6, 'UsuarioId' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'description' => 1, 'scheduled' => 2, 'scheduleId' => 3, 'hostId' => 4, 'pushPop' => 5, 'enabled' => 6, 'usuarioId' => 7, ),
        self::TYPE_COLNAME       => array(HostScheduleTableMap::COL_ID => 0, HostScheduleTableMap::COL_DESCRIPTION => 1, HostScheduleTableMap::COL_SCHEDULED => 2, HostScheduleTableMap::COL_SCHEDULE_ID => 3, HostScheduleTableMap::COL_HOST_ID => 4, HostScheduleTableMap::COL_PUSH_POP => 5, HostScheduleTableMap::COL_ENABLED => 6, HostScheduleTableMap::COL_USUARIO_ID => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'description' => 1, 'scheduled' => 2, 'schedule_id' => 3, 'host_id' => 4, 'push_pop' => 5, 'enabled' => 6, 'usuario_id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'HostSchedule.Id' => 'ID',
        'id' => 'ID',
        'hostSchedule.id' => 'ID',
        'HostScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'host_schedule.id' => 'ID',
        'Description' => 'DESCRIPTION',
        'HostSchedule.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'hostSchedule.description' => 'DESCRIPTION',
        'HostScheduleTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'host_schedule.description' => 'DESCRIPTION',
        'Scheduled' => 'SCHEDULED',
        'HostSchedule.Scheduled' => 'SCHEDULED',
        'scheduled' => 'SCHEDULED',
        'hostSchedule.scheduled' => 'SCHEDULED',
        'HostScheduleTableMap::COL_SCHEDULED' => 'SCHEDULED',
        'COL_SCHEDULED' => 'SCHEDULED',
        'host_schedule.scheduled' => 'SCHEDULED',
        'ScheduleId' => 'SCHEDULE_ID',
        'HostSchedule.ScheduleId' => 'SCHEDULE_ID',
        'scheduleId' => 'SCHEDULE_ID',
        'hostSchedule.scheduleId' => 'SCHEDULE_ID',
        'HostScheduleTableMap::COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'schedule_id' => 'SCHEDULE_ID',
        'host_schedule.schedule_id' => 'SCHEDULE_ID',
        'HostId' => 'HOST_ID',
        'HostSchedule.HostId' => 'HOST_ID',
        'hostId' => 'HOST_ID',
        'hostSchedule.hostId' => 'HOST_ID',
        'HostScheduleTableMap::COL_HOST_ID' => 'HOST_ID',
        'COL_HOST_ID' => 'HOST_ID',
        'host_id' => 'HOST_ID',
        'host_schedule.host_id' => 'HOST_ID',
        'PushPop' => 'PUSH_POP',
        'HostSchedule.PushPop' => 'PUSH_POP',
        'pushPop' => 'PUSH_POP',
        'hostSchedule.pushPop' => 'PUSH_POP',
        'HostScheduleTableMap::COL_PUSH_POP' => 'PUSH_POP',
        'COL_PUSH_POP' => 'PUSH_POP',
        'push_pop' => 'PUSH_POP',
        'host_schedule.push_pop' => 'PUSH_POP',
        'Enabled' => 'ENABLED',
        'HostSchedule.Enabled' => 'ENABLED',
        'enabled' => 'ENABLED',
        'hostSchedule.enabled' => 'ENABLED',
        'HostScheduleTableMap::COL_ENABLED' => 'ENABLED',
        'COL_ENABLED' => 'ENABLED',
        'host_schedule.enabled' => 'ENABLED',
        'UsuarioId' => 'USUARIO_ID',
        'HostSchedule.UsuarioId' => 'USUARIO_ID',
        'usuarioId' => 'USUARIO_ID',
        'hostSchedule.usuarioId' => 'USUARIO_ID',
        'HostScheduleTableMap::COL_USUARIO_ID' => 'USUARIO_ID',
        'COL_USUARIO_ID' => 'USUARIO_ID',
        'usuario_id' => 'USUARIO_ID',
        'host_schedule.usuario_id' => 'USUARIO_ID',
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
        $this->setName('host_schedule');
        $this->setPhpName('HostSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\HostSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('host_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->addColumn('scheduled', 'Scheduled', 'VARCHAR', true, 50, null);
        $this->addForeignKey('schedule_id', 'ScheduleId', 'INTEGER', 'schedule', 'id', true, null, null);
        $this->addForeignKey('host_id', 'HostId', 'INTEGER', 'host', 'id', true, null, null);
        $this->addColumn('push_pop', 'PushPop', 'VARCHAR', true, 1, null);
        $this->addColumn('enabled', 'Enabled', 'VARCHAR', true, 1, null);
        $this->addForeignKey('usuario_id', 'UsuarioId', 'INTEGER', 'usuario', 'id', false, null, null);
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
        $this->addRelation('LogDeleteHostSchedule', '\\LogDeleteHostSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':host_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogDeleteHostSchedules', false);
        $this->addRelation('LogEditHostSchedule', '\\LogEditHostSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':host_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogEditHostSchedules', false);
        $this->addRelation('LogHostExecution', '\\LogHostExecution', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':host_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogHostExecutions', false);
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
        return $withPrefix ? HostScheduleTableMap::CLASS_DEFAULT : HostScheduleTableMap::OM_CLASS;
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
     * @return array           (HostSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = HostScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HostScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HostScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HostScheduleTableMap::OM_CLASS;
            /** @var HostSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HostScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = HostScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HostScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HostSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HostScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HostScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_SCHEDULED);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_HOST_ID);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_PUSH_POP);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_ENABLED);
            $criteria->addSelectColumn(HostScheduleTableMap::COL_USUARIO_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.scheduled');
            $criteria->addSelectColumn($alias . '.schedule_id');
            $criteria->addSelectColumn($alias . '.host_id');
            $criteria->addSelectColumn($alias . '.push_pop');
            $criteria->addSelectColumn($alias . '.enabled');
            $criteria->addSelectColumn($alias . '.usuario_id');
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
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_SCHEDULED);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_HOST_ID);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_PUSH_POP);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_ENABLED);
            $criteria->removeSelectColumn(HostScheduleTableMap::COL_USUARIO_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.scheduled');
            $criteria->removeSelectColumn($alias . '.schedule_id');
            $criteria->removeSelectColumn($alias . '.host_id');
            $criteria->removeSelectColumn($alias . '.push_pop');
            $criteria->removeSelectColumn($alias . '.enabled');
            $criteria->removeSelectColumn($alias . '.usuario_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(HostScheduleTableMap::DATABASE_NAME)->getTable(HostScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HostSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or HostSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \HostSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HostScheduleTableMap::DATABASE_NAME);
            $criteria->add(HostScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = HostScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HostScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HostScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the host_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return HostScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HostSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or HostSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HostSchedule object
        }

        if ($criteria->containsKey(HostScheduleTableMap::COL_ID) && $criteria->keyContainsValue(HostScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HostScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = HostScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // HostScheduleTableMap
