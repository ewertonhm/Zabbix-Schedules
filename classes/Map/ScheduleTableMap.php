<?php

namespace Map;

use \Schedule;
use \ScheduleQuery;
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
 * This class defines the structure of the 'schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ScheduleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'schedule';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Schedule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Schedule';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'schedule.id';

    /**
     * the column name for the original_value field
     */
    const COL_ORIGINAL_VALUE = 'schedule.original_value';

    /**
     * the column name for the new_value field
     */
    const COL_NEW_VALUE = 'schedule.new_value';

    /**
     * the column name for the date_from field
     */
    const COL_DATE_FROM = 'schedule.date_from';

    /**
     * the column name for the date_until field
     */
    const COL_DATE_UNTIL = 'schedule.date_until';

    /**
     * the column name for the executed field
     */
    const COL_EXECUTED = 'schedule.executed';

    /**
     * the column name for the reverted field
     */
    const COL_REVERTED = 'schedule.reverted';

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
        self::TYPE_PHPNAME       => array('Id', 'OriginalValue', 'NewValue', 'DateFrom', 'DateUntil', 'Executed', 'Reverted', ),
        self::TYPE_CAMELNAME     => array('id', 'originalValue', 'newValue', 'dateFrom', 'dateUntil', 'executed', 'reverted', ),
        self::TYPE_COLNAME       => array(ScheduleTableMap::COL_ID, ScheduleTableMap::COL_ORIGINAL_VALUE, ScheduleTableMap::COL_NEW_VALUE, ScheduleTableMap::COL_DATE_FROM, ScheduleTableMap::COL_DATE_UNTIL, ScheduleTableMap::COL_EXECUTED, ScheduleTableMap::COL_REVERTED, ),
        self::TYPE_FIELDNAME     => array('id', 'original_value', 'new_value', 'date_from', 'date_until', 'executed', 'reverted', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'OriginalValue' => 1, 'NewValue' => 2, 'DateFrom' => 3, 'DateUntil' => 4, 'Executed' => 5, 'Reverted' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'originalValue' => 1, 'newValue' => 2, 'dateFrom' => 3, 'dateUntil' => 4, 'executed' => 5, 'reverted' => 6, ),
        self::TYPE_COLNAME       => array(ScheduleTableMap::COL_ID => 0, ScheduleTableMap::COL_ORIGINAL_VALUE => 1, ScheduleTableMap::COL_NEW_VALUE => 2, ScheduleTableMap::COL_DATE_FROM => 3, ScheduleTableMap::COL_DATE_UNTIL => 4, ScheduleTableMap::COL_EXECUTED => 5, ScheduleTableMap::COL_REVERTED => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'original_value' => 1, 'new_value' => 2, 'date_from' => 3, 'date_until' => 4, 'executed' => 5, 'reverted' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Schedule.Id' => 'ID',
        'id' => 'ID',
        'schedule.id' => 'ID',
        'ScheduleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'OriginalValue' => 'ORIGINAL_VALUE',
        'Schedule.OriginalValue' => 'ORIGINAL_VALUE',
        'originalValue' => 'ORIGINAL_VALUE',
        'schedule.originalValue' => 'ORIGINAL_VALUE',
        'ScheduleTableMap::COL_ORIGINAL_VALUE' => 'ORIGINAL_VALUE',
        'COL_ORIGINAL_VALUE' => 'ORIGINAL_VALUE',
        'original_value' => 'ORIGINAL_VALUE',
        'schedule.original_value' => 'ORIGINAL_VALUE',
        'NewValue' => 'NEW_VALUE',
        'Schedule.NewValue' => 'NEW_VALUE',
        'newValue' => 'NEW_VALUE',
        'schedule.newValue' => 'NEW_VALUE',
        'ScheduleTableMap::COL_NEW_VALUE' => 'NEW_VALUE',
        'COL_NEW_VALUE' => 'NEW_VALUE',
        'new_value' => 'NEW_VALUE',
        'schedule.new_value' => 'NEW_VALUE',
        'DateFrom' => 'DATE_FROM',
        'Schedule.DateFrom' => 'DATE_FROM',
        'dateFrom' => 'DATE_FROM',
        'schedule.dateFrom' => 'DATE_FROM',
        'ScheduleTableMap::COL_DATE_FROM' => 'DATE_FROM',
        'COL_DATE_FROM' => 'DATE_FROM',
        'date_from' => 'DATE_FROM',
        'schedule.date_from' => 'DATE_FROM',
        'DateUntil' => 'DATE_UNTIL',
        'Schedule.DateUntil' => 'DATE_UNTIL',
        'dateUntil' => 'DATE_UNTIL',
        'schedule.dateUntil' => 'DATE_UNTIL',
        'ScheduleTableMap::COL_DATE_UNTIL' => 'DATE_UNTIL',
        'COL_DATE_UNTIL' => 'DATE_UNTIL',
        'date_until' => 'DATE_UNTIL',
        'schedule.date_until' => 'DATE_UNTIL',
        'Executed' => 'EXECUTED',
        'Schedule.Executed' => 'EXECUTED',
        'executed' => 'EXECUTED',
        'schedule.executed' => 'EXECUTED',
        'ScheduleTableMap::COL_EXECUTED' => 'EXECUTED',
        'COL_EXECUTED' => 'EXECUTED',
        'Reverted' => 'REVERTED',
        'Schedule.Reverted' => 'REVERTED',
        'reverted' => 'REVERTED',
        'schedule.reverted' => 'REVERTED',
        'ScheduleTableMap::COL_REVERTED' => 'REVERTED',
        'COL_REVERTED' => 'REVERTED',
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
        $this->setName('schedule');
        $this->setPhpName('Schedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Schedule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('schedule_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('original_value', 'OriginalValue', 'VARCHAR', true, 50, null);
        $this->addColumn('new_value', 'NewValue', 'VARCHAR', true, 50, null);
        $this->addColumn('date_from', 'DateFrom', 'VARCHAR', true, 50, null);
        $this->addColumn('date_until', 'DateUntil', 'VARCHAR', false, 50, null);
        $this->addColumn('executed', 'Executed', 'BOOLEAN', false, 1, null);
        $this->addColumn('reverted', 'Reverted', 'BOOLEAN', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations()
    {
        $this->addRelation('GrupoSchedule', '\\GrupoSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':schedule_id',
    1 => ':id',
  ),
), null, null, 'GrupoSchedules', false);
        $this->addRelation('HostSchedule', '\\HostSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':schedule_id',
    1 => ':id',
  ),
), null, null, 'HostSchedules', false);
        $this->addRelation('MacroSchedule', '\\MacroSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':schedule_id',
    1 => ':id',
  ),
), null, null, 'MacroSchedules', false);
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
        return $withPrefix ? ScheduleTableMap::CLASS_DEFAULT : ScheduleTableMap::OM_CLASS;
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
     * @return array           (Schedule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ScheduleTableMap::OM_CLASS;
            /** @var Schedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = ScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Schedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ScheduleTableMap::COL_ID);
            $criteria->addSelectColumn(ScheduleTableMap::COL_ORIGINAL_VALUE);
            $criteria->addSelectColumn(ScheduleTableMap::COL_NEW_VALUE);
            $criteria->addSelectColumn(ScheduleTableMap::COL_DATE_FROM);
            $criteria->addSelectColumn(ScheduleTableMap::COL_DATE_UNTIL);
            $criteria->addSelectColumn(ScheduleTableMap::COL_EXECUTED);
            $criteria->addSelectColumn(ScheduleTableMap::COL_REVERTED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.original_value');
            $criteria->addSelectColumn($alias . '.new_value');
            $criteria->addSelectColumn($alias . '.date_from');
            $criteria->addSelectColumn($alias . '.date_until');
            $criteria->addSelectColumn($alias . '.executed');
            $criteria->addSelectColumn($alias . '.reverted');
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
            $criteria->removeSelectColumn(ScheduleTableMap::COL_ID);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_ORIGINAL_VALUE);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_NEW_VALUE);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_DATE_FROM);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_DATE_UNTIL);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_EXECUTED);
            $criteria->removeSelectColumn(ScheduleTableMap::COL_REVERTED);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.original_value');
            $criteria->removeSelectColumn($alias . '.new_value');
            $criteria->removeSelectColumn($alias . '.date_from');
            $criteria->removeSelectColumn($alias . '.date_until');
            $criteria->removeSelectColumn($alias . '.executed');
            $criteria->removeSelectColumn($alias . '.reverted');
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
        return Propel::getServiceContainer()->getDatabaseMap(ScheduleTableMap::DATABASE_NAME)->getTable(ScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Schedule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Schedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Schedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ScheduleTableMap::DATABASE_NAME);
            $criteria->add(ScheduleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Schedule or Criteria object.
     *
     * @param mixed               $criteria Criteria or Schedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Schedule object
        }

        if ($criteria->containsKey(ScheduleTableMap::COL_ID) && $criteria->keyContainsValue(ScheduleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ScheduleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ScheduleTableMap
