<?php

namespace Base;

use \Grupo as ChildGrupo;
use \GrupoQuery as ChildGrupoQuery;
use \GrupoSchedule as ChildGrupoSchedule;
use \GrupoScheduleQuery as ChildGrupoScheduleQuery;
use \LogDeleteGrupoSchedule as ChildLogDeleteGrupoSchedule;
use \LogDeleteGrupoScheduleQuery as ChildLogDeleteGrupoScheduleQuery;
use \LogEditeGrupoSchedule as ChildLogEditeGrupoSchedule;
use \LogEditeGrupoScheduleQuery as ChildLogEditeGrupoScheduleQuery;
use \LogGrupoExecution as ChildLogGrupoExecution;
use \LogGrupoExecutionQuery as ChildLogGrupoExecutionQuery;
use \Schedule as ChildSchedule;
use \ScheduleQuery as ChildScheduleQuery;
use \Usuario as ChildUsuario;
use \UsuarioQuery as ChildUsuarioQuery;
use \Exception;
use \PDO;
use Map\GrupoScheduleTableMap;
use Map\LogDeleteGrupoScheduleTableMap;
use Map\LogEditeGrupoScheduleTableMap;
use Map\LogGrupoExecutionTableMap;
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
 * Base class that represents a row from the 'grupo_schedule' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class GrupoSchedule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\GrupoScheduleTableMap';


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
     * The value for the schedule_id field.
     *
     * @var        int
     */
    protected $schedule_id;

    /**
     * The value for the usuario_id field.
     *
     * @var        int
     */
    protected $usuario_id;

    /**
     * The value for the grupo_id field.
     *
     * @var        int
     */
    protected $grupo_id;

    /**
     * The value for the scheduled field.
     *
     * @var        string
     */
    protected $scheduled;

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
     * @var        ChildGrupo
     */
    protected $aGrupo;

    /**
     * @var        ChildSchedule
     */
    protected $aSchedule;

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
     * @var        ObjectCollection|ChildLogEditeGrupoSchedule[] Collection to store aggregation of ChildLogEditeGrupoSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule> Collection to store aggregation of ChildLogEditeGrupoSchedule objects.
     */
    protected $collLogEditeGrupoSchedules;
    protected $collLogEditeGrupoSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogGrupoExecution[] Collection to store aggregation of ChildLogGrupoExecution objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogGrupoExecution> Collection to store aggregation of ChildLogGrupoExecution objects.
     */
    protected $collLogGrupoExecutions;
    protected $collLogGrupoExecutionsPartial;

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
     * @var ObjectCollection|ChildLogEditeGrupoSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule>
     */
    protected $logEditeGrupoSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogGrupoExecution[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogGrupoExecution>
     */
    protected $logGrupoExecutionsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\GrupoSchedule object.
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
     * Compares this with another <code>GrupoSchedule</code> instance.  If
     * <code>obj</code> is an instance of <code>GrupoSchedule</code>, delegates to
     * <code>equals(GrupoSchedule)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [schedule_id] column value.
     *
     * @return int
     */
    public function getScheduleId()
    {
        return $this->schedule_id;
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
     * Get the [grupo_id] column value.
     *
     * @return int
     */
    public function getGrupoId()
    {
        return $this->grupo_id;
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
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [schedule_id] column.
     *
     * @param int $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setScheduleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->schedule_id !== $v) {
            $this->schedule_id = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_SCHEDULE_ID] = true;
        }

        if ($this->aSchedule !== null && $this->aSchedule->getId() !== $v) {
            $this->aSchedule = null;
        }

        return $this;
    } // setScheduleId()

    /**
     * Set the value of [usuario_id] column.
     *
     * @param int $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setUsuarioId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usuario_id !== $v) {
            $this->usuario_id = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_USUARIO_ID] = true;
        }

        if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
            $this->aUsuario = null;
        }

        return $this;
    } // setUsuarioId()

    /**
     * Set the value of [grupo_id] column.
     *
     * @param int $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setGrupoId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->grupo_id !== $v) {
            $this->grupo_id = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_GRUPO_ID] = true;
        }

        if ($this->aGrupo !== null && $this->aGrupo->getId() !== $v) {
            $this->aGrupo = null;
        }

        return $this;
    } // setGrupoId()

    /**
     * Set the value of [scheduled] column.
     *
     * @param string $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setScheduled($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->scheduled !== $v) {
            $this->scheduled = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_SCHEDULED] = true;
        }

        return $this;
    } // setScheduled()

    /**
     * Set the value of [push_pop] column.
     *
     * @param string $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setPushPop($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->push_pop !== $v) {
            $this->push_pop = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_PUSH_POP] = true;
        }

        return $this;
    } // setPushPop()

    /**
     * Set the value of [enabled] column.
     *
     * @param string $v New value
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function setEnabled($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->enabled !== $v) {
            $this->enabled = $v;
            $this->modifiedColumns[GrupoScheduleTableMap::COL_ENABLED] = true;
        }

        return $this;
    } // setEnabled()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GrupoScheduleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GrupoScheduleTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GrupoScheduleTableMap::translateFieldName('ScheduleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->schedule_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GrupoScheduleTableMap::translateFieldName('UsuarioId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usuario_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GrupoScheduleTableMap::translateFieldName('GrupoId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grupo_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GrupoScheduleTableMap::translateFieldName('Scheduled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->scheduled = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GrupoScheduleTableMap::translateFieldName('PushPop', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_pop = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : GrupoScheduleTableMap::translateFieldName('Enabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enabled = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = GrupoScheduleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\GrupoSchedule'), 0, $e);
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
        if ($this->aUsuario !== null && $this->usuario_id !== $this->aUsuario->getId()) {
            $this->aUsuario = null;
        }
        if ($this->aGrupo !== null && $this->grupo_id !== $this->aGrupo->getId()) {
            $this->aGrupo = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGrupoScheduleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGrupo = null;
            $this->aSchedule = null;
            $this->aUsuario = null;
            $this->collLogDeleteGrupoSchedules = null;

            $this->collLogEditeGrupoSchedules = null;

            $this->collLogGrupoExecutions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see GrupoSchedule::setDeleted()
     * @see GrupoSchedule::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGrupoScheduleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GrupoScheduleTableMap::DATABASE_NAME);
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
                GrupoScheduleTableMap::addInstanceToPool($this);
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

            if ($this->aGrupo !== null) {
                if ($this->aGrupo->isModified() || $this->aGrupo->isNew()) {
                    $affectedRows += $this->aGrupo->save($con);
                }
                $this->setGrupo($this->aGrupo);
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

            if ($this->logGrupoExecutionsScheduledForDeletion !== null) {
                if (!$this->logGrupoExecutionsScheduledForDeletion->isEmpty()) {
                    \LogGrupoExecutionQuery::create()
                        ->filterByPrimaryKeys($this->logGrupoExecutionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logGrupoExecutionsScheduledForDeletion = null;
                }
            }

            if ($this->collLogGrupoExecutions !== null) {
                foreach ($this->collLogGrupoExecutions as $referrerFK) {
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

        $this->modifiedColumns[GrupoScheduleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GrupoScheduleTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('grupo_schedule_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_SCHEDULE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'schedule_id';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_USUARIO_ID)) {
            $modifiedColumns[':p' . $index++]  = 'usuario_id';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_GRUPO_ID)) {
            $modifiedColumns[':p' . $index++]  = 'grupo_id';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_SCHEDULED)) {
            $modifiedColumns[':p' . $index++]  = 'scheduled';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_PUSH_POP)) {
            $modifiedColumns[':p' . $index++]  = 'push_pop';
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'enabled';
        }

        $sql = sprintf(
            'INSERT INTO grupo_schedule (%s) VALUES (%s)',
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
                    case 'schedule_id':
                        $stmt->bindValue($identifier, $this->schedule_id, PDO::PARAM_INT);
                        break;
                    case 'usuario_id':
                        $stmt->bindValue($identifier, $this->usuario_id, PDO::PARAM_INT);
                        break;
                    case 'grupo_id':
                        $stmt->bindValue($identifier, $this->grupo_id, PDO::PARAM_INT);
                        break;
                    case 'scheduled':
                        $stmt->bindValue($identifier, $this->scheduled, PDO::PARAM_STR);
                        break;
                    case 'push_pop':
                        $stmt->bindValue($identifier, $this->push_pop, PDO::PARAM_STR);
                        break;
                    case 'enabled':
                        $stmt->bindValue($identifier, $this->enabled, PDO::PARAM_STR);
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
        $pos = GrupoScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getScheduleId();
                break;
            case 3:
                return $this->getUsuarioId();
                break;
            case 4:
                return $this->getGrupoId();
                break;
            case 5:
                return $this->getScheduled();
                break;
            case 6:
                return $this->getPushPop();
                break;
            case 7:
                return $this->getEnabled();
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

        if (isset($alreadyDumpedObjects['GrupoSchedule'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['GrupoSchedule'][$this->hashCode()] = true;
        $keys = GrupoScheduleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDescription(),
            $keys[2] => $this->getScheduleId(),
            $keys[3] => $this->getUsuarioId(),
            $keys[4] => $this->getGrupoId(),
            $keys[5] => $this->getScheduled(),
            $keys[6] => $this->getPushPop(),
            $keys[7] => $this->getEnabled(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGrupo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'grupo';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'grupo';
                        break;
                    default:
                        $key = 'Grupo';
                }

                $result[$key] = $this->aGrupo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collLogGrupoExecutions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'logGrupoExecutions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'log_grupo_executions';
                        break;
                    default:
                        $key = 'LogGrupoExecutions';
                }

                $result[$key] = $this->collLogGrupoExecutions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\GrupoSchedule
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = GrupoScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\GrupoSchedule
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
                $this->setScheduleId($value);
                break;
            case 3:
                $this->setUsuarioId($value);
                break;
            case 4:
                $this->setGrupoId($value);
                break;
            case 5:
                $this->setScheduled($value);
                break;
            case 6:
                $this->setPushPop($value);
                break;
            case 7:
                $this->setEnabled($value);
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
     * @return     $this|\GrupoSchedule
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = GrupoScheduleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDescription($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setScheduleId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUsuarioId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGrupoId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setScheduled($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPushPop($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEnabled($arr[$keys[7]]);
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
     * @return $this|\GrupoSchedule The current object, for fluid interface
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
        $criteria = new Criteria(GrupoScheduleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GrupoScheduleTableMap::COL_ID)) {
            $criteria->add(GrupoScheduleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_DESCRIPTION)) {
            $criteria->add(GrupoScheduleTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_SCHEDULE_ID)) {
            $criteria->add(GrupoScheduleTableMap::COL_SCHEDULE_ID, $this->schedule_id);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_USUARIO_ID)) {
            $criteria->add(GrupoScheduleTableMap::COL_USUARIO_ID, $this->usuario_id);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_GRUPO_ID)) {
            $criteria->add(GrupoScheduleTableMap::COL_GRUPO_ID, $this->grupo_id);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_SCHEDULED)) {
            $criteria->add(GrupoScheduleTableMap::COL_SCHEDULED, $this->scheduled);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_PUSH_POP)) {
            $criteria->add(GrupoScheduleTableMap::COL_PUSH_POP, $this->push_pop);
        }
        if ($this->isColumnModified(GrupoScheduleTableMap::COL_ENABLED)) {
            $criteria->add(GrupoScheduleTableMap::COL_ENABLED, $this->enabled);
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
        $criteria = ChildGrupoScheduleQuery::create();
        $criteria->add(GrupoScheduleTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \GrupoSchedule (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDescription($this->getDescription());
        $copyObj->setScheduleId($this->getScheduleId());
        $copyObj->setUsuarioId($this->getUsuarioId());
        $copyObj->setGrupoId($this->getGrupoId());
        $copyObj->setScheduled($this->getScheduled());
        $copyObj->setPushPop($this->getPushPop());
        $copyObj->setEnabled($this->getEnabled());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLogDeleteGrupoSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogDeleteGrupoSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditeGrupoSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditeGrupoSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogGrupoExecutions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogGrupoExecution($relObj->copy($deepCopy));
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
     * @return \GrupoSchedule Clone of current object.
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
     * Declares an association between this object and a ChildGrupo object.
     *
     * @param  ChildGrupo $v
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGrupo(ChildGrupo $v = null)
    {
        if ($v === null) {
            $this->setGrupoId(NULL);
        } else {
            $this->setGrupoId($v->getId());
        }

        $this->aGrupo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGrupo object, it will not be re-added.
        if ($v !== null) {
            $v->addGrupoSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGrupo object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildGrupo The associated ChildGrupo object.
     * @throws PropelException
     */
    public function getGrupo(ConnectionInterface $con = null)
    {
        if ($this->aGrupo === null && ($this->grupo_id != 0)) {
            $this->aGrupo = ChildGrupoQuery::create()->findPk($this->grupo_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGrupo->addGrupoSchedules($this);
             */
        }

        return $this->aGrupo;
    }

    /**
     * Declares an association between this object and a ChildSchedule object.
     *
     * @param  ChildSchedule $v
     * @return $this|\GrupoSchedule The current object (for fluent API support)
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
            $v->addGrupoSchedule($this);
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
                $this->aSchedule->addGrupoSchedules($this);
             */
        }

        return $this->aSchedule;
    }

    /**
     * Declares an association between this object and a ChildUsuario object.
     *
     * @param  ChildUsuario $v
     * @return $this|\GrupoSchedule The current object (for fluent API support)
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
            $v->addGrupoSchedule($this);
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
                $this->aUsuario->addGrupoSchedules($this);
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
        if ('LogEditeGrupoSchedule' === $relationName) {
            $this->initLogEditeGrupoSchedules();
            return;
        }
        if ('LogGrupoExecution' === $relationName) {
            $this->initLogGrupoExecutions();
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
     * If this ChildGrupoSchedule is new, it will return
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
                    ->filterByGrupoSchedule($this)
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
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
     */
    public function setLogDeleteGrupoSchedules(Collection $logDeleteGrupoSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogDeleteGrupoSchedule[] $logDeleteGrupoSchedulesToDelete */
        $logDeleteGrupoSchedulesToDelete = $this->getLogDeleteGrupoSchedules(new Criteria(), $con)->diff($logDeleteGrupoSchedules);


        $this->logDeleteGrupoSchedulesScheduledForDeletion = $logDeleteGrupoSchedulesToDelete;

        foreach ($logDeleteGrupoSchedulesToDelete as $logDeleteGrupoScheduleRemoved) {
            $logDeleteGrupoScheduleRemoved->setGrupoSchedule(null);
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
                ->filterByGrupoSchedule($this)
                ->count($con);
        }

        return count($this->collLogDeleteGrupoSchedules);
    }

    /**
     * Method called to associate a ChildLogDeleteGrupoSchedule object to this object
     * through the ChildLogDeleteGrupoSchedule foreign key attribute.
     *
     * @param  ChildLogDeleteGrupoSchedule $l ChildLogDeleteGrupoSchedule
     * @return $this|\GrupoSchedule The current object (for fluent API support)
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
        $logDeleteGrupoSchedule->setGrupoSchedule($this);
    }

    /**
     * @param  ChildLogDeleteGrupoSchedule $logDeleteGrupoSchedule The ChildLogDeleteGrupoSchedule object to remove.
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
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
            $logDeleteGrupoSchedule->setGrupoSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GrupoSchedule is new, it will return
     * an empty collection; or if this GrupoSchedule has previously
     * been saved, it will retrieve related LogDeleteGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GrupoSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogDeleteGrupoSchedule[] List of ChildLogDeleteGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogDeleteGrupoSchedule}> List of ChildLogDeleteGrupoSchedule objects
     */
    public function getLogDeleteGrupoSchedulesJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogDeleteGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogDeleteGrupoSchedules($query, $con);
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
     * If this ChildGrupoSchedule is new, it will return
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
                    ->filterByGrupoSchedule($this)
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
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
     */
    public function setLogEditeGrupoSchedules(Collection $logEditeGrupoSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditeGrupoSchedule[] $logEditeGrupoSchedulesToDelete */
        $logEditeGrupoSchedulesToDelete = $this->getLogEditeGrupoSchedules(new Criteria(), $con)->diff($logEditeGrupoSchedules);


        $this->logEditeGrupoSchedulesScheduledForDeletion = $logEditeGrupoSchedulesToDelete;

        foreach ($logEditeGrupoSchedulesToDelete as $logEditeGrupoScheduleRemoved) {
            $logEditeGrupoScheduleRemoved->setGrupoSchedule(null);
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
                ->filterByGrupoSchedule($this)
                ->count($con);
        }

        return count($this->collLogEditeGrupoSchedules);
    }

    /**
     * Method called to associate a ChildLogEditeGrupoSchedule object to this object
     * through the ChildLogEditeGrupoSchedule foreign key attribute.
     *
     * @param  ChildLogEditeGrupoSchedule $l ChildLogEditeGrupoSchedule
     * @return $this|\GrupoSchedule The current object (for fluent API support)
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
        $logEditeGrupoSchedule->setGrupoSchedule($this);
    }

    /**
     * @param  ChildLogEditeGrupoSchedule $logEditeGrupoSchedule The ChildLogEditeGrupoSchedule object to remove.
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
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
            $logEditeGrupoSchedule->setGrupoSchedule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GrupoSchedule is new, it will return
     * an empty collection; or if this GrupoSchedule has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GrupoSchedule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditeGrupoSchedule[] List of ChildLogEditeGrupoSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditeGrupoSchedule}> List of ChildLogEditeGrupoSchedule objects
     */
    public function getLogEditeGrupoSchedulesJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditeGrupoScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogEditeGrupoSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GrupoSchedule is new, it will return
     * an empty collection; or if this GrupoSchedule has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GrupoSchedule.
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
     * Otherwise if this GrupoSchedule is new, it will return
     * an empty collection; or if this GrupoSchedule has previously
     * been saved, it will retrieve related LogEditeGrupoSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GrupoSchedule.
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
     * Clears out the collLogGrupoExecutions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogGrupoExecutions()
     */
    public function clearLogGrupoExecutions()
    {
        $this->collLogGrupoExecutions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogGrupoExecutions collection loaded partially.
     */
    public function resetPartialLogGrupoExecutions($v = true)
    {
        $this->collLogGrupoExecutionsPartial = $v;
    }

    /**
     * Initializes the collLogGrupoExecutions collection.
     *
     * By default this just sets the collLogGrupoExecutions collection to an empty array (like clearcollLogGrupoExecutions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogGrupoExecutions($overrideExisting = true)
    {
        if (null !== $this->collLogGrupoExecutions && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogGrupoExecutionTableMap::getTableMap()->getCollectionClassName();

        $this->collLogGrupoExecutions = new $collectionClassName;
        $this->collLogGrupoExecutions->setModel('\LogGrupoExecution');
    }

    /**
     * Gets an array of ChildLogGrupoExecution objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGrupoSchedule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogGrupoExecution[] List of ChildLogGrupoExecution objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogGrupoExecution> List of ChildLogGrupoExecution objects
     * @throws PropelException
     */
    public function getLogGrupoExecutions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogGrupoExecutionsPartial && !$this->isNew();
        if (null === $this->collLogGrupoExecutions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogGrupoExecutions) {
                    $this->initLogGrupoExecutions();
                } else {
                    $collectionClassName = LogGrupoExecutionTableMap::getTableMap()->getCollectionClassName();

                    $collLogGrupoExecutions = new $collectionClassName;
                    $collLogGrupoExecutions->setModel('\LogGrupoExecution');

                    return $collLogGrupoExecutions;
                }
            } else {
                $collLogGrupoExecutions = ChildLogGrupoExecutionQuery::create(null, $criteria)
                    ->filterByGrupoSchedule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogGrupoExecutionsPartial && count($collLogGrupoExecutions)) {
                        $this->initLogGrupoExecutions(false);

                        foreach ($collLogGrupoExecutions as $obj) {
                            if (false == $this->collLogGrupoExecutions->contains($obj)) {
                                $this->collLogGrupoExecutions->append($obj);
                            }
                        }

                        $this->collLogGrupoExecutionsPartial = true;
                    }

                    return $collLogGrupoExecutions;
                }

                if ($partial && $this->collLogGrupoExecutions) {
                    foreach ($this->collLogGrupoExecutions as $obj) {
                        if ($obj->isNew()) {
                            $collLogGrupoExecutions[] = $obj;
                        }
                    }
                }

                $this->collLogGrupoExecutions = $collLogGrupoExecutions;
                $this->collLogGrupoExecutionsPartial = false;
            }
        }

        return $this->collLogGrupoExecutions;
    }

    /**
     * Sets a collection of ChildLogGrupoExecution objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logGrupoExecutions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
     */
    public function setLogGrupoExecutions(Collection $logGrupoExecutions, ConnectionInterface $con = null)
    {
        /** @var ChildLogGrupoExecution[] $logGrupoExecutionsToDelete */
        $logGrupoExecutionsToDelete = $this->getLogGrupoExecutions(new Criteria(), $con)->diff($logGrupoExecutions);


        $this->logGrupoExecutionsScheduledForDeletion = $logGrupoExecutionsToDelete;

        foreach ($logGrupoExecutionsToDelete as $logGrupoExecutionRemoved) {
            $logGrupoExecutionRemoved->setGrupoSchedule(null);
        }

        $this->collLogGrupoExecutions = null;
        foreach ($logGrupoExecutions as $logGrupoExecution) {
            $this->addLogGrupoExecution($logGrupoExecution);
        }

        $this->collLogGrupoExecutions = $logGrupoExecutions;
        $this->collLogGrupoExecutionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LogGrupoExecution objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LogGrupoExecution objects.
     * @throws PropelException
     */
    public function countLogGrupoExecutions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogGrupoExecutionsPartial && !$this->isNew();
        if (null === $this->collLogGrupoExecutions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogGrupoExecutions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogGrupoExecutions());
            }

            $query = ChildLogGrupoExecutionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGrupoSchedule($this)
                ->count($con);
        }

        return count($this->collLogGrupoExecutions);
    }

    /**
     * Method called to associate a ChildLogGrupoExecution object to this object
     * through the ChildLogGrupoExecution foreign key attribute.
     *
     * @param  ChildLogGrupoExecution $l ChildLogGrupoExecution
     * @return $this|\GrupoSchedule The current object (for fluent API support)
     */
    public function addLogGrupoExecution(ChildLogGrupoExecution $l)
    {
        if ($this->collLogGrupoExecutions === null) {
            $this->initLogGrupoExecutions();
            $this->collLogGrupoExecutionsPartial = true;
        }

        if (!$this->collLogGrupoExecutions->contains($l)) {
            $this->doAddLogGrupoExecution($l);

            if ($this->logGrupoExecutionsScheduledForDeletion and $this->logGrupoExecutionsScheduledForDeletion->contains($l)) {
                $this->logGrupoExecutionsScheduledForDeletion->remove($this->logGrupoExecutionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogGrupoExecution $logGrupoExecution The ChildLogGrupoExecution object to add.
     */
    protected function doAddLogGrupoExecution(ChildLogGrupoExecution $logGrupoExecution)
    {
        $this->collLogGrupoExecutions[]= $logGrupoExecution;
        $logGrupoExecution->setGrupoSchedule($this);
    }

    /**
     * @param  ChildLogGrupoExecution $logGrupoExecution The ChildLogGrupoExecution object to remove.
     * @return $this|ChildGrupoSchedule The current object (for fluent API support)
     */
    public function removeLogGrupoExecution(ChildLogGrupoExecution $logGrupoExecution)
    {
        if ($this->getLogGrupoExecutions()->contains($logGrupoExecution)) {
            $pos = $this->collLogGrupoExecutions->search($logGrupoExecution);
            $this->collLogGrupoExecutions->remove($pos);
            if (null === $this->logGrupoExecutionsScheduledForDeletion) {
                $this->logGrupoExecutionsScheduledForDeletion = clone $this->collLogGrupoExecutions;
                $this->logGrupoExecutionsScheduledForDeletion->clear();
            }
            $this->logGrupoExecutionsScheduledForDeletion[]= clone $logGrupoExecution;
            $logGrupoExecution->setGrupoSchedule(null);
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
        if (null !== $this->aGrupo) {
            $this->aGrupo->removeGrupoSchedule($this);
        }
        if (null !== $this->aSchedule) {
            $this->aSchedule->removeGrupoSchedule($this);
        }
        if (null !== $this->aUsuario) {
            $this->aUsuario->removeGrupoSchedule($this);
        }
        $this->id = null;
        $this->description = null;
        $this->schedule_id = null;
        $this->usuario_id = null;
        $this->grupo_id = null;
        $this->scheduled = null;
        $this->push_pop = null;
        $this->enabled = null;
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
            if ($this->collLogEditeGrupoSchedules) {
                foreach ($this->collLogEditeGrupoSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogGrupoExecutions) {
                foreach ($this->collLogGrupoExecutions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLogDeleteGrupoSchedules = null;
        $this->collLogEditeGrupoSchedules = null;
        $this->collLogGrupoExecutions = null;
        $this->aGrupo = null;
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
        return (string) $this->exportTo(GrupoScheduleTableMap::DEFAULT_STRING_FORMAT);
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
