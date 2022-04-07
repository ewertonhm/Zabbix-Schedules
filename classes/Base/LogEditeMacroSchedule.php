<?php

namespace Base;

use \Log as ChildLog;
use \LogEditeMacroScheduleQuery as ChildLogEditeMacroScheduleQuery;
use \LogQuery as ChildLogQuery;
use \MacroSchedule as ChildMacroSchedule;
use \MacroScheduleQuery as ChildMacroScheduleQuery;
use \Exception;
use \PDO;
use Map\LogEditeMacroScheduleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'log_edite_macro_schedule' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class LogEditeMacroSchedule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\LogEditeMacroScheduleTableMap';


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
     * The value for the macro_schedule_id field.
     *
     * @var        int
     */
    protected $macro_schedule_id;

    /**
     * The value for the log_id field.
     *
     * @var        int
     */
    protected $log_id;

    /**
     * The value for the old_date_from field.
     *
     * @var        string
     */
    protected $old_date_from;

    /**
     * The value for the new_date_from field.
     *
     * @var        string
     */
    protected $new_date_from;

    /**
     * The value for the old_date_until field.
     *
     * @var        string
     */
    protected $old_date_until;

    /**
     * The value for the new_date_until field.
     *
     * @var        string
     */
    protected $new_date_until;

    /**
     * The value for the old_original_value field.
     *
     * @var        string
     */
    protected $old_original_value;

    /**
     * The value for the new_original_value field.
     *
     * @var        string
     */
    protected $new_original_value;

    /**
     * The value for the old_new_value field.
     *
     * @var        string
     */
    protected $old_new_value;

    /**
     * The value for the new_new_value field.
     *
     * @var        string
     */
    protected $new_new_value;

    /**
     * @var        ChildLog
     */
    protected $aLog;

    /**
     * @var        ChildMacroSchedule
     */
    protected $aMacroSchedule;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\LogEditeMacroSchedule object.
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
     * Compares this with another <code>LogEditeMacroSchedule</code> instance.  If
     * <code>obj</code> is an instance of <code>LogEditeMacroSchedule</code>, delegates to
     * <code>equals(LogEditeMacroSchedule)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [macro_schedule_id] column value.
     *
     * @return int
     */
    public function getMacroScheduleId()
    {
        return $this->macro_schedule_id;
    }

    /**
     * Get the [log_id] column value.
     *
     * @return int
     */
    public function getLogId()
    {
        return $this->log_id;
    }

    /**
     * Get the [old_date_from] column value.
     *
     * @return string
     */
    public function getOldDateFrom()
    {
        return $this->old_date_from;
    }

    /**
     * Get the [new_date_from] column value.
     *
     * @return string
     */
    public function getNewDateFrom()
    {
        return $this->new_date_from;
    }

    /**
     * Get the [old_date_until] column value.
     *
     * @return string
     */
    public function getOldDateUntil()
    {
        return $this->old_date_until;
    }

    /**
     * Get the [new_date_until] column value.
     *
     * @return string
     */
    public function getNewDateUntil()
    {
        return $this->new_date_until;
    }

    /**
     * Get the [old_original_value] column value.
     *
     * @return string
     */
    public function getOldOriginalValue()
    {
        return $this->old_original_value;
    }

    /**
     * Get the [new_original_value] column value.
     *
     * @return string
     */
    public function getNewOriginalValue()
    {
        return $this->new_original_value;
    }

    /**
     * Get the [old_new_value] column value.
     *
     * @return string
     */
    public function getOldNewValue()
    {
        return $this->old_new_value;
    }

    /**
     * Get the [new_new_value] column value.
     *
     * @return string
     */
    public function getNewNewValue()
    {
        return $this->new_new_value;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [macro_schedule_id] column.
     *
     * @param int $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setMacroScheduleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->macro_schedule_id !== $v) {
            $this->macro_schedule_id = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID] = true;
        }

        if ($this->aMacroSchedule !== null && $this->aMacroSchedule->getId() !== $v) {
            $this->aMacroSchedule = null;
        }

        return $this;
    } // setMacroScheduleId()

    /**
     * Set the value of [log_id] column.
     *
     * @param int $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setLogId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->log_id !== $v) {
            $this->log_id = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_LOG_ID] = true;
        }

        if ($this->aLog !== null && $this->aLog->getId() !== $v) {
            $this->aLog = null;
        }

        return $this;
    } // setLogId()

    /**
     * Set the value of [old_date_from] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setOldDateFrom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->old_date_from !== $v) {
            $this->old_date_from = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM] = true;
        }

        return $this;
    } // setOldDateFrom()

    /**
     * Set the value of [new_date_from] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setNewDateFrom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->new_date_from !== $v) {
            $this->new_date_from = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM] = true;
        }

        return $this;
    } // setNewDateFrom()

    /**
     * Set the value of [old_date_until] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setOldDateUntil($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->old_date_until !== $v) {
            $this->old_date_until = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL] = true;
        }

        return $this;
    } // setOldDateUntil()

    /**
     * Set the value of [new_date_until] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setNewDateUntil($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->new_date_until !== $v) {
            $this->new_date_until = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL] = true;
        }

        return $this;
    } // setNewDateUntil()

    /**
     * Set the value of [old_original_value] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setOldOriginalValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->old_original_value !== $v) {
            $this->old_original_value = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE] = true;
        }

        return $this;
    } // setOldOriginalValue()

    /**
     * Set the value of [new_original_value] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setNewOriginalValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->new_original_value !== $v) {
            $this->new_original_value = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE] = true;
        }

        return $this;
    } // setNewOriginalValue()

    /**
     * Set the value of [old_new_value] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setOldNewValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->old_new_value !== $v) {
            $this->old_new_value = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE] = true;
        }

        return $this;
    } // setOldNewValue()

    /**
     * Set the value of [new_new_value] column.
     *
     * @param string $v New value
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     */
    public function setNewNewValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->new_new_value !== $v) {
            $this->new_new_value = $v;
            $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE] = true;
        }

        return $this;
    } // setNewNewValue()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('MacroScheduleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->macro_schedule_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->log_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('OldDateFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->old_date_from = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('NewDateFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->new_date_from = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('OldDateUntil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->old_date_until = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('NewDateUntil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->new_date_until = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('OldOriginalValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->old_original_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('NewOriginalValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->new_original_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('OldNewValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->old_new_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : LogEditeMacroScheduleTableMap::translateFieldName('NewNewValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->new_new_value = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = LogEditeMacroScheduleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\LogEditeMacroSchedule'), 0, $e);
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
        if ($this->aMacroSchedule !== null && $this->macro_schedule_id !== $this->aMacroSchedule->getId()) {
            $this->aMacroSchedule = null;
        }
        if ($this->aLog !== null && $this->log_id !== $this->aLog->getId()) {
            $this->aLog = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLogEditeMacroScheduleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLog = null;
            $this->aMacroSchedule = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see LogEditeMacroSchedule::setDeleted()
     * @see LogEditeMacroSchedule::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLogEditeMacroScheduleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogEditeMacroScheduleTableMap::DATABASE_NAME);
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
                LogEditeMacroScheduleTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLog !== null) {
                if ($this->aLog->isModified() || $this->aLog->isNew()) {
                    $affectedRows += $this->aLog->save($con);
                }
                $this->setLog($this->aLog);
            }

            if ($this->aMacroSchedule !== null) {
                if ($this->aMacroSchedule->isModified() || $this->aMacroSchedule->isNew()) {
                    $affectedRows += $this->aMacroSchedule->save($con);
                }
                $this->setMacroSchedule($this->aMacroSchedule);
            }

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

        $this->modifiedColumns[LogEditeMacroScheduleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LogEditeMacroScheduleTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('log_edite_macro_schedule_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'macro_schedule_id';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_LOG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'log_id';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'old_date_from';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'new_date_from';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL)) {
            $modifiedColumns[':p' . $index++]  = 'old_date_until';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL)) {
            $modifiedColumns[':p' . $index++]  = 'new_date_until';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'old_original_value';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'new_original_value';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'old_new_value';
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'new_new_value';
        }

        $sql = sprintf(
            'INSERT INTO log_edite_macro_schedule (%s) VALUES (%s)',
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
                    case 'macro_schedule_id':
                        $stmt->bindValue($identifier, $this->macro_schedule_id, PDO::PARAM_INT);
                        break;
                    case 'log_id':
                        $stmt->bindValue($identifier, $this->log_id, PDO::PARAM_INT);
                        break;
                    case 'old_date_from':
                        $stmt->bindValue($identifier, $this->old_date_from, PDO::PARAM_STR);
                        break;
                    case 'new_date_from':
                        $stmt->bindValue($identifier, $this->new_date_from, PDO::PARAM_STR);
                        break;
                    case 'old_date_until':
                        $stmt->bindValue($identifier, $this->old_date_until, PDO::PARAM_STR);
                        break;
                    case 'new_date_until':
                        $stmt->bindValue($identifier, $this->new_date_until, PDO::PARAM_STR);
                        break;
                    case 'old_original_value':
                        $stmt->bindValue($identifier, $this->old_original_value, PDO::PARAM_STR);
                        break;
                    case 'new_original_value':
                        $stmt->bindValue($identifier, $this->new_original_value, PDO::PARAM_STR);
                        break;
                    case 'old_new_value':
                        $stmt->bindValue($identifier, $this->old_new_value, PDO::PARAM_STR);
                        break;
                    case 'new_new_value':
                        $stmt->bindValue($identifier, $this->new_new_value, PDO::PARAM_STR);
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
        $pos = LogEditeMacroScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMacroScheduleId();
                break;
            case 2:
                return $this->getLogId();
                break;
            case 3:
                return $this->getOldDateFrom();
                break;
            case 4:
                return $this->getNewDateFrom();
                break;
            case 5:
                return $this->getOldDateUntil();
                break;
            case 6:
                return $this->getNewDateUntil();
                break;
            case 7:
                return $this->getOldOriginalValue();
                break;
            case 8:
                return $this->getNewOriginalValue();
                break;
            case 9:
                return $this->getOldNewValue();
                break;
            case 10:
                return $this->getNewNewValue();
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

        if (isset($alreadyDumpedObjects['LogEditeMacroSchedule'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LogEditeMacroSchedule'][$this->hashCode()] = true;
        $keys = LogEditeMacroScheduleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getMacroScheduleId(),
            $keys[2] => $this->getLogId(),
            $keys[3] => $this->getOldDateFrom(),
            $keys[4] => $this->getNewDateFrom(),
            $keys[5] => $this->getOldDateUntil(),
            $keys[6] => $this->getNewDateUntil(),
            $keys[7] => $this->getOldOriginalValue(),
            $keys[8] => $this->getNewOriginalValue(),
            $keys[9] => $this->getOldNewValue(),
            $keys[10] => $this->getNewNewValue(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLog) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'log';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log';
                        break;
                    default:
                        $key = 'Log';
                }

                $result[$key] = $this->aLog->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMacroSchedule) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'macroSchedule';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'macro_schedule';
                        break;
                    default:
                        $key = 'MacroSchedule';
                }

                $result[$key] = $this->aMacroSchedule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\LogEditeMacroSchedule
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LogEditeMacroScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\LogEditeMacroSchedule
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setMacroScheduleId($value);
                break;
            case 2:
                $this->setLogId($value);
                break;
            case 3:
                $this->setOldDateFrom($value);
                break;
            case 4:
                $this->setNewDateFrom($value);
                break;
            case 5:
                $this->setOldDateUntil($value);
                break;
            case 6:
                $this->setNewDateUntil($value);
                break;
            case 7:
                $this->setOldOriginalValue($value);
                break;
            case 8:
                $this->setNewOriginalValue($value);
                break;
            case 9:
                $this->setOldNewValue($value);
                break;
            case 10:
                $this->setNewNewValue($value);
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
     * @return     $this|\LogEditeMacroSchedule
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = LogEditeMacroScheduleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMacroScheduleId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLogId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOldDateFrom($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNewDateFrom($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOldDateUntil($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNewDateUntil($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOldOriginalValue($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNewOriginalValue($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOldNewValue($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setNewNewValue($arr[$keys[10]]);
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
     * @return $this|\LogEditeMacroSchedule The current object, for fluid interface
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
        $criteria = new Criteria(LogEditeMacroScheduleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_ID)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_MACRO_SCHEDULE_ID, $this->macro_schedule_id);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_LOG_ID)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_LOG_ID, $this->log_id);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_OLD_DATE_FROM, $this->old_date_from);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_NEW_DATE_FROM, $this->new_date_from);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_OLD_DATE_UNTIL, $this->old_date_until);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_NEW_DATE_UNTIL, $this->new_date_until);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_OLD_ORIGINAL_VALUE, $this->old_original_value);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_NEW_ORIGINAL_VALUE, $this->new_original_value);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_OLD_NEW_VALUE, $this->old_new_value);
        }
        if ($this->isColumnModified(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE)) {
            $criteria->add(LogEditeMacroScheduleTableMap::COL_NEW_NEW_VALUE, $this->new_new_value);
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
        $criteria = ChildLogEditeMacroScheduleQuery::create();
        $criteria->add(LogEditeMacroScheduleTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \LogEditeMacroSchedule (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setMacroScheduleId($this->getMacroScheduleId());
        $copyObj->setLogId($this->getLogId());
        $copyObj->setOldDateFrom($this->getOldDateFrom());
        $copyObj->setNewDateFrom($this->getNewDateFrom());
        $copyObj->setOldDateUntil($this->getOldDateUntil());
        $copyObj->setNewDateUntil($this->getNewDateUntil());
        $copyObj->setOldOriginalValue($this->getOldOriginalValue());
        $copyObj->setNewOriginalValue($this->getNewOriginalValue());
        $copyObj->setOldNewValue($this->getOldNewValue());
        $copyObj->setNewNewValue($this->getNewNewValue());
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
     * @return \LogEditeMacroSchedule Clone of current object.
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
     * Declares an association between this object and a ChildLog object.
     *
     * @param  ChildLog $v
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLog(ChildLog $v = null)
    {
        if ($v === null) {
            $this->setLogId(NULL);
        } else {
            $this->setLogId($v->getId());
        }

        $this->aLog = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLog object, it will not be re-added.
        if ($v !== null) {
            $v->addLogEditeMacroSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLog object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLog The associated ChildLog object.
     * @throws PropelException
     */
    public function getLog(ConnectionInterface $con = null)
    {
        if ($this->aLog === null && ($this->log_id != 0)) {
            $this->aLog = ChildLogQuery::create()->findPk($this->log_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLog->addLogEditeMacroSchedules($this);
             */
        }

        return $this->aLog;
    }

    /**
     * Declares an association between this object and a ChildMacroSchedule object.
     *
     * @param  ChildMacroSchedule $v
     * @return $this|\LogEditeMacroSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMacroSchedule(ChildMacroSchedule $v = null)
    {
        if ($v === null) {
            $this->setMacroScheduleId(NULL);
        } else {
            $this->setMacroScheduleId($v->getId());
        }

        $this->aMacroSchedule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMacroSchedule object, it will not be re-added.
        if ($v !== null) {
            $v->addLogEditeMacroSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMacroSchedule object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMacroSchedule The associated ChildMacroSchedule object.
     * @throws PropelException
     */
    public function getMacroSchedule(ConnectionInterface $con = null)
    {
        if ($this->aMacroSchedule === null && ($this->macro_schedule_id != 0)) {
            $this->aMacroSchedule = ChildMacroScheduleQuery::create()->findPk($this->macro_schedule_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMacroSchedule->addLogEditeMacroSchedules($this);
             */
        }

        return $this->aMacroSchedule;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLog) {
            $this->aLog->removeLogEditeMacroSchedule($this);
        }
        if (null !== $this->aMacroSchedule) {
            $this->aMacroSchedule->removeLogEditeMacroSchedule($this);
        }
        $this->id = null;
        $this->macro_schedule_id = null;
        $this->log_id = null;
        $this->old_date_from = null;
        $this->new_date_from = null;
        $this->old_date_until = null;
        $this->new_date_until = null;
        $this->old_original_value = null;
        $this->new_original_value = null;
        $this->old_new_value = null;
        $this->new_new_value = null;
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
        } // if ($deep)

        $this->aLog = null;
        $this->aMacroSchedule = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LogEditeMacroScheduleTableMap::DEFAULT_STRING_FORMAT);
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
