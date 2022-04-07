<?php

namespace Base;

use \Host as ChildHost;
use \HostQuery as ChildHostQuery;
use \HostSchedule as ChildHostSchedule;
use \HostScheduleQuery as ChildHostScheduleQuery;
use \LogDeleteHostSchedule as ChildLogDeleteHostSchedule;
use \LogDeleteHostScheduleQuery as ChildLogDeleteHostScheduleQuery;
use \LogEditHostSchedule as ChildLogEditHostSchedule;
use \LogEditHostScheduleQuery as ChildLogEditHostScheduleQuery;
use \LogHostExecution as ChildLogHostExecution;
use \LogHostExecutionQuery as ChildLogHostExecutionQuery;
use \Schedule as ChildSchedule;
use \ScheduleQuery as ChildScheduleQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\HostScheduleTableMap;
use Map\LogDeleteHostScheduleTableMap;
use Map\LogEditHostScheduleTableMap;
use Map\LogHostExecutionTableMap;
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
 * Base class that represents a row from the 'host_schedule' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class HostSchedule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\HostScheduleTableMap';


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
     * The value for the description field.
     *
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the scheduled field.
     *
     * @var        string
     */
    protected $scheduled;

    /**
     * The value for the schedule_id field.
     *
     * @var        int
     */
    protected $schedule_id;

    /**
     * The value for the host_id field.
     *
     * @var        int
     */
    protected $host_id;

    /**
     * The value for the push_pop field.
     *
     * @var        string
     */
    protected $push_pop;

    /**
     * The value for the enabled field.
     *
     * @var        string
     */
    protected $enabled;

    /**
     * The value for the usuario_id field.
     *
     * @var        int|null
     */
    protected $usuario_id;

    /**
     * @var        ChildHost
     */
    protected $aHost;

    /**
     * @var        ChildSchedule
     */
    protected $aSchedule;

    /**
     * @var        ChildUsuario
     */
    protected $aUsuario;

    /**
     * @var        ObjectCollection|ChildLogDeleteHostSchedule[] Collection to store aggregation of ChildLogDeleteHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteHostSchedule> Collection to store aggregation of ChildLogDeleteHostSchedule objects.
     */
    protected $collLogDeleteHostSchedules;
    protected $collLogDeleteHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogEditHostSchedule[] Collection to store aggregation of ChildLogEditHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule> Collection to store aggregation of ChildLogEditHostSchedule objects.
     */
    protected $collLogEditHostSchedules;
    protected $collLogEditHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogHostExecution[] Collection to store aggregation of ChildLogHostExecution objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogHostExecution> Collection to store aggregation of ChildLogHostExecution objects.
     */
    protected $collLogHostExecutions;
    protected $collLogHostExecutionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogDeleteHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteHostSchedule>
     */
    protected $logDeleteHostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule>
     */
    protected $logEditHostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogHostExecution[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogHostExecution>
     */
    protected $logHostExecutionsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\HostSchedule object.
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
     * Compares this with another <code>HostSchedule</code> instance.  If
     * <code>obj</code> is an instance of <code>HostSchedule</code>, delegates to
     * <code>equals(HostSchedule)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [description] column value.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [scheduled] column value.
     *
     * @return string
     */
    public function getScheduled()
    {
        return $this->scheduled;
    }

    /**
     * Get the [schedule_id] column value.
     *
     * @return int
     */
    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    /**
     * Get the [host_id] column value.
     *
     * @return int
     */
    public function getHostId()
    {
        return $this->host_id;
    }

    /**
     * Get the [push_pop] column value.
     *
     * @return string
     */
    public function getPushPop()
    {
        return $this->push_pop;
    }

    /**
     * Get the [enabled] column value.
     *
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the [usuario_id] column value.
     *
     * @return int|null
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [scheduled] column.
     *
     * @param string $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setScheduled($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->scheduled !== $v) {
            $this->scheduled = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_SCHEDULED] = true;
        }

        return $this;
    } // setScheduled()

    /**
     * Set the value of [schedule_id] column.
     *
     * @param int $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setScheduleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->schedule_id !== $v) {
            $this->schedule_id = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_SCHEDULE_ID] = true;
        }

        if ($this->aSchedule !== null && $this->aSchedule->getId() !== $v) {
            $this->aSchedule = null;
        }

        return $this;
    } // setScheduleId()

    /**
     * Set the value of [host_id] column.
     *
     * @param int $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setHostId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->host_id !== $v) {
            $this->host_id = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_HOST_ID] = true;
        }

        if ($this->aHost !== null && $this->aHost->getId() !== $v) {
            $this->aHost = null;
        }

        return $this;
    } // setHostId()

    /**
     * Set the value of [push_pop] column.
     *
     * @param string $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setPushPop($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->push_pop !== $v) {
            $this->push_pop = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_PUSH_POP] = true;
        }

        return $this;
    } // setPushPop()

    /**
     * Set the value of [enabled] column.
     *
     * @param string $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setEnabled($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->enabled !== $v) {
            $this->enabled = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_ENABLED] = true;
        }

        return $this;
    } // setEnabled()

    /**
     * Set the value of [usuario_id] column.
     *
     * @param int|null $v New value
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function setUsuarioId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usuario_id !== $v) {
            $this->usuario_id = $v;
            $this->modifiedColumns[HostScheduleTableMap::COL_USUARIO_ID] = true;
        }

        if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
            $this->aUsuario = null;
        }

        return $this;
    } // setUsuarioId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HostScheduleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HostScheduleTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HostScheduleTableMap::translateFieldName('Scheduled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->scheduled = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HostScheduleTableMap::translateFieldName('ScheduleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->schedule_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HostScheduleTableMap::translateFieldName('HostId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->host_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HostScheduleTableMap::translateFieldName('PushPop', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_pop = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HostScheduleTableMap::translateFieldName('Enabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enabled = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HostScheduleTableMap::translateFieldName('UsuarioId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usuario_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = HostScheduleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\HostSchedule'), 0, $e);
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
        if ($this->aSchedule !== null && $this->schedule_id !== $this->aSchedule->getId()) {
            $this->aSchedule = null;
        }
        if ($this->aHost !== null && $this->host_id !== $this->aHost->getId()) {
            $this->aHost = null;
        }
        if ($this->aUsuario !== null && $this->usuario_id !== $this->aUsuario->getId()) {
            $this->aUsuario = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHostScheduleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aHost = null;
            $this->aSchedule = null;
            $this->aUsuario = null;
            $this->collLogDeleteHostSchedules = null;

            $this->collLogEditHostSchedules = null;

            $this->collLogHostExecutions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see HostSchedule::setDeleted()
     * @see HostSchedule::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHostScheduleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HostScheduleTableMap::DATABASE_NAME);
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
                HostScheduleTableMap::addInstanceToPool($this);
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

            if ($this->aHost !== null) {
                if ($this->aHost->isModified() || $this->aHost->isNew()) {
                    $affectedRows += $this->aHost->save($con);
                }
                $this->setHost($this->aHost);
            }

            if ($this->aSchedule !== null) {
                if ($this->aSchedule->isModified() || $this->aSchedule->isNew()) {
                    $affectedRows += $this->aSchedule->save($con);
                }
                $this->setSchedule($this->aSchedule);
            }

            if ($this->aUsuario !== null) {
                if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
                    $affectedRows += $this->aUsuario->save($con);
                }
                $this->setUsuario($this->aUsuario);
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

            if ($this->logDeleteHostSchedulesScheduledForDeletion !== null) {
                if (!$this->logDeleteHostSchedulesScheduledForDeletion->isEmpty()) {
                    \LogDeleteHostScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logDeleteHostSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logDeleteHostSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogDeleteHostSchedules !== null) {
                foreach ($this->collLogDeleteHostSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->logEditHostSchedulesScheduledForDeletion !== null) {
                if (!$this->logEditHostSchedulesScheduledForDeletion->isEmpty()) {
                    \LogEditHostScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logEditHostSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logEditHostSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogEditHostSchedules !== null) {
                foreach ($this->collLogEditHostSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->logHostExecutionsScheduledForDeletion !== null) {
                if (!$this->logHostExecutionsScheduledForDeletion->isEmpty()) {
                    \LogHostExecutionQuery::create()
                        ->filterByPrimaryKeys($this->logHostExecutionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logHostExecutionsScheduledForDeletion = null;
                }
            }

            if ($this->collLogHostExecutions !== null) {
                foreach ($this->collLogHostExecutions as $referrerFK) {
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

        $this->modifiedColumns[HostScheduleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HostScheduleTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('host_schedule_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HostScheduleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_SCHEDULED)) {
            $modifiedColumns[':p' . $index++]  = 'scheduled';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_SCHEDULE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'schedule_id';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_HOST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'host_id';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_PUSH_POP)) {
            $modifiedColumns[':p' . $index++]  = 'push_pop';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'enabled';
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_USUARIO_ID)) {
            $modifiedColumns[':p' . $index++]  = 'usuario_id';
        }

        $sql = sprintf(
            'INSERT INTO host_schedule (%s) VALUES (%s)',
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
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'scheduled':
                        $stmt->bindValue($identifier, $this->scheduled, PDO::PARAM_STR);
                        break;
                    case 'schedule_id':
                        $stmt->bindValue($identifier, $this->schedule_id, PDO::PARAM_INT);
                        break;
                    case 'host_id':
                        $stmt->bindValue($identifier, $this->host_id, PDO::PARAM_INT);
                        break;
                    case 'push_pop':
                        $stmt->bindValue($identifier, $this->push_pop, PDO::PARAM_STR);
                        break;
                    case 'enabled':
                        $stmt->bindValue($identifier, $this->enabled, PDO::PARAM_STR);
                        break;
                    case 'usuario_id':
                        $stmt->bindValue($identifier, $this->usuario_id, PDO::PARAM_INT);
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
        $pos = HostScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDescription();
                break;
            case 2:
                return $this->getScheduled();
                break;
            case 3:
                return $this->getScheduleId();
                break;
            case 4:
                return $this->getHostId();
                break;
            case 5:
                return $this->getPushPop();
                break;
            case 6:
                return $this->getEnabled();
                break;
            case 7:
                return $this->getUsuarioId();
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

        if (isset($alreadyDumpedObjects['HostSchedule'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['HostSchedule'][$this->hashCode()] = true;
        $keys = HostScheduleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDescription(),
            $keys[2] => $this->getScheduled(),
            $keys[3] => $this->getScheduleId(),
            $keys[4] => $this->getHostId(),
            $keys[5] => $this->getPushPop(),
            $keys[6] => $this->getEnabled(),
            $keys[7] => $this->getUsuarioId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aHost) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'host';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'host';
                        break;
                    default:
                        $key = 'Host';
                }

                $result[$key] = $this->aHost->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSchedule) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'schedule';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'schedule';
                        break;
                    default:
                        $key = 'Schedule';
                }

                $result[$key] = $this->aSchedule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsuario) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuario';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'usuario';
                        break;
                    default:
                        $key = 'Usuario';
                }

                $result[$key] = $this->aUsuario->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLogDeleteHostSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logDeleteHostSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_delete_host_schedules';
                        break;
                    default:
                        $key = 'LogDeleteHostSchedules';
                }

                $result[$key] = $this->collLogDeleteHostSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLogEditHostSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logEditHostSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_edit_host_schedules';
                        break;
                    default:
                        $key = 'LogEditHostSchedules';
                }

                $result[$key] = $this->collLogEditHostSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLogHostExecutions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logHostExecutions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_host_executions';
                        break;
                    default:
                        $key = 'LogHostExecutions';
                }

                $result[$key] = $this->collLogHostExecutions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\HostSchedule
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = HostScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\HostSchedule
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setDescription($value);
                break;
            case 2:
                $this->setScheduled($value);
                break;
            case 3:
                $this->setScheduleId($value);
                break;
            case 4:
                $this->setHostId($value);
                break;
            case 5:
                $this->setPushPop($value);
                break;
            case 6:
                $this->setEnabled($value);
                break;
            case 7:
                $this->setUsuarioId($value);
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
     * @return     $this|\HostSchedule
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = HostScheduleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDescription($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setScheduled($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setScheduleId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setHostId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPushPop($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEnabled($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUsuarioId($arr[$keys[7]]);
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
     * @return $this|\HostSchedule The current object, for fluid interface
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
        $criteria = new Criteria(HostScheduleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HostScheduleTableMap::COL_ID)) {
            $criteria->add(HostScheduleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_DESCRIPTION)) {
            $criteria->add(HostScheduleTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_SCHEDULED)) {
            $criteria->add(HostScheduleTableMap::COL_SCHEDULED, $this->scheduled);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_SCHEDULE_ID)) {
            $criteria->add(HostScheduleTableMap::COL_SCHEDULE_ID, $this->schedule_id);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_HOST_ID)) {
            $criteria->add(HostScheduleTableMap::COL_HOST_ID, $this->host_id);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_PUSH_POP)) {
            $criteria->add(HostScheduleTableMap::COL_PUSH_POP, $this->push_pop);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_ENABLED)) {
            $criteria->add(HostScheduleTableMap::COL_ENABLED, $this->enabled);
        }
        if ($this->isColumnModified(HostScheduleTableMap::COL_USUARIO_ID)) {
            $criteria->add(HostScheduleTableMap::COL_USUARIO_ID, $this->usuario_id);
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
        $criteria = ChildHostScheduleQuery::create();
        $criteria->add(HostScheduleTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \HostSchedule (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDescription($this->getDescription());
        $copyObj->setScheduled($this->getScheduled());
        $copyObj->setScheduleId($this->getScheduleId());
        $copyObj->setHostId($this->getHostId());
        $copyObj->setPushPop($this->getPushPop());
        $copyObj->setEnabled($this->getEnabled());
        $copyObj->setUsuarioId($this->getUsuarioId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLogDeleteHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogDeleteHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogHostExecutions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogHostExecution($relObj->copy($deepCopy));
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
     * @return \HostSchedule Clone of current object.
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
     * Declares an association between this object and a ChildHost object.
     *
     * @param  ChildHost $v
     * @return $this|\HostSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHost(ChildHost $v = null)
    {
        if ($v === null) {
            $this->setHostId(NULL);
        } else {
            $this->setHostId($v->getId());
        }

        $this->aHost = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHost object, it will not be re-added.
        if ($v !== null) {
            $v->addHostSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHost object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHost The associated ChildHost object.
     * @throws PropelException
     */
    public function getHost(ConnectionInterface $con = null)
    {
        if ($this->aHost === null && ($this->host_id != 0)) {
            $this->aHost = ChildHostQuery::create()->findPk($this->host_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHost->addHostSchedules($this);
             */
        }

        return $this->aHost;
    }

    /**
     * Declares an association between this object and a ChildSchedule object.
     *
     * @param  ChildSchedule $v
     * @return $this|\HostSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSchedule(ChildSchedule $v = null)
    {
        if ($v === null) {
            $this->setScheduleId(NULL);
        } else {
            $this->setScheduleId($v->getId());
        }

        $this->aSchedule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSchedule object, it will not be re-added.
        if ($v !== null) {
            $v->addHostSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSchedule object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSchedule The associated ChildSchedule object.
     * @throws PropelException
     */
    public function getSchedule(ConnectionInterface $con = null)
    {
        if ($this->aSchedule === null && ($this->schedule_id != 0)) {
            $this->aSchedule = ChildScheduleQuery::create()->findPk($this->schedule_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSchedule->addHostSchedules($this);
             */
        }

        return $this->aSchedule;
    }

    /**
     * Declares an association between this object and a ChildUsuario object.
     *
     * @param  ChildUsuario|null $v
     * @return $this|\HostSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuario(ChildUsuario $v = null)
    {
        if ($v === null) {
            $this->setUsuarioId(NULL);
        } else {
            $this->setUsuarioId($v->getId());
        }

        $this->aUsuario = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsuario object, it will not be re-added.
        if ($v !== null) {
            $v->addHostSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsuario object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsuario|null The associated ChildUsuario object.
     * @throws PropelException
     */
    public function getUsuario(ConnectionInterface $con = null)
    {
        if ($this->aUsuario === null && ($this->usuario_id != 0)) {
            $this->aUsuario = ChildUsuarioQuery::create()->findPk($this->usuario_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuario->addHostSchedules($this);
             */
        }

        return $this->aUsuario;
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
        if ('LogDeleteHostSchedule' === $relationName) {
            $this->initLogDeleteHostSchedules();
            return;
        }
        if ('LogEditHostSchedule' === $relationName) {
            $this->initLogEditHostSchedules();
            return;
        }
        if ('LogHostExecution' === $relationName) {
            $this->initLogHostExecutions();
            return;
        }
    }

    /**
     * Clears out the collLogDeleteHostSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogDeleteHostSchedules()
     */
    public function clearLogDeleteHostSchedules()
    {
        $this->collLogDeleteHostSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogDeleteHostSchedules collection loaded partially.
     */
    public function resetPartialLogDeleteHostSchedules($v = true)
    {
        $this->collLogDeleteHostSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogDeleteHostSchedules collection.
     *
     * By default this just sets the collLogDeleteHostSchedules collection to an empty array (like clearcollLogDeleteHostSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogDeleteHostSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogDeleteHostSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogDeleteHostScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogDeleteHostSchedules = new $collectionClassName;
        $this->collLogDeleteHostSchedules->setModel('\LogDeleteHostSchedule');
    }

    /**
     * Gets an array of ChildLogDeleteHostSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHostSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogDeleteHostSchedule[] List of ChildLogDeleteHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteHostSchedule> List of ChildLogDeleteHostSchedule objects
     * @throws PropelException
     */
    public function getLogDeleteHostSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteHostSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogDeleteHostSchedules) {
                    $this->initLogDeleteHostSchedules();
                } else {
                    $collectionClassName = LogDeleteHostScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogDeleteHostSchedules = new $collectionClassName;
                    $collLogDeleteHostSchedules->setModel('\LogDeleteHostSchedule');

                    return $collLogDeleteHostSchedules;
                }
            } else {
                $collLogDeleteHostSchedules = ChildLogDeleteHostScheduleQuery::create(null, $criteria)
                    ->filterByHostSchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogDeleteHostSchedulesPartial && count($collLogDeleteHostSchedules)) {
                        $this->initLogDeleteHostSchedules(false);

                        foreach ($collLogDeleteHostSchedules as $obj) {
                            if (false == $this->collLogDeleteHostSchedules->contains($obj)) {
                                $this->collLogDeleteHostSchedules->append($obj);
                            }
                        }

                        $this->collLogDeleteHostSchedulesPartial = true;
                    }

                    return $collLogDeleteHostSchedules;
                }

                if ($partial && $this->collLogDeleteHostSchedules) {
                    foreach ($this->collLogDeleteHostSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogDeleteHostSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogDeleteHostSchedules = $collLogDeleteHostSchedules;
                $this->collLogDeleteHostSchedulesPartial = false;
            }
        }

        return $this->collLogDeleteHostSchedules;
    }

    /**
     * Sets a collection of ChildLogDeleteHostSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logDeleteHostSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function setLogDeleteHostSchedules(Collection $logDeleteHostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogDeleteHostSchedule[] $logDeleteHostSchedulesToDelete */
        $logDeleteHostSchedulesToDelete = $this->getLogDeleteHostSchedules(new Criteria(), $con)->diff($logDeleteHostSchedules);


        $this->logDeleteHostSchedulesScheduledForDeletion = $logDeleteHostSchedulesToDelete;

        foreach ($logDeleteHostSchedulesToDelete as $logDeleteHostScheduleRemoved) {
            $logDeleteHostScheduleRemoved->setHostSchedule(null);
        }

        $this->collLogDeleteHostSchedules = null;
        foreach ($logDeleteHostSchedules as $logDeleteHostSchedule) {
            $this->addLogDeleteHostSchedule($logDeleteHostSchedule);
        }

        $this->collLogDeleteHostSchedules = $logDeleteHostSchedules;
        $this->collLogDeleteHostSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogDeleteHostSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogDeleteHostSchedule objects.
     * @throws PropelException
     */
    public function countLogDeleteHostSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteHostSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogDeleteHostSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogDeleteHostSchedules());
            }

            $query = ChildLogDeleteHostScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHostSchedule($this)
                ->count($con);
        }

        return count($this->collLogDeleteHostSchedules);
    }

    /**
     * Method called to associate a ChildLogDeleteHostSchedule object to this object
     * through the ChildLogDeleteHostSchedule foreign key attribute.
     *
     * @param  ChildLogDeleteHostSchedule $l ChildLogDeleteHostSchedule
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function addLogDeleteHostSchedule(ChildLogDeleteHostSchedule $l)
    {
        if ($this->collLogDeleteHostSchedules === null) {
            $this->initLogDeleteHostSchedules();
            $this->collLogDeleteHostSchedulesPartial = true;
        }

        if (!$this->collLogDeleteHostSchedules->contains($l)) {
            $this->doAddLogDeleteHostSchedule($l);

            if ($this->logDeleteHostSchedulesScheduledForDeletion and $this->logDeleteHostSchedulesScheduledForDeletion->contains($l)) {
                $this->logDeleteHostSchedulesScheduledForDeletion->remove($this->logDeleteHostSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogDeleteHostSchedule $logDeleteHostSchedule The ChildLogDeleteHostSchedule object to add.
     */
    protected function doAddLogDeleteHostSchedule(ChildLogDeleteHostSchedule $logDeleteHostSchedule)
    {
        $this->collLogDeleteHostSchedules[]= $logDeleteHostSchedule;
        $logDeleteHostSchedule->setHostSchedule($this);
    }

    /**
     * @param  ChildLogDeleteHostSchedule $logDeleteHostSchedule The ChildLogDeleteHostSchedule object to remove.
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function removeLogDeleteHostSchedule(ChildLogDeleteHostSchedule $logDeleteHostSchedule)
    {
        if ($this->getLogDeleteHostSchedules()->contains($logDeleteHostSchedule)) {
            $pos = $this->collLogDeleteHostSchedules->search($logDeleteHostSchedule);
            $this->collLogDeleteHostSchedules->remove($pos);
            if (null === $this->logDeleteHostSchedulesScheduledForDeletion) {
                $this->logDeleteHostSchedulesScheduledForDeletion = clone $this->collLogDeleteHostSchedules;
                $this->logDeleteHostSchedulesScheduledForDeletion->clear();
            }
            $this->logDeleteHostSchedulesScheduledForDeletion[]= clone $logDeleteHostSchedule;
            $logDeleteHostSchedule->setHostSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this HostSchedule is new, it will return
     * an empty collection; or if this HostSchedule has previously
     * been saved, it will retrieve related LogDeleteHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in HostSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogDeleteHostSchedule[] List of ChildLogDeleteHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteHostSchedule}> List of ChildLogDeleteHostSchedule objects
     */
    public function getLogDeleteHostSchedulesJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogDeleteHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogDeleteHostSchedules($query, $con);
    }

    /**
     * Clears out the collLogEditHostSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogEditHostSchedules()
     */
    public function clearLogEditHostSchedules()
    {
        $this->collLogEditHostSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogEditHostSchedules collection loaded partially.
     */
    public function resetPartialLogEditHostSchedules($v = true)
    {
        $this->collLogEditHostSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogEditHostSchedules collection.
     *
     * By default this just sets the collLogEditHostSchedules collection to an empty array (like clearcollLogEditHostSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogEditHostSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogEditHostSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogEditHostSchedules = new $collectionClassName;
        $this->collLogEditHostSchedules->setModel('\LogEditHostSchedule');
    }

    /**
     * Gets an array of ChildLogEditHostSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHostSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule> List of ChildLogEditHostSchedule objects
     * @throws PropelException
     */
    public function getLogEditHostSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogEditHostSchedules) {
                    $this->initLogEditHostSchedules();
                } else {
                    $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogEditHostSchedules = new $collectionClassName;
                    $collLogEditHostSchedules->setModel('\LogEditHostSchedule');

                    return $collLogEditHostSchedules;
                }
            } else {
                $collLogEditHostSchedules = ChildLogEditHostScheduleQuery::create(null, $criteria)
                    ->filterByHostSchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogEditHostSchedulesPartial && count($collLogEditHostSchedules)) {
                        $this->initLogEditHostSchedules(false);

                        foreach ($collLogEditHostSchedules as $obj) {
                            if (false == $this->collLogEditHostSchedules->contains($obj)) {
                                $this->collLogEditHostSchedules->append($obj);
                            }
                        }

                        $this->collLogEditHostSchedulesPartial = true;
                    }

                    return $collLogEditHostSchedules;
                }

                if ($partial && $this->collLogEditHostSchedules) {
                    foreach ($this->collLogEditHostSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogEditHostSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogEditHostSchedules = $collLogEditHostSchedules;
                $this->collLogEditHostSchedulesPartial = false;
            }
        }

        return $this->collLogEditHostSchedules;
    }

    /**
     * Sets a collection of ChildLogEditHostSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logEditHostSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function setLogEditHostSchedules(Collection $logEditHostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditHostSchedule[] $logEditHostSchedulesToDelete */
        $logEditHostSchedulesToDelete = $this->getLogEditHostSchedules(new Criteria(), $con)->diff($logEditHostSchedules);


        $this->logEditHostSchedulesScheduledForDeletion = $logEditHostSchedulesToDelete;

        foreach ($logEditHostSchedulesToDelete as $logEditHostScheduleRemoved) {
            $logEditHostScheduleRemoved->setHostSchedule(null);
        }

        $this->collLogEditHostSchedules = null;
        foreach ($logEditHostSchedules as $logEditHostSchedule) {
            $this->addLogEditHostSchedule($logEditHostSchedule);
        }

        $this->collLogEditHostSchedules = $logEditHostSchedules;
        $this->collLogEditHostSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogEditHostSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogEditHostSchedule objects.
     * @throws PropelException
     */
    public function countLogEditHostSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogEditHostSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogEditHostSchedules());
            }

            $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHostSchedule($this)
                ->count($con);
        }

        return count($this->collLogEditHostSchedules);
    }

    /**
     * Method called to associate a ChildLogEditHostSchedule object to this object
     * through the ChildLogEditHostSchedule foreign key attribute.
     *
     * @param  ChildLogEditHostSchedule $l ChildLogEditHostSchedule
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function addLogEditHostSchedule(ChildLogEditHostSchedule $l)
    {
        if ($this->collLogEditHostSchedules === null) {
            $this->initLogEditHostSchedules();
            $this->collLogEditHostSchedulesPartial = true;
        }

        if (!$this->collLogEditHostSchedules->contains($l)) {
            $this->doAddLogEditHostSchedule($l);

            if ($this->logEditHostSchedulesScheduledForDeletion and $this->logEditHostSchedulesScheduledForDeletion->contains($l)) {
                $this->logEditHostSchedulesScheduledForDeletion->remove($this->logEditHostSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogEditHostSchedule $logEditHostSchedule The ChildLogEditHostSchedule object to add.
     */
    protected function doAddLogEditHostSchedule(ChildLogEditHostSchedule $logEditHostSchedule)
    {
        $this->collLogEditHostSchedules[]= $logEditHostSchedule;
        $logEditHostSchedule->setHostSchedule($this);
    }

    /**
     * @param  ChildLogEditHostSchedule $logEditHostSchedule The ChildLogEditHostSchedule object to remove.
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function removeLogEditHostSchedule(ChildLogEditHostSchedule $logEditHostSchedule)
    {
        if ($this->getLogEditHostSchedules()->contains($logEditHostSchedule)) {
            $pos = $this->collLogEditHostSchedules->search($logEditHostSchedule);
            $this->collLogEditHostSchedules->remove($pos);
            if (null === $this->logEditHostSchedulesScheduledForDeletion) {
                $this->logEditHostSchedulesScheduledForDeletion = clone $this->collLogEditHostSchedules;
                $this->logEditHostSchedulesScheduledForDeletion->clear();
            }
            $this->logEditHostSchedulesScheduledForDeletion[]= clone $logEditHostSchedule;
            $logEditHostSchedule->setHostSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this HostSchedule is new, it will return
     * an empty collection; or if this HostSchedule has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in HostSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogEditHostSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this HostSchedule is new, it will return
     * an empty collection; or if this HostSchedule has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in HostSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesJoinHostRelatedByNewHostId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostRelatedByNewHostId', $joinBehavior);

        return $this->getLogEditHostSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this HostSchedule is new, it will return
     * an empty collection; or if this HostSchedule has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in HostSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesJoinHostRelatedByOldHostId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostRelatedByOldHostId', $joinBehavior);

        return $this->getLogEditHostSchedules($query, $con);
    }

    /**
     * Clears out the collLogHostExecutions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogHostExecutions()
     */
    public function clearLogHostExecutions()
    {
        $this->collLogHostExecutions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogHostExecutions collection loaded partially.
     */
    public function resetPartialLogHostExecutions($v = true)
    {
        $this->collLogHostExecutionsPartial = $v;
    }

    /**
     * Initializes the collLogHostExecutions collection.
     *
     * By default this just sets the collLogHostExecutions collection to an empty array (like clearcollLogHostExecutions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogHostExecutions($overrideExisting = true)
    {
        if (null !== $this->collLogHostExecutions && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogHostExecutionTableMap::getTableMap()->getCollectionClassName();

        $this->collLogHostExecutions = new $collectionClassName;
        $this->collLogHostExecutions->setModel('\LogHostExecution');
    }

    /**
     * Gets an array of ChildLogHostExecution objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHostSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogHostExecution[] List of ChildLogHostExecution objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogHostExecution> List of ChildLogHostExecution objects
     * @throws PropelException
     */
    public function getLogHostExecutions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogHostExecutionsPartial && !$this->isNew();
        if (null === $this->collLogHostExecutions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogHostExecutions) {
                    $this->initLogHostExecutions();
                } else {
                    $collectionClassName = LogHostExecutionTableMap::getTableMap()->getCollectionClassName();

                    $collLogHostExecutions = new $collectionClassName;
                    $collLogHostExecutions->setModel('\LogHostExecution');

                    return $collLogHostExecutions;
                }
            } else {
                $collLogHostExecutions = ChildLogHostExecutionQuery::create(null, $criteria)
                    ->filterByHostSchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogHostExecutionsPartial && count($collLogHostExecutions)) {
                        $this->initLogHostExecutions(false);

                        foreach ($collLogHostExecutions as $obj) {
                            if (false == $this->collLogHostExecutions->contains($obj)) {
                                $this->collLogHostExecutions->append($obj);
                            }
                        }

                        $this->collLogHostExecutionsPartial = true;
                    }

                    return $collLogHostExecutions;
                }

                if ($partial && $this->collLogHostExecutions) {
                    foreach ($this->collLogHostExecutions as $obj) {
                        if ($obj->isNew()) {
                            $collLogHostExecutions[] = $obj;
                        }
                    }
                }

                $this->collLogHostExecutions = $collLogHostExecutions;
                $this->collLogHostExecutionsPartial = false;
            }
        }

        return $this->collLogHostExecutions;
    }

    /**
     * Sets a collection of ChildLogHostExecution objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logHostExecutions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function setLogHostExecutions(Collection $logHostExecutions, ConnectionInterface $con = null)
    {
        /** @var ChildLogHostExecution[] $logHostExecutionsToDelete */
        $logHostExecutionsToDelete = $this->getLogHostExecutions(new Criteria(), $con)->diff($logHostExecutions);


        $this->logHostExecutionsScheduledForDeletion = $logHostExecutionsToDelete;

        foreach ($logHostExecutionsToDelete as $logHostExecutionRemoved) {
            $logHostExecutionRemoved->setHostSchedule(null);
        }

        $this->collLogHostExecutions = null;
        foreach ($logHostExecutions as $logHostExecution) {
            $this->addLogHostExecution($logHostExecution);
        }

        $this->collLogHostExecutions = $logHostExecutions;
        $this->collLogHostExecutionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogHostExecution objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogHostExecution objects.
     * @throws PropelException
     */
    public function countLogHostExecutions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogHostExecutionsPartial && !$this->isNew();
        if (null === $this->collLogHostExecutions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogHostExecutions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogHostExecutions());
            }

            $query = ChildLogHostExecutionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHostSchedule($this)
                ->count($con);
        }

        return count($this->collLogHostExecutions);
    }

    /**
     * Method called to associate a ChildLogHostExecution object to this object
     * through the ChildLogHostExecution foreign key attribute.
     *
     * @param  ChildLogHostExecution $l ChildLogHostExecution
     * @return $this|\HostSchedule The current object (for fluent API support)
     */
    public function addLogHostExecution(ChildLogHostExecution $l)
    {
        if ($this->collLogHostExecutions === null) {
            $this->initLogHostExecutions();
            $this->collLogHostExecutionsPartial = true;
        }

        if (!$this->collLogHostExecutions->contains($l)) {
            $this->doAddLogHostExecution($l);

            if ($this->logHostExecutionsScheduledForDeletion and $this->logHostExecutionsScheduledForDeletion->contains($l)) {
                $this->logHostExecutionsScheduledForDeletion->remove($this->logHostExecutionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogHostExecution $logHostExecution The ChildLogHostExecution object to add.
     */
    protected function doAddLogHostExecution(ChildLogHostExecution $logHostExecution)
    {
        $this->collLogHostExecutions[]= $logHostExecution;
        $logHostExecution->setHostSchedule($this);
    }

    /**
     * @param  ChildLogHostExecution $logHostExecution The ChildLogHostExecution object to remove.
     * @return $this|ChildHostSchedule The current object (for fluent API support)
     */
    public function removeLogHostExecution(ChildLogHostExecution $logHostExecution)
    {
        if ($this->getLogHostExecutions()->contains($logHostExecution)) {
            $pos = $this->collLogHostExecutions->search($logHostExecution);
            $this->collLogHostExecutions->remove($pos);
            if (null === $this->logHostExecutionsScheduledForDeletion) {
                $this->logHostExecutionsScheduledForDeletion = clone $this->collLogHostExecutions;
                $this->logHostExecutionsScheduledForDeletion->clear();
            }
            $this->logHostExecutionsScheduledForDeletion[]= clone $logHostExecution;
            $logHostExecution->setHostSchedule(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aHost) {
            $this->aHost->removeHostSchedule($this);
        }
        if (null !== $this->aSchedule) {
            $this->aSchedule->removeHostSchedule($this);
        }
        if (null !== $this->aUsuario) {
            $this->aUsuario->removeHostSchedule($this);
        }
        $this->id = null;
        $this->description = null;
        $this->scheduled = null;
        $this->schedule_id = null;
        $this->host_id = null;
        $this->push_pop = null;
        $this->enabled = null;
        $this->usuario_id = null;
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
            if ($this->collLogDeleteHostSchedules) {
                foreach ($this->collLogDeleteHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditHostSchedules) {
                foreach ($this->collLogEditHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogHostExecutions) {
                foreach ($this->collLogHostExecutions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLogDeleteHostSchedules = null;
        $this->collLogEditHostSchedules = null;
        $this->collLogHostExecutions = null;
        $this->aHost = null;
        $this->aSchedule = null;
        $this->aUsuario = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HostScheduleTableMap::DEFAULT_STRING_FORMAT);
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
