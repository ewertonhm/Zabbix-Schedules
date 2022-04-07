<?php

namespace Base;

use \GrupoSchedule as ChildGrupoSchedule;
use \GrupoScheduleQuery as ChildGrupoScheduleQuery;
use \HostSchedule as ChildHostSchedule;
use \HostScheduleQuery as ChildHostScheduleQuery;
use \MacroSchedule as ChildMacroSchedule;
use \MacroScheduleQuery as ChildMacroScheduleQuery;
use \Schedule as ChildSchedule;
use \ScheduleQuery as ChildScheduleQuery;
use \Exception;
use \PDO;
use Map\GrupoScheduleTableMap;
use Map\HostScheduleTableMap;
use Map\MacroScheduleTableMap;
use Map\ScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'schedule' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Schedule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ScheduleTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the original_value field.
     *
     * @var        string
     */
    protected $original_value;

    /**
     * The value for the new_value field.
     *
     * @var        string
     */
    protected $new_value;

    /**
     * The value for the date_from field.
     *
     * @var        string
     */
    protected $date_from;

    /**
     * The value for the date_until field.
     *
     * @var        string|null
     */
    protected $date_until;

    /**
     * The value for the executed field.
     *
     * @var        boolean|null
     */
    protected $executed;

    /**
     * The value for the reverted field.
     *
     * @var        boolean|null
     */
    protected $reverted;

    /**
     * @var        ObjectCollection|ChildGrupoSchedule[] Collection to store aggregation of ChildGrupoSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGrupoSchedule> Collection to store aggregation of ChildGrupoSchedule objects.
     */
    protected $collGrupoSchedules;
    protected $collGrupoSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildHostSchedule[] Collection to store aggregation of ChildHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHostSchedule> Collection to store aggregation of ChildHostSchedule objects.
     */
    protected $collHostSchedules;
    protected $collHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildMacroSchedule[] Collection to store aggregation of ChildMacroSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMacroSchedule> Collection to store aggregation of ChildMacroSchedule objects.
     */
    protected $collMacroSchedules;
    protected $collMacroSchedulesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGrupoSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGrupoSchedule>
     */
    protected $grupoSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHostSchedule>
     */
    protected $hostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMacroSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMacroSchedule>
     */
    protected $macroSchedulesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Schedule object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Schedule</code> instance.  If
     * <code>obj</code> is an instance of <code>Schedule</code>, delegates to
     * <code>equals(Schedule)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [original_value] column value.
     *
     * @return string
     */
    public function getOriginalValue()
    {
        return $this->original_value;
    }

    /**
     * Get the [new_value] column value.
     *
     * @return string
     */
    public function getNewValue()
    {
        return $this->new_value;
    }

    /**
     * Get the [date_from] column value.
     *
     * @return string
     */
    public function getDateFrom()
    {
        return $this->date_from;
    }

    /**
     * Get the [date_until] column value.
     *
     * @return string|null
     */
    public function getDateUntil()
    {
        return $this->date_until;
    }

    /**
     * Get the [executed] column value.
     *
     * @return boolean|null
     */
    public function getExecuted()
    {
        return $this->executed;
    }

    /**
     * Get the [executed] column value.
     *
     * @return boolean|null
     */
    public function isExecuted()
    {
        return $this->getExecuted();
    }

    /**
     * Get the [reverted] column value.
     *
     * @return boolean|null
     */
    public function getReverted()
    {
        return $this->reverted;
    }

    /**
     * Get the [reverted] column value.
     *
     * @return boolean|null
     */
    public function isReverted()
    {
        return $this->getReverted();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [original_value] column.
     *
     * @param string $v New value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setOriginalValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->original_value !== $v) {
            $this->original_value = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_ORIGINAL_VALUE] = true;
        }

        return $this;
    } // setOriginalValue()

    /**
     * Set the value of [new_value] column.
     *
     * @param string $v New value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setNewValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->new_value !== $v) {
            $this->new_value = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_NEW_VALUE] = true;
        }

        return $this;
    } // setNewValue()

    /**
     * Set the value of [date_from] column.
     *
     * @param string $v New value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setDateFrom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_from !== $v) {
            $this->date_from = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_DATE_FROM] = true;
        }

        return $this;
    } // setDateFrom()

    /**
     * Set the value of [date_until] column.
     *
     * @param string|null $v New value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setDateUntil($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_until !== $v) {
            $this->date_until = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_DATE_UNTIL] = true;
        }

        return $this;
    } // setDateUntil()

    /**
     * Sets the value of the [executed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string|null $v The new value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setExecuted($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->executed !== $v) {
            $this->executed = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_EXECUTED] = true;
        }

        return $this;
    } // setExecuted()

    /**
     * Sets the value of the [reverted] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string|null $v The new value
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function setReverted($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->reverted !== $v) {
            $this->reverted = $v;
            $this->modifiedColumns[ScheduleTableMap::COL_REVERTED] = true;
        }

        return $this;
    } // setReverted()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ScheduleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ScheduleTableMap::translateFieldName('OriginalValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->original_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ScheduleTableMap::translateFieldName('NewValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->new_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ScheduleTableMap::translateFieldName('DateFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_from = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ScheduleTableMap::translateFieldName('DateUntil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_until = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ScheduleTableMap::translateFieldName('Executed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->executed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ScheduleTableMap::translateFieldName('Reverted', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reverted = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ScheduleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Schedule'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ScheduleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildScheduleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGrupoSchedules = null;

            $this->collHostSchedules = null;

            $this->collMacroSchedules = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Schedule::setDeleted()
     * @see Schedule::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildScheduleQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScheduleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ScheduleTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->grupoSchedulesScheduledForDeletion !== null) {
                if (!$this->grupoSchedulesScheduledForDeletion->isEmpty()) {
                    \GrupoScheduleQuery::create()
                        ->filterByPrimaryKeys($this->grupoSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->grupoSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collGrupoSchedules !== null) {
                foreach ($this->collGrupoSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hostSchedulesScheduledForDeletion !== null) {
                if (!$this->hostSchedulesScheduledForDeletion->isEmpty()) {
                    \HostScheduleQuery::create()
                        ->filterByPrimaryKeys($this->hostSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->hostSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collHostSchedules !== null) {
                foreach ($this->collHostSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->macroSchedulesScheduledForDeletion !== null) {
                if (!$this->macroSchedulesScheduledForDeletion->isEmpty()) {
                    \MacroScheduleQuery::create()
                        ->filterByPrimaryKeys($this->macroSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->macroSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collMacroSchedules !== null) {
                foreach ($this->collMacroSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ScheduleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ScheduleTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('schedule_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ScheduleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_ORIGINAL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'original_value';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_NEW_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'new_value';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_DATE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'date_from';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_DATE_UNTIL)) {
            $modifiedColumns[':p' . $index++]  = 'date_until';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_EXECUTED)) {
            $modifiedColumns[':p' . $index++]  = 'executed';
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_REVERTED)) {
            $modifiedColumns[':p' . $index++]  = 'reverted';
        }

        $sql = sprintf(
            'INSERT INTO schedule (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'original_value':
                        $stmt->bindValue($identifier, $this->original_value, PDO::PARAM_STR);
                        break;
                    case 'new_value':
                        $stmt->bindValue($identifier, $this->new_value, PDO::PARAM_STR);
                        break;
                    case 'date_from':
                        $stmt->bindValue($identifier, $this->date_from, PDO::PARAM_STR);
                        break;
                    case 'date_until':
                        $stmt->bindValue($identifier, $this->date_until, PDO::PARAM_STR);
                        break;
                    case 'executed':
                        $stmt->bindValue($identifier, $this->executed, PDO::PARAM_BOOL);
                        break;
                    case 'reverted':
                        $stmt->bindValue($identifier, $this->reverted, PDO::PARAM_BOOL);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getOriginalValue();
                break;
            case 2:
                return $this->getNewValue();
                break;
            case 3:
                return $this->getDateFrom();
                break;
            case 4:
                return $this->getDateUntil();
                break;
            case 5:
                return $this->getExecuted();
                break;
            case 6:
                return $this->getReverted();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Schedule'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Schedule'][$this->hashCode()] = true;
        $keys = ScheduleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getOriginalValue(),
            $keys[2] => $this->getNewValue(),
            $keys[3] => $this->getDateFrom(),
            $keys[4] => $this->getDateUntil(),
            $keys[5] => $this->getExecuted(),
            $keys[6] => $this->getReverted(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collGrupoSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'grupoSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'grupo_schedules';
                        break;
                    default:
                        $key = 'GrupoSchedules';
                }

                $result[$key] = $this->collGrupoSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHostSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hostSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'host_schedules';
                        break;
                    default:
                        $key = 'HostSchedules';
                }

                $result[$key] = $this->collHostSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMacroSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'macroSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'macro_schedules';
                        break;
                    default:
                        $key = 'MacroSchedules';
                }

                $result[$key] = $this->collMacroSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Schedule
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Schedule
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setOriginalValue($value);
                break;
            case 2:
                $this->setNewValue($value);
                break;
            case 3:
                $this->setDateFrom($value);
                break;
            case 4:
                $this->setDateUntil($value);
                break;
            case 5:
                $this->setExecuted($value);
                break;
            case 6:
                $this->setReverted($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\Schedule
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ScheduleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOriginalValue($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNewValue($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDateFrom($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDateUntil($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setExecuted($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setReverted($arr[$keys[6]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Schedule The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ScheduleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ScheduleTableMap::COL_ID)) {
            $criteria->add(ScheduleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_ORIGINAL_VALUE)) {
            $criteria->add(ScheduleTableMap::COL_ORIGINAL_VALUE, $this->original_value);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_NEW_VALUE)) {
            $criteria->add(ScheduleTableMap::COL_NEW_VALUE, $this->new_value);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_DATE_FROM)) {
            $criteria->add(ScheduleTableMap::COL_DATE_FROM, $this->date_from);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_DATE_UNTIL)) {
            $criteria->add(ScheduleTableMap::COL_DATE_UNTIL, $this->date_until);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_EXECUTED)) {
            $criteria->add(ScheduleTableMap::COL_EXECUTED, $this->executed);
        }
        if ($this->isColumnModified(ScheduleTableMap::COL_REVERTED)) {
            $criteria->add(ScheduleTableMap::COL_REVERTED, $this->reverted);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildScheduleQuery::create();
        $criteria->add(ScheduleTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Schedule (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOriginalValue($this->getOriginalValue());
        $copyObj->setNewValue($this->getNewValue());
        $copyObj->setDateFrom($this->getDateFrom());
        $copyObj->setDateUntil($this->getDateUntil());
        $copyObj->setExecuted($this->getExecuted());
        $copyObj->setReverted($this->getReverted());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getGrupoSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGrupoSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMacroSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMacroSchedule($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Schedule Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('GrupoSchedule' === $relationName) {
            $this->initGrupoSchedules();
            return;
        }
        if ('HostSchedule' === $relationName) {
            $this->initHostSchedules();
            return;
        }
        if ('MacroSchedule' === $relationName) {
            $this->initMacroSchedules();
            return;
        }
    }

    /**
     * Clears out the collGrupoSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGrupoSchedules()
     */
    public function clearGrupoSchedules()
    {
        $this->collGrupoSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGrupoSchedules collection loaded partially.
     */
    public function resetPartialGrupoSchedules($v = true)
    {
        $this->collGrupoSchedulesPartial = $v;
    }

    /**
     * Initializes the collGrupoSchedules collection.
     *
     * By default this just sets the collGrupoSchedules collection to an empty array (like clearcollGrupoSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGrupoSchedules($overrideExisting = true)
    {
        if (null !== $this->collGrupoSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = GrupoScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collGrupoSchedules = new $collectionClassName;
        $this->collGrupoSchedules->setModel('\GrupoSchedule');
    }

    /**
     * Gets an array of ChildGrupoSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGrupoSchedule[] List of ChildGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGrupoSchedule> List of ChildGrupoSchedule objects
     * @throws PropelException
     */
    public function getGrupoSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGrupoSchedules) {
                    $this->initGrupoSchedules();
                } else {
                    $collectionClassName = GrupoScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collGrupoSchedules = new $collectionClassName;
                    $collGrupoSchedules->setModel('\GrupoSchedule');

                    return $collGrupoSchedules;
                }
            } else {
                $collGrupoSchedules = ChildGrupoScheduleQuery::create(null, $criteria)
                    ->filterBySchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGrupoSchedulesPartial && count($collGrupoSchedules)) {
                        $this->initGrupoSchedules(false);

                        foreach ($collGrupoSchedules as $obj) {
                            if (false == $this->collGrupoSchedules->contains($obj)) {
                                $this->collGrupoSchedules->append($obj);
                            }
                        }

                        $this->collGrupoSchedulesPartial = true;
                    }

                    return $collGrupoSchedules;
                }

                if ($partial && $this->collGrupoSchedules) {
                    foreach ($this->collGrupoSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collGrupoSchedules[] = $obj;
                        }
                    }
                }

                $this->collGrupoSchedules = $collGrupoSchedules;
                $this->collGrupoSchedulesPartial = false;
            }
        }

        return $this->collGrupoSchedules;
    }

    /**
     * Sets a collection of ChildGrupoSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $grupoSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function setGrupoSchedules(Collection $grupoSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildGrupoSchedule[] $grupoSchedulesToDelete */
        $grupoSchedulesToDelete = $this->getGrupoSchedules(new Criteria(), $con)->diff($grupoSchedules);


        $this->grupoSchedulesScheduledForDeletion = $grupoSchedulesToDelete;

        foreach ($grupoSchedulesToDelete as $grupoScheduleRemoved) {
            $grupoScheduleRemoved->setSchedule(null);
        }

        $this->collGrupoSchedules = null;
        foreach ($grupoSchedules as $grupoSchedule) {
            $this->addGrupoSchedule($grupoSchedule);
        }

        $this->collGrupoSchedules = $grupoSchedules;
        $this->collGrupoSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GrupoSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related GrupoSchedule objects.
     * @throws PropelException
     */
    public function countGrupoSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGrupoSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGrupoSchedules());
            }

            $query = ChildGrupoScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySchedule($this)
                ->count($con);
        }

        return count($this->collGrupoSchedules);
    }

    /**
     * Method called to associate a ChildGrupoSchedule object to this object
     * through the ChildGrupoSchedule foreign key attribute.
     *
     * @param  ChildGrupoSchedule $l ChildGrupoSchedule
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function addGrupoSchedule(ChildGrupoSchedule $l)
    {
        if ($this->collGrupoSchedules === null) {
            $this->initGrupoSchedules();
            $this->collGrupoSchedulesPartial = true;
        }

        if (!$this->collGrupoSchedules->contains($l)) {
            $this->doAddGrupoSchedule($l);

            if ($this->grupoSchedulesScheduledForDeletion and $this->grupoSchedulesScheduledForDeletion->contains($l)) {
                $this->grupoSchedulesScheduledForDeletion->remove($this->grupoSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGrupoSchedule $grupoSchedule The ChildGrupoSchedule object to add.
     */
    protected function doAddGrupoSchedule(ChildGrupoSchedule $grupoSchedule)
    {
        $this->collGrupoSchedules[]= $grupoSchedule;
        $grupoSchedule->setSchedule($this);
    }

    /**
     * @param  ChildGrupoSchedule $grupoSchedule The ChildGrupoSchedule object to remove.
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function removeGrupoSchedule(ChildGrupoSchedule $grupoSchedule)
    {
        if ($this->getGrupoSchedules()->contains($grupoSchedule)) {
            $pos = $this->collGrupoSchedules->search($grupoSchedule);
            $this->collGrupoSchedules->remove($pos);
            if (null === $this->grupoSchedulesScheduledForDeletion) {
                $this->grupoSchedulesScheduledForDeletion = clone $this->collGrupoSchedules;
                $this->grupoSchedulesScheduledForDeletion->clear();
            }
            $this->grupoSchedulesScheduledForDeletion[]= clone $grupoSchedule;
            $grupoSchedule->setSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related GrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGrupoSchedule[] List of ChildGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGrupoSchedule}> List of ChildGrupoSchedule objects
     */
    public function getGrupoSchedulesJoinGrupo(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('Grupo', $joinBehavior);

        return $this->getGrupoSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related GrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGrupoSchedule[] List of ChildGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGrupoSchedule}> List of ChildGrupoSchedule objects
     */
    public function getGrupoSchedulesJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getGrupoSchedules($query, $con);
    }

    /**
     * Clears out the collHostSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHostSchedules()
     */
    public function clearHostSchedules()
    {
        $this->collHostSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHostSchedules collection loaded partially.
     */
    public function resetPartialHostSchedules($v = true)
    {
        $this->collHostSchedulesPartial = $v;
    }

    /**
     * Initializes the collHostSchedules collection.
     *
     * By default this just sets the collHostSchedules collection to an empty array (like clearcollHostSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHostSchedules($overrideExisting = true)
    {
        if (null !== $this->collHostSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = HostScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collHostSchedules = new $collectionClassName;
        $this->collHostSchedules->setModel('\HostSchedule');
    }

    /**
     * Gets an array of ChildHostSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHostSchedule[] List of ChildHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHostSchedule> List of ChildHostSchedule objects
     * @throws PropelException
     */
    public function getHostSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHostSchedulesPartial && !$this->isNew();
        if (null === $this->collHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHostSchedules) {
                    $this->initHostSchedules();
                } else {
                    $collectionClassName = HostScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collHostSchedules = new $collectionClassName;
                    $collHostSchedules->setModel('\HostSchedule');

                    return $collHostSchedules;
                }
            } else {
                $collHostSchedules = ChildHostScheduleQuery::create(null, $criteria)
                    ->filterBySchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHostSchedulesPartial && count($collHostSchedules)) {
                        $this->initHostSchedules(false);

                        foreach ($collHostSchedules as $obj) {
                            if (false == $this->collHostSchedules->contains($obj)) {
                                $this->collHostSchedules->append($obj);
                            }
                        }

                        $this->collHostSchedulesPartial = true;
                    }

                    return $collHostSchedules;
                }

                if ($partial && $this->collHostSchedules) {
                    foreach ($this->collHostSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collHostSchedules[] = $obj;
                        }
                    }
                }

                $this->collHostSchedules = $collHostSchedules;
                $this->collHostSchedulesPartial = false;
            }
        }

        return $this->collHostSchedules;
    }

    /**
     * Sets a collection of ChildHostSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $hostSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function setHostSchedules(Collection $hostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildHostSchedule[] $hostSchedulesToDelete */
        $hostSchedulesToDelete = $this->getHostSchedules(new Criteria(), $con)->diff($hostSchedules);


        $this->hostSchedulesScheduledForDeletion = $hostSchedulesToDelete;

        foreach ($hostSchedulesToDelete as $hostScheduleRemoved) {
            $hostScheduleRemoved->setSchedule(null);
        }

        $this->collHostSchedules = null;
        foreach ($hostSchedules as $hostSchedule) {
            $this->addHostSchedule($hostSchedule);
        }

        $this->collHostSchedules = $hostSchedules;
        $this->collHostSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HostSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related HostSchedule objects.
     * @throws PropelException
     */
    public function countHostSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHostSchedulesPartial && !$this->isNew();
        if (null === $this->collHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHostSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHostSchedules());
            }

            $query = ChildHostScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySchedule($this)
                ->count($con);
        }

        return count($this->collHostSchedules);
    }

    /**
     * Method called to associate a ChildHostSchedule object to this object
     * through the ChildHostSchedule foreign key attribute.
     *
     * @param  ChildHostSchedule $l ChildHostSchedule
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function addHostSchedule(ChildHostSchedule $l)
    {
        if ($this->collHostSchedules === null) {
            $this->initHostSchedules();
            $this->collHostSchedulesPartial = true;
        }

        if (!$this->collHostSchedules->contains($l)) {
            $this->doAddHostSchedule($l);

            if ($this->hostSchedulesScheduledForDeletion and $this->hostSchedulesScheduledForDeletion->contains($l)) {
                $this->hostSchedulesScheduledForDeletion->remove($this->hostSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHostSchedule $hostSchedule The ChildHostSchedule object to add.
     */
    protected function doAddHostSchedule(ChildHostSchedule $hostSchedule)
    {
        $this->collHostSchedules[]= $hostSchedule;
        $hostSchedule->setSchedule($this);
    }

    /**
     * @param  ChildHostSchedule $hostSchedule The ChildHostSchedule object to remove.
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function removeHostSchedule(ChildHostSchedule $hostSchedule)
    {
        if ($this->getHostSchedules()->contains($hostSchedule)) {
            $pos = $this->collHostSchedules->search($hostSchedule);
            $this->collHostSchedules->remove($pos);
            if (null === $this->hostSchedulesScheduledForDeletion) {
                $this->hostSchedulesScheduledForDeletion = clone $this->collHostSchedules;
                $this->hostSchedulesScheduledForDeletion->clear();
            }
            $this->hostSchedulesScheduledForDeletion[]= clone $hostSchedule;
            $hostSchedule->setSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related HostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHostSchedule[] List of ChildHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHostSchedule}> List of ChildHostSchedule objects
     */
    public function getHostSchedulesJoinHost(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Host', $joinBehavior);

        return $this->getHostSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related HostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHostSchedule[] List of ChildHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHostSchedule}> List of ChildHostSchedule objects
     */
    public function getHostSchedulesJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getHostSchedules($query, $con);
    }

    /**
     * Clears out the collMacroSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMacroSchedules()
     */
    public function clearMacroSchedules()
    {
        $this->collMacroSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMacroSchedules collection loaded partially.
     */
    public function resetPartialMacroSchedules($v = true)
    {
        $this->collMacroSchedulesPartial = $v;
    }

    /**
     * Initializes the collMacroSchedules collection.
     *
     * By default this just sets the collMacroSchedules collection to an empty array (like clearcollMacroSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMacroSchedules($overrideExisting = true)
    {
        if (null !== $this->collMacroSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = MacroScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collMacroSchedules = new $collectionClassName;
        $this->collMacroSchedules->setModel('\MacroSchedule');
    }

    /**
     * Gets an array of ChildMacroSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMacroSchedule[] List of ChildMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMacroSchedule> List of ChildMacroSchedule objects
     * @throws PropelException
     */
    public function getMacroSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMacroSchedules) {
                    $this->initMacroSchedules();
                } else {
                    $collectionClassName = MacroScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collMacroSchedules = new $collectionClassName;
                    $collMacroSchedules->setModel('\MacroSchedule');

                    return $collMacroSchedules;
                }
            } else {
                $collMacroSchedules = ChildMacroScheduleQuery::create(null, $criteria)
                    ->filterBySchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMacroSchedulesPartial && count($collMacroSchedules)) {
                        $this->initMacroSchedules(false);

                        foreach ($collMacroSchedules as $obj) {
                            if (false == $this->collMacroSchedules->contains($obj)) {
                                $this->collMacroSchedules->append($obj);
                            }
                        }

                        $this->collMacroSchedulesPartial = true;
                    }

                    return $collMacroSchedules;
                }

                if ($partial && $this->collMacroSchedules) {
                    foreach ($this->collMacroSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collMacroSchedules[] = $obj;
                        }
                    }
                }

                $this->collMacroSchedules = $collMacroSchedules;
                $this->collMacroSchedulesPartial = false;
            }
        }

        return $this->collMacroSchedules;
    }

    /**
     * Sets a collection of ChildMacroSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $macroSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function setMacroSchedules(Collection $macroSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildMacroSchedule[] $macroSchedulesToDelete */
        $macroSchedulesToDelete = $this->getMacroSchedules(new Criteria(), $con)->diff($macroSchedules);


        $this->macroSchedulesScheduledForDeletion = $macroSchedulesToDelete;

        foreach ($macroSchedulesToDelete as $macroScheduleRemoved) {
            $macroScheduleRemoved->setSchedule(null);
        }

        $this->collMacroSchedules = null;
        foreach ($macroSchedules as $macroSchedule) {
            $this->addMacroSchedule($macroSchedule);
        }

        $this->collMacroSchedules = $macroSchedules;
        $this->collMacroSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MacroSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related MacroSchedule objects.
     * @throws PropelException
     */
    public function countMacroSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMacroSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMacroSchedules());
            }

            $query = ChildMacroScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySchedule($this)
                ->count($con);
        }

        return count($this->collMacroSchedules);
    }

    /**
     * Method called to associate a ChildMacroSchedule object to this object
     * through the ChildMacroSchedule foreign key attribute.
     *
     * @param  ChildMacroSchedule $l ChildMacroSchedule
     * @return $this|\Schedule The current object (for fluent API support)
     */
    public function addMacroSchedule(ChildMacroSchedule $l)
    {
        if ($this->collMacroSchedules === null) {
            $this->initMacroSchedules();
            $this->collMacroSchedulesPartial = true;
        }

        if (!$this->collMacroSchedules->contains($l)) {
            $this->doAddMacroSchedule($l);

            if ($this->macroSchedulesScheduledForDeletion and $this->macroSchedulesScheduledForDeletion->contains($l)) {
                $this->macroSchedulesScheduledForDeletion->remove($this->macroSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMacroSchedule $macroSchedule The ChildMacroSchedule object to add.
     */
    protected function doAddMacroSchedule(ChildMacroSchedule $macroSchedule)
    {
        $this->collMacroSchedules[]= $macroSchedule;
        $macroSchedule->setSchedule($this);
    }

    /**
     * @param  ChildMacroSchedule $macroSchedule The ChildMacroSchedule object to remove.
     * @return $this|ChildSchedule The current object (for fluent API support)
     */
    public function removeMacroSchedule(ChildMacroSchedule $macroSchedule)
    {
        if ($this->getMacroSchedules()->contains($macroSchedule)) {
            $pos = $this->collMacroSchedules->search($macroSchedule);
            $this->collMacroSchedules->remove($pos);
            if (null === $this->macroSchedulesScheduledForDeletion) {
                $this->macroSchedulesScheduledForDeletion = clone $this->collMacroSchedules;
                $this->macroSchedulesScheduledForDeletion->clear();
            }
            $this->macroSchedulesScheduledForDeletion[]= clone $macroSchedule;
            $macroSchedule->setSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMacroSchedule[] List of ChildMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMacroSchedule}> List of ChildMacroSchedule objects
     */
    public function getMacroSchedulesJoinHost(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('Host', $joinBehavior);

        return $this->getMacroSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMacroSchedule[] List of ChildMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMacroSchedule}> List of ChildMacroSchedule objects
     */
    public function getMacroSchedulesJoinMacro(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('Macro', $joinBehavior);

        return $this->getMacroSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Schedule is new, it will return
     * an empty collection; or if this Schedule has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Schedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMacroSchedule[] List of ChildMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMacroSchedule}> List of ChildMacroSchedule objects
     */
    public function getMacroSchedulesJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getMacroSchedules($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->original_value = null;
        $this->new_value = null;
        $this->date_from = null;
        $this->date_until = null;
        $this->executed = null;
        $this->reverted = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collGrupoSchedules) {
                foreach ($this->collGrupoSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHostSchedules) {
                foreach ($this->collHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMacroSchedules) {
                foreach ($this->collMacroSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collGrupoSchedules = null;
        $this->collHostSchedules = null;
        $this->collMacroSchedules = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ScheduleTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
