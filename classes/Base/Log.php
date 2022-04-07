<?php

namespace Base;

use \Log as ChildLog;
use \LogDeleteGrupoSchedule as ChildLogDeleteGrupoSchedule;
use \LogDeleteGrupoScheduleQuery as ChildLogDeleteGrupoScheduleQuery;
use \LogDeleteHostSchedule as ChildLogDeleteHostSchedule;
use \LogDeleteHostScheduleQuery as ChildLogDeleteHostScheduleQuery;
use \LogDeleteMacroSchedule as ChildLogDeleteMacroSchedule;
use \LogDeleteMacroScheduleQuery as ChildLogDeleteMacroScheduleQuery;
use \LogEditHostSchedule as ChildLogEditHostSchedule;
use \LogEditHostScheduleQuery as ChildLogEditHostScheduleQuery;
use \LogEditeGrupoSchedule as ChildLogEditeGrupoSchedule;
use \LogEditeGrupoScheduleQuery as ChildLogEditeGrupoScheduleQuery;
use \LogEditeMacroSchedule as ChildLogEditeMacroSchedule;
use \LogEditeMacroScheduleQuery as ChildLogEditeMacroScheduleQuery;
use \LogQuery as ChildLogQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\LogDeleteGrupoScheduleTableMap;
use Map\LogDeleteHostScheduleTableMap;
use Map\LogDeleteMacroScheduleTableMap;
use Map\LogEditHostScheduleTableMap;
use Map\LogEditeGrupoScheduleTableMap;
use Map\LogEditeMacroScheduleTableMap;
use Map\LogTableMap;
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
 * Base class that represents a row from the 'log' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Log implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\LogTableMap';


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
     * The value for the logtime field.
     *
     * @var        string
     */
    protected $logtime;

    /**
     * The value for the usuario_id field.
     *
     * @var        int
     */
    protected $usuario_id;

    /**
     * @var        ChildUsuario
     */
    protected $aUsuario;

    /**
     * @var        ObjectCollection|ChildLogDeleteGrupoSchedule[] Collection to store aggregation of ChildLogDeleteGrupoSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteGrupoSchedule> Collection to store aggregation of ChildLogDeleteGrupoSchedule objects.
     */
    protected $collLogDeleteGrupoSchedules;
    protected $collLogDeleteGrupoSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogDeleteHostSchedule[] Collection to store aggregation of ChildLogDeleteHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteHostSchedule> Collection to store aggregation of ChildLogDeleteHostSchedule objects.
     */
    protected $collLogDeleteHostSchedules;
    protected $collLogDeleteHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogDeleteMacroSchedule[] Collection to store aggregation of ChildLogDeleteMacroSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> Collection to store aggregation of ChildLogDeleteMacroSchedule objects.
     */
    protected $collLogDeleteMacroSchedules;
    protected $collLogDeleteMacroSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogEditHostSchedule[] Collection to store aggregation of ChildLogEditHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule> Collection to store aggregation of ChildLogEditHostSchedule objects.
     */
    protected $collLogEditHostSchedules;
    protected $collLogEditHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogEditeGrupoSchedule[] Collection to store aggregation of ChildLogEditeGrupoSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> Collection to store aggregation of ChildLogEditeGrupoSchedule objects.
     */
    protected $collLogEditeGrupoSchedules;
    protected $collLogEditeGrupoSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogEditeMacroSchedule[] Collection to store aggregation of ChildLogEditeMacroSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> Collection to store aggregation of ChildLogEditeMacroSchedule objects.
     */
    protected $collLogEditeMacroSchedules;
    protected $collLogEditeMacroSchedulesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogDeleteGrupoSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteGrupoSchedule>
     */
    protected $logDeleteGrupoSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogDeleteHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteHostSchedule>
     */
    protected $logDeleteHostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogDeleteMacroSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule>
     */
    protected $logDeleteMacroSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule>
     */
    protected $logEditHostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditeGrupoSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule>
     */
    protected $logEditeGrupoSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditeMacroSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeMacroSchedule>
     */
    protected $logEditeMacroSchedulesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Log object.
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
     * Compares this with another <code>Log</code> instance.  If
     * <code>obj</code> is an instance of <code>Log</code>, delegates to
     * <code>equals(Log)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [logtime] column value.
     *
     * @return string
     */
    public function getLogtime()
    {
        return $this->logtime;
    }

    /**
     * Get the [usuario_id] column value.
     *
     * @return int
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\Log The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[LogTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [logtime] column.
     *
     * @param string $v New value
     * @return $this|\Log The current object (for fluent API support)
     */
    public function setLogtime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->logtime !== $v) {
            $this->logtime = $v;
            $this->modifiedColumns[LogTableMap::COL_LOGTIME] = true;
        }

        return $this;
    } // setLogtime()

    /**
     * Set the value of [usuario_id] column.
     *
     * @param int $v New value
     * @return $this|\Log The current object (for fluent API support)
     */
    public function setUsuarioId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usuario_id !== $v) {
            $this->usuario_id = $v;
            $this->modifiedColumns[LogTableMap::COL_USUARIO_ID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LogTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LogTableMap::translateFieldName('Logtime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logtime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LogTableMap::translateFieldName('UsuarioId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usuario_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = LogTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Log'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(LogTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLogQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsuario = null;
            $this->collLogDeleteGrupoSchedules = null;

            $this->collLogDeleteHostSchedules = null;

            $this->collLogDeleteMacroSchedules = null;

            $this->collLogEditHostSchedules = null;

            $this->collLogEditeGrupoSchedules = null;

            $this->collLogEditeMacroSchedules = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Log::setDeleted()
     * @see Log::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LogTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLogQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LogTableMap::DATABASE_NAME);
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
                LogTableMap::addInstanceToPool($this);
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

            if ($this->logDeleteGrupoSchedulesScheduledForDeletion !== null) {
                if (!$this->logDeleteGrupoSchedulesScheduledForDeletion->isEmpty()) {
                    \LogDeleteGrupoScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logDeleteGrupoSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logDeleteGrupoSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogDeleteGrupoSchedules !== null) {
                foreach ($this->collLogDeleteGrupoSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->logDeleteMacroSchedulesScheduledForDeletion !== null) {
                if (!$this->logDeleteMacroSchedulesScheduledForDeletion->isEmpty()) {
                    \LogDeleteMacroScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logDeleteMacroSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logDeleteMacroSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogDeleteMacroSchedules !== null) {
                foreach ($this->collLogDeleteMacroSchedules as $referrerFK) {
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

            if ($this->logEditeGrupoSchedulesScheduledForDeletion !== null) {
                if (!$this->logEditeGrupoSchedulesScheduledForDeletion->isEmpty()) {
                    \LogEditeGrupoScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logEditeGrupoSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logEditeGrupoSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogEditeGrupoSchedules !== null) {
                foreach ($this->collLogEditeGrupoSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->logEditeMacroSchedulesScheduledForDeletion !== null) {
                if (!$this->logEditeMacroSchedulesScheduledForDeletion->isEmpty()) {
                    \LogEditeMacroScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logEditeMacroSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logEditeMacroSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLogEditeMacroSchedules !== null) {
                foreach ($this->collLogEditeMacroSchedules as $referrerFK) {
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

        $this->modifiedColumns[LogTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LogTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('log_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LogTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(LogTableMap::COL_LOGTIME)) {
            $modifiedColumns[':p' . $index++]  = 'logtime';
        }
        if ($this->isColumnModified(LogTableMap::COL_USUARIO_ID)) {
            $modifiedColumns[':p' . $index++]  = 'usuario_id';
        }

        $sql = sprintf(
            'INSERT INTO log (%s) VALUES (%s)',
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
                    case 'logtime':
                        $stmt->bindValue($identifier, $this->logtime, PDO::PARAM_STR);
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
        $pos = LogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getLogtime();
                break;
            case 2:
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

        if (isset($alreadyDumpedObjects['Log'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Log'][$this->hashCode()] = true;
        $keys = LogTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLogtime(),
            $keys[2] => $this->getUsuarioId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collLogDeleteGrupoSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logDeleteGrupoSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_delete_grupo_schedules';
                        break;
                    default:
                        $key = 'LogDeleteGrupoSchedules';
                }

                $result[$key] = $this->collLogDeleteGrupoSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collLogDeleteMacroSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logDeleteMacroSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_delete_macro_schedules';
                        break;
                    default:
                        $key = 'LogDeleteMacroSchedules';
                }

                $result[$key] = $this->collLogDeleteMacroSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collLogEditeGrupoSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logEditeGrupoSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_edite_grupo_schedules';
                        break;
                    default:
                        $key = 'LogEditeGrupoSchedules';
                }

                $result[$key] = $this->collLogEditeGrupoSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLogEditeMacroSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logEditeMacroSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_edite_macro_schedules';
                        break;
                    default:
                        $key = 'LogEditeMacroSchedules';
                }

                $result[$key] = $this->collLogEditeMacroSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Log
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Log
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setLogtime($value);
                break;
            case 2:
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
     * @return     $this|\Log
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = LogTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLogtime($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUsuarioId($arr[$keys[2]]);
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
     * @return $this|\Log The current object, for fluid interface
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
        $criteria = new Criteria(LogTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LogTableMap::COL_ID)) {
            $criteria->add(LogTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(LogTableMap::COL_LOGTIME)) {
            $criteria->add(LogTableMap::COL_LOGTIME, $this->logtime);
        }
        if ($this->isColumnModified(LogTableMap::COL_USUARIO_ID)) {
            $criteria->add(LogTableMap::COL_USUARIO_ID, $this->usuario_id);
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
        $criteria = ChildLogQuery::create();
        $criteria->add(LogTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Log (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLogtime($this->getLogtime());
        $copyObj->setUsuarioId($this->getUsuarioId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLogDeleteGrupoSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogDeleteGrupoSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogDeleteHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogDeleteHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogDeleteMacroSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogDeleteMacroSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditeGrupoSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditeGrupoSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditeMacroSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditeMacroSchedule($relObj->copy($deepCopy));
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
     * @return \Log Clone of current object.
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
     * Declares an association between this object and a ChildUsuario object.
     *
     * @param  ChildUsuario $v
     * @return $this|\Log The current object (for fluent API support)
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
            $v->addLog($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsuario object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsuario The associated ChildUsuario object.
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
                $this->aUsuario->addLogs($this);
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
        if ('LogDeleteGrupoSchedule' === $relationName) {
            $this->initLogDeleteGrupoSchedules();
            return;
        }
        if ('LogDeleteHostSchedule' === $relationName) {
            $this->initLogDeleteHostSchedules();
            return;
        }
        if ('LogDeleteMacroSchedule' === $relationName) {
            $this->initLogDeleteMacroSchedules();
            return;
        }
        if ('LogEditHostSchedule' === $relationName) {
            $this->initLogEditHostSchedules();
            return;
        }
        if ('LogEditeGrupoSchedule' === $relationName) {
            $this->initLogEditeGrupoSchedules();
            return;
        }
        if ('LogEditeMacroSchedule' === $relationName) {
            $this->initLogEditeMacroSchedules();
            return;
        }
    }

    /**
     * Clears out the collLogDeleteGrupoSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogDeleteGrupoSchedules()
     */
    public function clearLogDeleteGrupoSchedules()
    {
        $this->collLogDeleteGrupoSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogDeleteGrupoSchedules collection loaded partially.
     */
    public function resetPartialLogDeleteGrupoSchedules($v = true)
    {
        $this->collLogDeleteGrupoSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogDeleteGrupoSchedules collection.
     *
     * By default this just sets the collLogDeleteGrupoSchedules collection to an empty array (like clearcollLogDeleteGrupoSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogDeleteGrupoSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogDeleteGrupoSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogDeleteGrupoScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogDeleteGrupoSchedules = new $collectionClassName;
        $this->collLogDeleteGrupoSchedules->setModel('\LogDeleteGrupoSchedule');
    }

    /**
     * Gets an array of ChildLogDeleteGrupoSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogDeleteGrupoSchedule[] List of ChildLogDeleteGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteGrupoSchedule> List of ChildLogDeleteGrupoSchedule objects
     * @throws PropelException
     */
    public function getLogDeleteGrupoSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogDeleteGrupoSchedules) {
                    $this->initLogDeleteGrupoSchedules();
                } else {
                    $collectionClassName = LogDeleteGrupoScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogDeleteGrupoSchedules = new $collectionClassName;
                    $collLogDeleteGrupoSchedules->setModel('\LogDeleteGrupoSchedule');

                    return $collLogDeleteGrupoSchedules;
                }
            } else {
                $collLogDeleteGrupoSchedules = ChildLogDeleteGrupoScheduleQuery::create(null, $criteria)
                    ->filterByLog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogDeleteGrupoSchedulesPartial && count($collLogDeleteGrupoSchedules)) {
                        $this->initLogDeleteGrupoSchedules(false);

                        foreach ($collLogDeleteGrupoSchedules as $obj) {
                            if (false == $this->collLogDeleteGrupoSchedules->contains($obj)) {
                                $this->collLogDeleteGrupoSchedules->append($obj);
                            }
                        }

                        $this->collLogDeleteGrupoSchedulesPartial = true;
                    }

                    return $collLogDeleteGrupoSchedules;
                }

                if ($partial && $this->collLogDeleteGrupoSchedules) {
                    foreach ($this->collLogDeleteGrupoSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogDeleteGrupoSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogDeleteGrupoSchedules = $collLogDeleteGrupoSchedules;
                $this->collLogDeleteGrupoSchedulesPartial = false;
            }
        }

        return $this->collLogDeleteGrupoSchedules;
    }

    /**
     * Sets a collection of ChildLogDeleteGrupoSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logDeleteGrupoSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogDeleteGrupoSchedules(Collection $logDeleteGrupoSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogDeleteGrupoSchedule[] $logDeleteGrupoSchedulesToDelete */
        $logDeleteGrupoSchedulesToDelete = $this->getLogDeleteGrupoSchedules(new Criteria(), $con)->diff($logDeleteGrupoSchedules);


        $this->logDeleteGrupoSchedulesScheduledForDeletion = $logDeleteGrupoSchedulesToDelete;

        foreach ($logDeleteGrupoSchedulesToDelete as $logDeleteGrupoScheduleRemoved) {
            $logDeleteGrupoScheduleRemoved->setLog(null);
        }

        $this->collLogDeleteGrupoSchedules = null;
        foreach ($logDeleteGrupoSchedules as $logDeleteGrupoSchedule) {
            $this->addLogDeleteGrupoSchedule($logDeleteGrupoSchedule);
        }

        $this->collLogDeleteGrupoSchedules = $logDeleteGrupoSchedules;
        $this->collLogDeleteGrupoSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogDeleteGrupoSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogDeleteGrupoSchedule objects.
     * @throws PropelException
     */
    public function countLogDeleteGrupoSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogDeleteGrupoSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogDeleteGrupoSchedules());
            }

            $query = ChildLogDeleteGrupoScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogDeleteGrupoSchedules);
    }

    /**
     * Method called to associate a ChildLogDeleteGrupoSchedule object to this object
     * through the ChildLogDeleteGrupoSchedule foreign key attribute.
     *
     * @param  ChildLogDeleteGrupoSchedule $l ChildLogDeleteGrupoSchedule
     * @return $this|\Log The current object (for fluent API support)
     */
    public function addLogDeleteGrupoSchedule(ChildLogDeleteGrupoSchedule $l)
    {
        if ($this->collLogDeleteGrupoSchedules === null) {
            $this->initLogDeleteGrupoSchedules();
            $this->collLogDeleteGrupoSchedulesPartial = true;
        }

        if (!$this->collLogDeleteGrupoSchedules->contains($l)) {
            $this->doAddLogDeleteGrupoSchedule($l);

            if ($this->logDeleteGrupoSchedulesScheduledForDeletion and $this->logDeleteGrupoSchedulesScheduledForDeletion->contains($l)) {
                $this->logDeleteGrupoSchedulesScheduledForDeletion->remove($this->logDeleteGrupoSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogDeleteGrupoSchedule $logDeleteGrupoSchedule The ChildLogDeleteGrupoSchedule object to add.
     */
    protected function doAddLogDeleteGrupoSchedule(ChildLogDeleteGrupoSchedule $logDeleteGrupoSchedule)
    {
        $this->collLogDeleteGrupoSchedules[]= $logDeleteGrupoSchedule;
        $logDeleteGrupoSchedule->setLog($this);
    }

    /**
     * @param  ChildLogDeleteGrupoSchedule $logDeleteGrupoSchedule The ChildLogDeleteGrupoSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function removeLogDeleteGrupoSchedule(ChildLogDeleteGrupoSchedule $logDeleteGrupoSchedule)
    {
        if ($this->getLogDeleteGrupoSchedules()->contains($logDeleteGrupoSchedule)) {
            $pos = $this->collLogDeleteGrupoSchedules->search($logDeleteGrupoSchedule);
            $this->collLogDeleteGrupoSchedules->remove($pos);
            if (null === $this->logDeleteGrupoSchedulesScheduledForDeletion) {
                $this->logDeleteGrupoSchedulesScheduledForDeletion = clone $this->collLogDeleteGrupoSchedules;
                $this->logDeleteGrupoSchedulesScheduledForDeletion->clear();
            }
            $this->logDeleteGrupoSchedulesScheduledForDeletion[]= clone $logDeleteGrupoSchedule;
            $logDeleteGrupoSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogDeleteGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogDeleteGrupoSchedule[] List of ChildLogDeleteGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteGrupoSchedule}> List of ChildLogDeleteGrupoSchedule objects
     */
    public function getLogDeleteGrupoSchedulesJoinGrupoSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogDeleteGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('GrupoSchedule', $joinBehavior);

        return $this->getLogDeleteGrupoSchedules($query, $con);
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
     * If this ChildLog is new, it will return
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
                    ->filterByLog($this)
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
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogDeleteHostSchedules(Collection $logDeleteHostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogDeleteHostSchedule[] $logDeleteHostSchedulesToDelete */
        $logDeleteHostSchedulesToDelete = $this->getLogDeleteHostSchedules(new Criteria(), $con)->diff($logDeleteHostSchedules);


        $this->logDeleteHostSchedulesScheduledForDeletion = $logDeleteHostSchedulesToDelete;

        foreach ($logDeleteHostSchedulesToDelete as $logDeleteHostScheduleRemoved) {
            $logDeleteHostScheduleRemoved->setLog(null);
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
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogDeleteHostSchedules);
    }

    /**
     * Method called to associate a ChildLogDeleteHostSchedule object to this object
     * through the ChildLogDeleteHostSchedule foreign key attribute.
     *
     * @param  ChildLogDeleteHostSchedule $l ChildLogDeleteHostSchedule
     * @return $this|\Log The current object (for fluent API support)
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
        $logDeleteHostSchedule->setLog($this);
    }

    /**
     * @param  ChildLogDeleteHostSchedule $logDeleteHostSchedule The ChildLogDeleteHostSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
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
            $logDeleteHostSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogDeleteHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogDeleteHostSchedule[] List of ChildLogDeleteHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteHostSchedule}> List of ChildLogDeleteHostSchedule objects
     */
    public function getLogDeleteHostSchedulesJoinHostSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogDeleteHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostSchedule', $joinBehavior);

        return $this->getLogDeleteHostSchedules($query, $con);
    }

    /**
     * Clears out the collLogDeleteMacroSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogDeleteMacroSchedules()
     */
    public function clearLogDeleteMacroSchedules()
    {
        $this->collLogDeleteMacroSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogDeleteMacroSchedules collection loaded partially.
     */
    public function resetPartialLogDeleteMacroSchedules($v = true)
    {
        $this->collLogDeleteMacroSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogDeleteMacroSchedules collection.
     *
     * By default this just sets the collLogDeleteMacroSchedules collection to an empty array (like clearcollLogDeleteMacroSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogDeleteMacroSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogDeleteMacroSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogDeleteMacroScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogDeleteMacroSchedules = new $collectionClassName;
        $this->collLogDeleteMacroSchedules->setModel('\LogDeleteMacroSchedule');
    }

    /**
     * Gets an array of ChildLogDeleteMacroSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogDeleteMacroSchedule[] List of ChildLogDeleteMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule> List of ChildLogDeleteMacroSchedule objects
     * @throws PropelException
     */
    public function getLogDeleteMacroSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogDeleteMacroSchedules) {
                    $this->initLogDeleteMacroSchedules();
                } else {
                    $collectionClassName = LogDeleteMacroScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogDeleteMacroSchedules = new $collectionClassName;
                    $collLogDeleteMacroSchedules->setModel('\LogDeleteMacroSchedule');

                    return $collLogDeleteMacroSchedules;
                }
            } else {
                $collLogDeleteMacroSchedules = ChildLogDeleteMacroScheduleQuery::create(null, $criteria)
                    ->filterByLog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogDeleteMacroSchedulesPartial && count($collLogDeleteMacroSchedules)) {
                        $this->initLogDeleteMacroSchedules(false);

                        foreach ($collLogDeleteMacroSchedules as $obj) {
                            if (false == $this->collLogDeleteMacroSchedules->contains($obj)) {
                                $this->collLogDeleteMacroSchedules->append($obj);
                            }
                        }

                        $this->collLogDeleteMacroSchedulesPartial = true;
                    }

                    return $collLogDeleteMacroSchedules;
                }

                if ($partial && $this->collLogDeleteMacroSchedules) {
                    foreach ($this->collLogDeleteMacroSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogDeleteMacroSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogDeleteMacroSchedules = $collLogDeleteMacroSchedules;
                $this->collLogDeleteMacroSchedulesPartial = false;
            }
        }

        return $this->collLogDeleteMacroSchedules;
    }

    /**
     * Sets a collection of ChildLogDeleteMacroSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logDeleteMacroSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogDeleteMacroSchedules(Collection $logDeleteMacroSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogDeleteMacroSchedule[] $logDeleteMacroSchedulesToDelete */
        $logDeleteMacroSchedulesToDelete = $this->getLogDeleteMacroSchedules(new Criteria(), $con)->diff($logDeleteMacroSchedules);


        $this->logDeleteMacroSchedulesScheduledForDeletion = $logDeleteMacroSchedulesToDelete;

        foreach ($logDeleteMacroSchedulesToDelete as $logDeleteMacroScheduleRemoved) {
            $logDeleteMacroScheduleRemoved->setLog(null);
        }

        $this->collLogDeleteMacroSchedules = null;
        foreach ($logDeleteMacroSchedules as $logDeleteMacroSchedule) {
            $this->addLogDeleteMacroSchedule($logDeleteMacroSchedule);
        }

        $this->collLogDeleteMacroSchedules = $logDeleteMacroSchedules;
        $this->collLogDeleteMacroSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogDeleteMacroSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogDeleteMacroSchedule objects.
     * @throws PropelException
     */
    public function countLogDeleteMacroSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogDeleteMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collLogDeleteMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogDeleteMacroSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogDeleteMacroSchedules());
            }

            $query = ChildLogDeleteMacroScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogDeleteMacroSchedules);
    }

    /**
     * Method called to associate a ChildLogDeleteMacroSchedule object to this object
     * through the ChildLogDeleteMacroSchedule foreign key attribute.
     *
     * @param  ChildLogDeleteMacroSchedule $l ChildLogDeleteMacroSchedule
     * @return $this|\Log The current object (for fluent API support)
     */
    public function addLogDeleteMacroSchedule(ChildLogDeleteMacroSchedule $l)
    {
        if ($this->collLogDeleteMacroSchedules === null) {
            $this->initLogDeleteMacroSchedules();
            $this->collLogDeleteMacroSchedulesPartial = true;
        }

        if (!$this->collLogDeleteMacroSchedules->contains($l)) {
            $this->doAddLogDeleteMacroSchedule($l);

            if ($this->logDeleteMacroSchedulesScheduledForDeletion and $this->logDeleteMacroSchedulesScheduledForDeletion->contains($l)) {
                $this->logDeleteMacroSchedulesScheduledForDeletion->remove($this->logDeleteMacroSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogDeleteMacroSchedule $logDeleteMacroSchedule The ChildLogDeleteMacroSchedule object to add.
     */
    protected function doAddLogDeleteMacroSchedule(ChildLogDeleteMacroSchedule $logDeleteMacroSchedule)
    {
        $this->collLogDeleteMacroSchedules[]= $logDeleteMacroSchedule;
        $logDeleteMacroSchedule->setLog($this);
    }

    /**
     * @param  ChildLogDeleteMacroSchedule $logDeleteMacroSchedule The ChildLogDeleteMacroSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function removeLogDeleteMacroSchedule(ChildLogDeleteMacroSchedule $logDeleteMacroSchedule)
    {
        if ($this->getLogDeleteMacroSchedules()->contains($logDeleteMacroSchedule)) {
            $pos = $this->collLogDeleteMacroSchedules->search($logDeleteMacroSchedule);
            $this->collLogDeleteMacroSchedules->remove($pos);
            if (null === $this->logDeleteMacroSchedulesScheduledForDeletion) {
                $this->logDeleteMacroSchedulesScheduledForDeletion = clone $this->collLogDeleteMacroSchedules;
                $this->logDeleteMacroSchedulesScheduledForDeletion->clear();
            }
            $this->logDeleteMacroSchedulesScheduledForDeletion[]= clone $logDeleteMacroSchedule;
            $logDeleteMacroSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogDeleteMacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogDeleteMacroSchedule[] List of ChildLogDeleteMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteMacroSchedule}> List of ChildLogDeleteMacroSchedule objects
     */
    public function getLogDeleteMacroSchedulesJoinMacroSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogDeleteMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('MacroSchedule', $joinBehavior);

        return $this->getLogDeleteMacroSchedules($query, $con);
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
     * If this ChildLog is new, it will return
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
                    ->filterByLog($this)
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
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogEditHostSchedules(Collection $logEditHostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditHostSchedule[] $logEditHostSchedulesToDelete */
        $logEditHostSchedulesToDelete = $this->getLogEditHostSchedules(new Criteria(), $con)->diff($logEditHostSchedules);


        $this->logEditHostSchedulesScheduledForDeletion = $logEditHostSchedulesToDelete;

        foreach ($logEditHostSchedulesToDelete as $logEditHostScheduleRemoved) {
            $logEditHostScheduleRemoved->setLog(null);
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
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogEditHostSchedules);
    }

    /**
     * Method called to associate a ChildLogEditHostSchedule object to this object
     * through the ChildLogEditHostSchedule foreign key attribute.
     *
     * @param  ChildLogEditHostSchedule $l ChildLogEditHostSchedule
     * @return $this|\Log The current object (for fluent API support)
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
        $logEditHostSchedule->setLog($this);
    }

    /**
     * @param  ChildLogEditHostSchedule $logEditHostSchedule The ChildLogEditHostSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
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
            $logEditHostSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesJoinHostSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostSchedule', $joinBehavior);

        return $this->getLogEditHostSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
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
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditHostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
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
     * Clears out the collLogEditeGrupoSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogEditeGrupoSchedules()
     */
    public function clearLogEditeGrupoSchedules()
    {
        $this->collLogEditeGrupoSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogEditeGrupoSchedules collection loaded partially.
     */
    public function resetPartialLogEditeGrupoSchedules($v = true)
    {
        $this->collLogEditeGrupoSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogEditeGrupoSchedules collection.
     *
     * By default this just sets the collLogEditeGrupoSchedules collection to an empty array (like clearcollLogEditeGrupoSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogEditeGrupoSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogEditeGrupoSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogEditeGrupoScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogEditeGrupoSchedules = new $collectionClassName;
        $this->collLogEditeGrupoSchedules->setModel('\LogEditeGrupoSchedule');
    }

    /**
     * Gets an array of ChildLogEditeGrupoSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogEditeGrupoSchedule[] List of ChildLogEditeGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> List of ChildLogEditeGrupoSchedule objects
     * @throws PropelException
     */
    public function getLogEditeGrupoSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditeGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditeGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogEditeGrupoSchedules) {
                    $this->initLogEditeGrupoSchedules();
                } else {
                    $collectionClassName = LogEditeGrupoScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogEditeGrupoSchedules = new $collectionClassName;
                    $collLogEditeGrupoSchedules->setModel('\LogEditeGrupoSchedule');

                    return $collLogEditeGrupoSchedules;
                }
            } else {
                $collLogEditeGrupoSchedules = ChildLogEditeGrupoScheduleQuery::create(null, $criteria)
                    ->filterByLog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogEditeGrupoSchedulesPartial && count($collLogEditeGrupoSchedules)) {
                        $this->initLogEditeGrupoSchedules(false);

                        foreach ($collLogEditeGrupoSchedules as $obj) {
                            if (false == $this->collLogEditeGrupoSchedules->contains($obj)) {
                                $this->collLogEditeGrupoSchedules->append($obj);
                            }
                        }

                        $this->collLogEditeGrupoSchedulesPartial = true;
                    }

                    return $collLogEditeGrupoSchedules;
                }

                if ($partial && $this->collLogEditeGrupoSchedules) {
                    foreach ($this->collLogEditeGrupoSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogEditeGrupoSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogEditeGrupoSchedules = $collLogEditeGrupoSchedules;
                $this->collLogEditeGrupoSchedulesPartial = false;
            }
        }

        return $this->collLogEditeGrupoSchedules;
    }

    /**
     * Sets a collection of ChildLogEditeGrupoSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logEditeGrupoSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogEditeGrupoSchedules(Collection $logEditeGrupoSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditeGrupoSchedule[] $logEditeGrupoSchedulesToDelete */
        $logEditeGrupoSchedulesToDelete = $this->getLogEditeGrupoSchedules(new Criteria(), $con)->diff($logEditeGrupoSchedules);


        $this->logEditeGrupoSchedulesScheduledForDeletion = $logEditeGrupoSchedulesToDelete;

        foreach ($logEditeGrupoSchedulesToDelete as $logEditeGrupoScheduleRemoved) {
            $logEditeGrupoScheduleRemoved->setLog(null);
        }

        $this->collLogEditeGrupoSchedules = null;
        foreach ($logEditeGrupoSchedules as $logEditeGrupoSchedule) {
            $this->addLogEditeGrupoSchedule($logEditeGrupoSchedule);
        }

        $this->collLogEditeGrupoSchedules = $logEditeGrupoSchedules;
        $this->collLogEditeGrupoSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogEditeGrupoSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogEditeGrupoSchedule objects.
     * @throws PropelException
     */
    public function countLogEditeGrupoSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditeGrupoSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditeGrupoSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogEditeGrupoSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogEditeGrupoSchedules());
            }

            $query = ChildLogEditeGrupoScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogEditeGrupoSchedules);
    }

    /**
     * Method called to associate a ChildLogEditeGrupoSchedule object to this object
     * through the ChildLogEditeGrupoSchedule foreign key attribute.
     *
     * @param  ChildLogEditeGrupoSchedule $l ChildLogEditeGrupoSchedule
     * @return $this|\Log The current object (for fluent API support)
     */
    public function addLogEditeGrupoSchedule(ChildLogEditeGrupoSchedule $l)
    {
        if ($this->collLogEditeGrupoSchedules === null) {
            $this->initLogEditeGrupoSchedules();
            $this->collLogEditeGrupoSchedulesPartial = true;
        }

        if (!$this->collLogEditeGrupoSchedules->contains($l)) {
            $this->doAddLogEditeGrupoSchedule($l);

            if ($this->logEditeGrupoSchedulesScheduledForDeletion and $this->logEditeGrupoSchedulesScheduledForDeletion->contains($l)) {
                $this->logEditeGrupoSchedulesScheduledForDeletion->remove($this->logEditeGrupoSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogEditeGrupoSchedule $logEditeGrupoSchedule The ChildLogEditeGrupoSchedule object to add.
     */
    protected function doAddLogEditeGrupoSchedule(ChildLogEditeGrupoSchedule $logEditeGrupoSchedule)
    {
        $this->collLogEditeGrupoSchedules[]= $logEditeGrupoSchedule;
        $logEditeGrupoSchedule->setLog($this);
    }

    /**
     * @param  ChildLogEditeGrupoSchedule $logEditeGrupoSchedule The ChildLogEditeGrupoSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function removeLogEditeGrupoSchedule(ChildLogEditeGrupoSchedule $logEditeGrupoSchedule)
    {
        if ($this->getLogEditeGrupoSchedules()->contains($logEditeGrupoSchedule)) {
            $pos = $this->collLogEditeGrupoSchedules->search($logEditeGrupoSchedule);
            $this->collLogEditeGrupoSchedules->remove($pos);
            if (null === $this->logEditeGrupoSchedulesScheduledForDeletion) {
                $this->logEditeGrupoSchedulesScheduledForDeletion = clone $this->collLogEditeGrupoSchedules;
                $this->logEditeGrupoSchedulesScheduledForDeletion->clear();
            }
            $this->logEditeGrupoSchedulesScheduledForDeletion[]= clone $logEditeGrupoSchedule;
            $logEditeGrupoSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditeGrupoSchedule[] List of ChildLogEditeGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule}> List of ChildLogEditeGrupoSchedule objects
     */
    public function getLogEditeGrupoSchedulesJoinGrupoSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditeGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('GrupoSchedule', $joinBehavior);

        return $this->getLogEditeGrupoSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditeGrupoSchedule[] List of ChildLogEditeGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule}> List of ChildLogEditeGrupoSchedule objects
     */
    public function getLogEditeGrupoSchedulesJoinGrupoRelatedByNewGrupoId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditeGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('GrupoRelatedByNewGrupoId', $joinBehavior);

        return $this->getLogEditeGrupoSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditeGrupoSchedule[] List of ChildLogEditeGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule}> List of ChildLogEditeGrupoSchedule objects
     */
    public function getLogEditeGrupoSchedulesJoinGrupoRelatedByOldGrupoId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditeGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('GrupoRelatedByOldGrupoId', $joinBehavior);

        return $this->getLogEditeGrupoSchedules($query, $con);
    }

    /**
     * Clears out the collLogEditeMacroSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogEditeMacroSchedules()
     */
    public function clearLogEditeMacroSchedules()
    {
        $this->collLogEditeMacroSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogEditeMacroSchedules collection loaded partially.
     */
    public function resetPartialLogEditeMacroSchedules($v = true)
    {
        $this->collLogEditeMacroSchedulesPartial = $v;
    }

    /**
     * Initializes the collLogEditeMacroSchedules collection.
     *
     * By default this just sets the collLogEditeMacroSchedules collection to an empty array (like clearcollLogEditeMacroSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogEditeMacroSchedules($overrideExisting = true)
    {
        if (null !== $this->collLogEditeMacroSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogEditeMacroScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogEditeMacroSchedules = new $collectionClassName;
        $this->collLogEditeMacroSchedules->setModel('\LogEditeMacroSchedule');
    }

    /**
     * Gets an array of ChildLogEditeMacroSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogEditeMacroSchedule[] List of ChildLogEditeMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeMacroSchedule> List of ChildLogEditeMacroSchedule objects
     * @throws PropelException
     */
    public function getLogEditeMacroSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditeMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditeMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogEditeMacroSchedules) {
                    $this->initLogEditeMacroSchedules();
                } else {
                    $collectionClassName = LogEditeMacroScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogEditeMacroSchedules = new $collectionClassName;
                    $collLogEditeMacroSchedules->setModel('\LogEditeMacroSchedule');

                    return $collLogEditeMacroSchedules;
                }
            } else {
                $collLogEditeMacroSchedules = ChildLogEditeMacroScheduleQuery::create(null, $criteria)
                    ->filterByLog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogEditeMacroSchedulesPartial && count($collLogEditeMacroSchedules)) {
                        $this->initLogEditeMacroSchedules(false);

                        foreach ($collLogEditeMacroSchedules as $obj) {
                            if (false == $this->collLogEditeMacroSchedules->contains($obj)) {
                                $this->collLogEditeMacroSchedules->append($obj);
                            }
                        }

                        $this->collLogEditeMacroSchedulesPartial = true;
                    }

                    return $collLogEditeMacroSchedules;
                }

                if ($partial && $this->collLogEditeMacroSchedules) {
                    foreach ($this->collLogEditeMacroSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLogEditeMacroSchedules[] = $obj;
                        }
                    }
                }

                $this->collLogEditeMacroSchedules = $collLogEditeMacroSchedules;
                $this->collLogEditeMacroSchedulesPartial = false;
            }
        }

        return $this->collLogEditeMacroSchedules;
    }

    /**
     * Sets a collection of ChildLogEditeMacroSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logEditeMacroSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function setLogEditeMacroSchedules(Collection $logEditeMacroSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditeMacroSchedule[] $logEditeMacroSchedulesToDelete */
        $logEditeMacroSchedulesToDelete = $this->getLogEditeMacroSchedules(new Criteria(), $con)->diff($logEditeMacroSchedules);


        $this->logEditeMacroSchedulesScheduledForDeletion = $logEditeMacroSchedulesToDelete;

        foreach ($logEditeMacroSchedulesToDelete as $logEditeMacroScheduleRemoved) {
            $logEditeMacroScheduleRemoved->setLog(null);
        }

        $this->collLogEditeMacroSchedules = null;
        foreach ($logEditeMacroSchedules as $logEditeMacroSchedule) {
            $this->addLogEditeMacroSchedule($logEditeMacroSchedule);
        }

        $this->collLogEditeMacroSchedules = $logEditeMacroSchedules;
        $this->collLogEditeMacroSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogEditeMacroSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogEditeMacroSchedule objects.
     * @throws PropelException
     */
    public function countLogEditeMacroSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditeMacroSchedulesPartial && !$this->isNew();
        if (null === $this->collLogEditeMacroSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogEditeMacroSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogEditeMacroSchedules());
            }

            $query = ChildLogEditeMacroScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLog($this)
                ->count($con);
        }

        return count($this->collLogEditeMacroSchedules);
    }

    /**
     * Method called to associate a ChildLogEditeMacroSchedule object to this object
     * through the ChildLogEditeMacroSchedule foreign key attribute.
     *
     * @param  ChildLogEditeMacroSchedule $l ChildLogEditeMacroSchedule
     * @return $this|\Log The current object (for fluent API support)
     */
    public function addLogEditeMacroSchedule(ChildLogEditeMacroSchedule $l)
    {
        if ($this->collLogEditeMacroSchedules === null) {
            $this->initLogEditeMacroSchedules();
            $this->collLogEditeMacroSchedulesPartial = true;
        }

        if (!$this->collLogEditeMacroSchedules->contains($l)) {
            $this->doAddLogEditeMacroSchedule($l);

            if ($this->logEditeMacroSchedulesScheduledForDeletion and $this->logEditeMacroSchedulesScheduledForDeletion->contains($l)) {
                $this->logEditeMacroSchedulesScheduledForDeletion->remove($this->logEditeMacroSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogEditeMacroSchedule $logEditeMacroSchedule The ChildLogEditeMacroSchedule object to add.
     */
    protected function doAddLogEditeMacroSchedule(ChildLogEditeMacroSchedule $logEditeMacroSchedule)
    {
        $this->collLogEditeMacroSchedules[]= $logEditeMacroSchedule;
        $logEditeMacroSchedule->setLog($this);
    }

    /**
     * @param  ChildLogEditeMacroSchedule $logEditeMacroSchedule The ChildLogEditeMacroSchedule object to remove.
     * @return $this|ChildLog The current object (for fluent API support)
     */
    public function removeLogEditeMacroSchedule(ChildLogEditeMacroSchedule $logEditeMacroSchedule)
    {
        if ($this->getLogEditeMacroSchedules()->contains($logEditeMacroSchedule)) {
            $pos = $this->collLogEditeMacroSchedules->search($logEditeMacroSchedule);
            $this->collLogEditeMacroSchedules->remove($pos);
            if (null === $this->logEditeMacroSchedulesScheduledForDeletion) {
                $this->logEditeMacroSchedulesScheduledForDeletion = clone $this->collLogEditeMacroSchedules;
                $this->logEditeMacroSchedulesScheduledForDeletion->clear();
            }
            $this->logEditeMacroSchedulesScheduledForDeletion[]= clone $logEditeMacroSchedule;
            $logEditeMacroSchedule->setLog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Log is new, it will return
     * an empty collection; or if this Log has previously
     * been saved, it will retrieve related LogEditeMacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Log.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditeMacroSchedule[] List of ChildLogEditeMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeMacroSchedule}> List of ChildLogEditeMacroSchedule objects
     */
    public function getLogEditeMacroSchedulesJoinMacroSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditeMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('MacroSchedule', $joinBehavior);

        return $this->getLogEditeMacroSchedules($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUsuario) {
            $this->aUsuario->removeLog($this);
        }
        $this->id = null;
        $this->logtime = null;
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
            if ($this->collLogDeleteGrupoSchedules) {
                foreach ($this->collLogDeleteGrupoSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogDeleteHostSchedules) {
                foreach ($this->collLogDeleteHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogDeleteMacroSchedules) {
                foreach ($this->collLogDeleteMacroSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditHostSchedules) {
                foreach ($this->collLogEditHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditeGrupoSchedules) {
                foreach ($this->collLogEditeGrupoSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditeMacroSchedules) {
                foreach ($this->collLogEditeMacroSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLogDeleteGrupoSchedules = null;
        $this->collLogDeleteHostSchedules = null;
        $this->collLogDeleteMacroSchedules = null;
        $this->collLogEditHostSchedules = null;
        $this->collLogEditeGrupoSchedules = null;
        $this->collLogEditeMacroSchedules = null;
        $this->aUsuario = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LogTableMap::DEFAULT_STRING_FORMAT);
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
