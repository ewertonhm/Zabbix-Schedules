<?php

namespace Map;

use \GrupoSchedule;
use \GrupoScheduleQuery;
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
 * This class defines the structure of the 'grupo_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GrupoScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.GrupoScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'grupo_schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\GrupoSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'GrupoSchedule';

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
    const COL_ID = 'grupo_schedule.id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'grupo_schedule.description';

    /**
     * the column name for the schedule_id field
     */
    const COL_SCHEDULE_ID = 'grupo_schedule.schedule_id';

    /**
     * the column name for the usuario_id field
     */
    const COL_USUARIO_ID = 'grupo_schedule.usuario_id';

    /**
     * the column name for the grupo_id field
     */
    const COL_GRUPO_ID = 'grupo_schedule.grupo_id';

    /**
     * the column name for the scheduled field
     */
    const COL_SCHEDULED = 'grupo_schedule.scheduled';

    /**
     * the column name for the push_pop field
     */
    const COL_PUSH_POP = 'grupo_schedule.push_pop';

    /**
     * the column name for the enabled field
     */
    const COL_ENABLED = 'grupo_schedule.enabled';

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
        self::TYPE_PHPNAME       => array('Id', 'Description', 'ScheduleId', 'UsuarioId', 'GrupoId', 'Scheduled', 'PushPop', 'Enabled', ),
        self::TYPE_CAMELNAME     => array('id', 'description', 'scheduleId', 'usuarioId', 'grupoId', 'scheduled', 'pushPop', 'enabled', ),
        self::TYPE_COLNAME       => array(GrupoScheduleTableMap::COL_ID, GrupoScheduleTableMap::COL_DESCRIPTION, GrupoScheduleTableMap::COL_SCHEDULE_ID, GrupoScheduleTableMap::COL_USUARIO_ID, GrupoScheduleTableMap::COL_GRUPO_ID, GrupoScheduleTableMap::COL_SCHEDULED, GrupoScheduleTableMap::COL_PUSH_POP, GrupoScheduleTableMap::COL_ENABLED, ),
        self::TYPE_FIELDNAME     => array('id', 'description', 'schedule_id', 'usuario_id', 'grupo_id', 'scheduled', 'push_pop', 'enabled', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Description' => 1, 'ScheduleId' => 2, 'UsuarioId' => 3, 'GrupoId' => 4, 'Scheduled' => 5, 'PushPop' => 6, 'Enabled' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'description' => 1, 'scheduleId' => 2, 'usuarioId' => 3, 'grupoId' => 4, 'scheduled' => 5, 'pushPop' => 6, 'enabled' => 7, ),
        self::TYPE_COLNAME       => array(GrupoScheduleTableMap::COL_ID => 0, GrupoScheduleTableMap::COL_DESCRIPTION => 1, GrupoScheduleTableMap::COL_SCHEDULE_ID => 2, GrupoScheduleTableMap::COL_USUARIO_ID => 3, GrupoScheduleTableMap::COL_GRUPO_ID => 4, GrupoScheduleTableMap::COL_SCHEDULED => 5, GrupoScheduleTableMap::COL_PUSH_POP => 6, GrupoScheduleTableMap::COL_ENABLED => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'description' => 1, 'schedule_id' => 2, 'usuario_id' => 3, 'grupo_id' => 4, 'scheduled' => 5, 'push_pop' => 6, 'enabled' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'GrupoSchedule.Id' => 'ID',
        'id' => 'ID',
        'grupoSchedule.id' => 'ID',
        'GrupoScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'grupo_schedule.id' => 'ID',
        'Description' => 'DESCRIPTION',
        'GrupoSchedule.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'grupoSchedule.description' => 'DESCRIPTION',
        'GrupoScheduleTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'grupo_schedule.description' => 'DESCRIPTION',
        'ScheduleId' => 'SCHEDULE_ID',
        'GrupoSchedule.ScheduleId' => 'SCHEDULE_ID',
        'scheduleId' => 'SCHEDULE_ID',
        'grupoSchedule.scheduleId' => 'SCHEDULE_ID',
        'GrupoScheduleTableMap::COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'COL_SCHEDULE_ID' => 'SCHEDULE_ID',
        'schedule_id' => 'SCHEDULE_ID',
        'grupo_schedule.schedule_id' => 'SCHEDULE_ID',
        'UsuarioId' => 'USUARIO_ID',
        'GrupoSchedule.UsuarioId' => 'USUARIO_ID',
        'usuarioId' => 'USUARIO_ID',
        'grupoSchedule.usuarioId' => 'USUARIO_ID',
        'GrupoScheduleTableMap::COL_USUARIO_ID' => 'USUARIO_ID',
        'COL_USUARIO_ID' => 'USUARIO_ID',
        'usuario_id' => 'USUARIO_ID',
        'grupo_schedule.usuario_id' => 'USUARIO_ID',
        'GrupoId' => 'GRUPO_ID',
        'GrupoSchedule.GrupoId' => 'GRUPO_ID',
        'grupoId' => 'GRUPO_ID',
        'grupoSchedule.grupoId' => 'GRUPO_ID',
        'GrupoScheduleTableMap::COL_GRUPO_ID' => 'GRUPO_ID',
        'COL_GRUPO_ID' => 'GRUPO_ID',
        'grupo_id' => 'GRUPO_ID',
        'grupo_schedule.grupo_id' => 'GRUPO_ID',
        'Scheduled' => 'SCHEDULED',
        'GrupoSchedule.Scheduled' => 'SCHEDULED',
        'scheduled' => 'SCHEDULED',
        'grupoSchedule.scheduled' => 'SCHEDULED',
        'GrupoScheduleTableMap::COL_SCHEDULED' => 'SCHEDULED',
        'COL_SCHEDULED' => 'SCHEDULED',
        'grupo_schedule.scheduled' => 'SCHEDULED',
        'PushPop' => 'PUSH_POP',
        'GrupoSchedule.PushPop' => 'PUSH_POP',
        'pushPop' => 'PUSH_POP',
        'grupoSchedule.pushPop' => 'PUSH_POP',
        'GrupoScheduleTableMap::COL_PUSH_POP' => 'PUSH_POP',
        'COL_PUSH_POP' => 'PUSH_POP',
        'push_pop' => 'PUSH_POP',
        'grupo_schedule.push_pop' => 'PUSH_POP',
        'Enabled' => 'ENABLED',
        'GrupoSchedule.Enabled' => 'ENABLED',
        'enabled' => 'ENABLED',
        'grupoSchedule.enabled' => 'ENABLED',
        'GrupoScheduleTableMap::COL_ENABLED' => 'ENABLED',
        'COL_ENABLED' => 'ENABLED',
        'grupo_schedule.enabled' => 'ENABLED',
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
        $this->setName('grupo_schedule');
        $this->setPhpName('GrupoSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\GrupoSchedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('grupo_schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->addForeignKey('schedule_id', 'ScheduleId', 'INTEGER', 'schedule', 'id', true, null, null);
        $this->addForeignKey('usuario_id', 'UsuarioId', 'INTEGER', 'usuario', 'id', true, null, null);
        $this->addForeignKey('grupo_id', 'GrupoId', 'INTEGER', 'grupo', 'id', true, null, null);
        $this->addColumn('scheduled', 'Scheduled', 'VARCHAR', true, 50, null);
        $this->addColumn('push_pop', 'PushPop', 'VARCHAR', true, 1, null);
        $this->addColumn('enabled', 'Enabled', 'VARCHAR', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('Grupo', '\\Grupo', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':grupo_id',
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
        $this->addRelation('LogDeleteGrupoSchedule', '\\LogDeleteGrupoSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grupo_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogDeleteGrupoSchedules', false);
        $this->addRelation('LogEditeGrupoSchedule', '\\LogEditeGrupoSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grupo_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogEditeGrupoSchedules', false);
        $this->addRelation('LogGrupoExecution', '\\LogGrupoExecution', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':grupo_schedule_id',
    1 => ':id',
  ),
), null, null, 'LogGrupoExecutions', false);
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
        return $withPrefix ? GrupoScheduleTableMap::CLASS_DEFAULT : GrupoScheduleTableMap::OM_CLASS;
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
     * @return array           (GrupoSchedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = GrupoScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GrupoScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GrupoScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GrupoScheduleTableMap::OM_CLASS;
            /** @var GrupoSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GrupoScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = GrupoScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GrupoScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GrupoSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GrupoScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_USUARIO_ID);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_GRUPO_ID);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_SCHEDULED);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_PUSH_POP);
            $criteria->addSelectColumn(GrupoScheduleTableMap::COL_ENABLED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.schedule_id');
            $criteria->addSelectColumn($alias . '.usuario_id');
            $criteria->addSelectColumn($alias . '.grupo_id');
            $criteria->addSelectColumn($alias . '.scheduled');
            $criteria->addSelectColumn($alias . '.push_pop');
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
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_SCHEDULE_ID);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_USUARIO_ID);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_GRUPO_ID);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_SCHEDULED);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_PUSH_POP);
            $criteria->removeSelectColumn(GrupoScheduleTableMap::COL_ENABLED);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.schedule_id');
            $criteria->removeSelectColumn($alias . '.usuario_id');
            $criteria->removeSelectColumn($alias . '.grupo_id');
            $criteria->removeSelectColumn($alias . '.scheduled');
            $criteria->removeSelectColumn($alias . '.push_pop');
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
        return Propel::getServiceContainer()->getDatabaseMap(GrupoScheduleTableMap::DATABASE_NAME)->getTable(GrupoScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GrupoSchedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or GrupoSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \GrupoSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GrupoScheduleTableMap::DATABASE_NAME);
            $criteria->add(GrupoScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = GrupoScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GrupoScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GrupoScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the grupo_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return GrupoScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GrupoSchedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or GrupoSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GrupoSchedule object
        }

        if ($criteria->containsKey(GrupoScheduleTableMap::COL_ID) && $criteria->keyContainsValue(GrupoScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GrupoScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = GrupoScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // GrupoScheduleTableMap
