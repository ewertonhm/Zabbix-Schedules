<?php

namespace Base;

use \Host as ChildHost;
use \HostQuery as ChildHostQuery;
use \HostSchedule as ChildHostSchedule;
use \HostScheduleQuery as ChildHostScheduleQuery;
use \LogEditHostSchedule as ChildLogEditHostSchedule;
use \LogEditHostScheduleQuery as ChildLogEditHostScheduleQuery;
use \MacroSchedule as ChildMacroSchedule;
use \MacroScheduleQuery as ChildMacroScheduleQuery;
use \Exception;
use \PDO;
use Map\HostScheduleTableMap;
use Map\HostTableMap;
use Map\LogEditHostScheduleTableMap;
use Map\MacroScheduleTableMap;
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
 * Base class that represents a row from the 'host' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Host implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\HostTableMap';


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
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the zabbixid field.
     *
     * @var        string
     */
    protected $zabbixid;

    /**
     * @var        ObjectCollection|ChildHostSchedule[] Collection to store aggregation of ChildHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHostSchedule> Collection to store aggregation of ChildHostSchedule objects.
     */
    protected $collHostSchedules;
    protected $collHostSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildLogEditHostSchedule[] Collection to store aggregation of ChildLogEditHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule> Collection to store aggregation of ChildLogEditHostSchedule objects.
     */
    protected $collLogEditHostSchedulesRelatedByNewHostId;
    protected $collLogEditHostSchedulesRelatedByNewHostIdPartial;

    /**
     * @var        ObjectCollection|ChildLogEditHostSchedule[] Collection to store aggregation of ChildLogEditHostSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule> Collection to store aggregation of ChildLogEditHostSchedule objects.
     */
    protected $collLogEditHostSchedulesRelatedByOldHostId;
    protected $collLogEditHostSchedulesRelatedByOldHostIdPartial;

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
     * @var ObjectCollection|ChildHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHostSchedule>
     */
    protected $hostSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule>
     */
    protected $logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLogEditHostSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLogEditHostSchedule>
     */
    protected $logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMacroSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMacroSchedule>
     */
    protected $macroSchedulesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Host object.
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
     * Compares this with another <code>Host</code> instance.  If
     * <code>obj</code> is an instance of <code>Host</code>, delegates to
     * <code>equals(Host)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [zabbixid] column value.
     *
     * @return string
     */
    public function getZabbixid()
    {
        return $this->zabbixid;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\Host The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[HostTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v New value
     * @return $this|\Host The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[HostTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [zabbixid] column.
     *
     * @param string $v New value
     * @return $this|\Host The current object (for fluent API support)
     */
    public function setZabbixid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zabbixid !== $v) {
            $this->zabbixid = $v;
            $this->modifiedColumns[HostTableMap::COL_ZABBIXID] = true;
        }

        return $this;
    } // setZabbixid()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HostTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HostTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HostTableMap::translateFieldName('Zabbixid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zabbixid = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = HostTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Host'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(HostTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHostQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collHostSchedules = null;

            $this->collLogEditHostSchedulesRelatedByNewHostId = null;

            $this->collLogEditHostSchedulesRelatedByOldHostId = null;

            $this->collMacroSchedules = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Host::setDeleted()
     * @see Host::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HostTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHostQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HostTableMap::DATABASE_NAME);
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
                HostTableMap::addInstanceToPool($this);
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

            if ($this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion !== null) {
                if (!$this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->isEmpty()) {
                    \LogEditHostScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion = null;
                }
            }

            if ($this->collLogEditHostSchedulesRelatedByNewHostId !== null) {
                foreach ($this->collLogEditHostSchedulesRelatedByNewHostId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion !== null) {
                if (!$this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->isEmpty()) {
                    \LogEditHostScheduleQuery::create()
                        ->filterByPrimaryKeys($this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion = null;
                }
            }

            if ($this->collLogEditHostSchedulesRelatedByOldHostId !== null) {
                foreach ($this->collLogEditHostSchedulesRelatedByOldHostId as $referrerFK) {
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

        $this->modifiedColumns[HostTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HostTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('host_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HostTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(HostTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(HostTableMap::COL_ZABBIXID)) {
            $modifiedColumns[':p' . $index++]  = 'zabbixid';
        }

        $sql = sprintf(
            'INSERT INTO host (%s) VALUES (%s)',
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
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'zabbixid':
                        $stmt->bindValue($identifier, $this->zabbixid, PDO::PARAM_STR);
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
        $pos = HostTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNome();
                break;
            case 2:
                return $this->getZabbixid();
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

        if (isset($alreadyDumpedObjects['Host'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Host'][$this->hashCode()] = true;
        $keys = HostTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getZabbixid(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collLogEditHostSchedulesRelatedByNewHostId) {

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

                $result[$key] = $this->collLogEditHostSchedulesRelatedByNewHostId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLogEditHostSchedulesRelatedByOldHostId) {

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

                $result[$key] = $this->collLogEditHostSchedulesRelatedByOldHostId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Host
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = HostTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Host
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setZabbixid($value);
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
     * @return     $this|\Host
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = HostTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setZabbixid($arr[$keys[2]]);
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
     * @return $this|\Host The current object, for fluid interface
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
        $criteria = new Criteria(HostTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HostTableMap::COL_ID)) {
            $criteria->add(HostTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(HostTableMap::COL_NOME)) {
            $criteria->add(HostTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(HostTableMap::COL_ZABBIXID)) {
            $criteria->add(HostTableMap::COL_ZABBIXID, $this->zabbixid);
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
        $criteria = ChildHostQuery::create();
        $criteria->add(HostTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Host (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setZabbixid($this->getZabbixid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getHostSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHostSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditHostSchedulesRelatedByNewHostId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditHostScheduleRelatedByNewHostId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLogEditHostSchedulesRelatedByOldHostId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLogEditHostScheduleRelatedByOldHostId($relObj->copy($deepCopy));
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
     * @return \Host Clone of current object.
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
        if ('HostSchedule' === $relationName) {
            $this->initHostSchedules();
            return;
        }
        if ('LogEditHostScheduleRelatedByNewHostId' === $relationName) {
            $this->initLogEditHostSchedulesRelatedByNewHostId();
            return;
        }
        if ('LogEditHostScheduleRelatedByOldHostId' === $relationName) {
            $this->initLogEditHostSchedulesRelatedByOldHostId();
            return;
        }
        if ('MacroSchedule' === $relationName) {
            $this->initMacroSchedules();
            return;
        }
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
     * If this ChildHost is new, it will return
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
                    ->filterByHost($this)
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
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function setHostSchedules(Collection $hostSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildHostSchedule[] $hostSchedulesToDelete */
        $hostSchedulesToDelete = $this->getHostSchedules(new Criteria(), $con)->diff($hostSchedules);


        $this->hostSchedulesScheduledForDeletion = $hostSchedulesToDelete;

        foreach ($hostSchedulesToDelete as $hostScheduleRemoved) {
            $hostScheduleRemoved->setHost(null);
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
                ->filterByHost($this)
                ->count($con);
        }

        return count($this->collHostSchedules);
    }

    /**
     * Method called to associate a ChildHostSchedule object to this object
     * through the ChildHostSchedule foreign key attribute.
     *
     * @param  ChildHostSchedule $l ChildHostSchedule
     * @return $this|\Host The current object (for fluent API support)
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
        $hostSchedule->setHost($this);
    }

    /**
     * @param  ChildHostSchedule $hostSchedule The ChildHostSchedule object to remove.
     * @return $this|ChildHost The current object (for fluent API support)
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
            $hostSchedule->setHost(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related HostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHostSchedule[] List of ChildHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHostSchedule}> List of ChildHostSchedule objects
     */
    public function getHostSchedulesJoinSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Schedule', $joinBehavior);

        return $this->getHostSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related HostSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
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
     * Clears out the collLogEditHostSchedulesRelatedByNewHostId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogEditHostSchedulesRelatedByNewHostId()
     */
    public function clearLogEditHostSchedulesRelatedByNewHostId()
    {
        $this->collLogEditHostSchedulesRelatedByNewHostId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogEditHostSchedulesRelatedByNewHostId collection loaded partially.
     */
    public function resetPartialLogEditHostSchedulesRelatedByNewHostId($v = true)
    {
        $this->collLogEditHostSchedulesRelatedByNewHostIdPartial = $v;
    }

    /**
     * Initializes the collLogEditHostSchedulesRelatedByNewHostId collection.
     *
     * By default this just sets the collLogEditHostSchedulesRelatedByNewHostId collection to an empty array (like clearcollLogEditHostSchedulesRelatedByNewHostId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogEditHostSchedulesRelatedByNewHostId($overrideExisting = true)
    {
        if (null !== $this->collLogEditHostSchedulesRelatedByNewHostId && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogEditHostSchedulesRelatedByNewHostId = new $collectionClassName;
        $this->collLogEditHostSchedulesRelatedByNewHostId->setModel('\LogEditHostSchedule');
    }

    /**
     * Gets an array of ChildLogEditHostSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHost is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule> List of ChildLogEditHostSchedule objects
     * @throws PropelException
     */
    public function getLogEditHostSchedulesRelatedByNewHostId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesRelatedByNewHostIdPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedulesRelatedByNewHostId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogEditHostSchedulesRelatedByNewHostId) {
                    $this->initLogEditHostSchedulesRelatedByNewHostId();
                } else {
                    $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogEditHostSchedulesRelatedByNewHostId = new $collectionClassName;
                    $collLogEditHostSchedulesRelatedByNewHostId->setModel('\LogEditHostSchedule');

                    return $collLogEditHostSchedulesRelatedByNewHostId;
                }
            } else {
                $collLogEditHostSchedulesRelatedByNewHostId = ChildLogEditHostScheduleQuery::create(null, $criteria)
                    ->filterByHostRelatedByNewHostId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogEditHostSchedulesRelatedByNewHostIdPartial && count($collLogEditHostSchedulesRelatedByNewHostId)) {
                        $this->initLogEditHostSchedulesRelatedByNewHostId(false);

                        foreach ($collLogEditHostSchedulesRelatedByNewHostId as $obj) {
                            if (false == $this->collLogEditHostSchedulesRelatedByNewHostId->contains($obj)) {
                                $this->collLogEditHostSchedulesRelatedByNewHostId->append($obj);
                            }
                        }

                        $this->collLogEditHostSchedulesRelatedByNewHostIdPartial = true;
                    }

                    return $collLogEditHostSchedulesRelatedByNewHostId;
                }

                if ($partial && $this->collLogEditHostSchedulesRelatedByNewHostId) {
                    foreach ($this->collLogEditHostSchedulesRelatedByNewHostId as $obj) {
                        if ($obj->isNew()) {
                            $collLogEditHostSchedulesRelatedByNewHostId[] = $obj;
                        }
                    }
                }

                $this->collLogEditHostSchedulesRelatedByNewHostId = $collLogEditHostSchedulesRelatedByNewHostId;
                $this->collLogEditHostSchedulesRelatedByNewHostIdPartial = false;
            }
        }

        return $this->collLogEditHostSchedulesRelatedByNewHostId;
    }

    /**
     * Sets a collection of ChildLogEditHostSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logEditHostSchedulesRelatedByNewHostId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function setLogEditHostSchedulesRelatedByNewHostId(Collection $logEditHostSchedulesRelatedByNewHostId, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditHostSchedule[] $logEditHostSchedulesRelatedByNewHostIdToDelete */
        $logEditHostSchedulesRelatedByNewHostIdToDelete = $this->getLogEditHostSchedulesRelatedByNewHostId(new Criteria(), $con)->diff($logEditHostSchedulesRelatedByNewHostId);


        $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion = $logEditHostSchedulesRelatedByNewHostIdToDelete;

        foreach ($logEditHostSchedulesRelatedByNewHostIdToDelete as $logEditHostScheduleRelatedByNewHostIdRemoved) {
            $logEditHostScheduleRelatedByNewHostIdRemoved->setHostRelatedByNewHostId(null);
        }

        $this->collLogEditHostSchedulesRelatedByNewHostId = null;
        foreach ($logEditHostSchedulesRelatedByNewHostId as $logEditHostScheduleRelatedByNewHostId) {
            $this->addLogEditHostScheduleRelatedByNewHostId($logEditHostScheduleRelatedByNewHostId);
        }

        $this->collLogEditHostSchedulesRelatedByNewHostId = $logEditHostSchedulesRelatedByNewHostId;
        $this->collLogEditHostSchedulesRelatedByNewHostIdPartial = false;

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
    public function countLogEditHostSchedulesRelatedByNewHostId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesRelatedByNewHostIdPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedulesRelatedByNewHostId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogEditHostSchedulesRelatedByNewHostId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogEditHostSchedulesRelatedByNewHostId());
            }

            $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHostRelatedByNewHostId($this)
                ->count($con);
        }

        return count($this->collLogEditHostSchedulesRelatedByNewHostId);
    }

    /**
     * Method called to associate a ChildLogEditHostSchedule object to this object
     * through the ChildLogEditHostSchedule foreign key attribute.
     *
     * @param  ChildLogEditHostSchedule $l ChildLogEditHostSchedule
     * @return $this|\Host The current object (for fluent API support)
     */
    public function addLogEditHostScheduleRelatedByNewHostId(ChildLogEditHostSchedule $l)
    {
        if ($this->collLogEditHostSchedulesRelatedByNewHostId === null) {
            $this->initLogEditHostSchedulesRelatedByNewHostId();
            $this->collLogEditHostSchedulesRelatedByNewHostIdPartial = true;
        }

        if (!$this->collLogEditHostSchedulesRelatedByNewHostId->contains($l)) {
            $this->doAddLogEditHostScheduleRelatedByNewHostId($l);

            if ($this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion and $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->contains($l)) {
                $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->remove($this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogEditHostSchedule $logEditHostScheduleRelatedByNewHostId The ChildLogEditHostSchedule object to add.
     */
    protected function doAddLogEditHostScheduleRelatedByNewHostId(ChildLogEditHostSchedule $logEditHostScheduleRelatedByNewHostId)
    {
        $this->collLogEditHostSchedulesRelatedByNewHostId[]= $logEditHostScheduleRelatedByNewHostId;
        $logEditHostScheduleRelatedByNewHostId->setHostRelatedByNewHostId($this);
    }

    /**
     * @param  ChildLogEditHostSchedule $logEditHostScheduleRelatedByNewHostId The ChildLogEditHostSchedule object to remove.
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function removeLogEditHostScheduleRelatedByNewHostId(ChildLogEditHostSchedule $logEditHostScheduleRelatedByNewHostId)
    {
        if ($this->getLogEditHostSchedulesRelatedByNewHostId()->contains($logEditHostScheduleRelatedByNewHostId)) {
            $pos = $this->collLogEditHostSchedulesRelatedByNewHostId->search($logEditHostScheduleRelatedByNewHostId);
            $this->collLogEditHostSchedulesRelatedByNewHostId->remove($pos);
            if (null === $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion) {
                $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion = clone $this->collLogEditHostSchedulesRelatedByNewHostId;
                $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion->clear();
            }
            $this->logEditHostSchedulesRelatedByNewHostIdScheduledForDeletion[]= clone $logEditHostScheduleRelatedByNewHostId;
            $logEditHostScheduleRelatedByNewHostId->setHostRelatedByNewHostId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related LogEditHostSchedulesRelatedByNewHostId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesRelatedByNewHostIdJoinHostSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostSchedule', $joinBehavior);

        return $this->getLogEditHostSchedulesRelatedByNewHostId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related LogEditHostSchedulesRelatedByNewHostId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesRelatedByNewHostIdJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogEditHostSchedulesRelatedByNewHostId($query, $con);
    }

    /**
     * Clears out the collLogEditHostSchedulesRelatedByOldHostId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLogEditHostSchedulesRelatedByOldHostId()
     */
    public function clearLogEditHostSchedulesRelatedByOldHostId()
    {
        $this->collLogEditHostSchedulesRelatedByOldHostId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLogEditHostSchedulesRelatedByOldHostId collection loaded partially.
     */
    public function resetPartialLogEditHostSchedulesRelatedByOldHostId($v = true)
    {
        $this->collLogEditHostSchedulesRelatedByOldHostIdPartial = $v;
    }

    /**
     * Initializes the collLogEditHostSchedulesRelatedByOldHostId collection.
     *
     * By default this just sets the collLogEditHostSchedulesRelatedByOldHostId collection to an empty array (like clearcollLogEditHostSchedulesRelatedByOldHostId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLogEditHostSchedulesRelatedByOldHostId($overrideExisting = true)
    {
        if (null !== $this->collLogEditHostSchedulesRelatedByOldHostId && !$overrideExisting) {
            return;
        }

        $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collLogEditHostSchedulesRelatedByOldHostId = new $collectionClassName;
        $this->collLogEditHostSchedulesRelatedByOldHostId->setModel('\LogEditHostSchedule');
    }

    /**
     * Gets an array of ChildLogEditHostSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHost is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule> List of ChildLogEditHostSchedule objects
     * @throws PropelException
     */
    public function getLogEditHostSchedulesRelatedByOldHostId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesRelatedByOldHostIdPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedulesRelatedByOldHostId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLogEditHostSchedulesRelatedByOldHostId) {
                    $this->initLogEditHostSchedulesRelatedByOldHostId();
                } else {
                    $collectionClassName = LogEditHostScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collLogEditHostSchedulesRelatedByOldHostId = new $collectionClassName;
                    $collLogEditHostSchedulesRelatedByOldHostId->setModel('\LogEditHostSchedule');

                    return $collLogEditHostSchedulesRelatedByOldHostId;
                }
            } else {
                $collLogEditHostSchedulesRelatedByOldHostId = ChildLogEditHostScheduleQuery::create(null, $criteria)
                    ->filterByHostRelatedByOldHostId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLogEditHostSchedulesRelatedByOldHostIdPartial && count($collLogEditHostSchedulesRelatedByOldHostId)) {
                        $this->initLogEditHostSchedulesRelatedByOldHostId(false);

                        foreach ($collLogEditHostSchedulesRelatedByOldHostId as $obj) {
                            if (false == $this->collLogEditHostSchedulesRelatedByOldHostId->contains($obj)) {
                                $this->collLogEditHostSchedulesRelatedByOldHostId->append($obj);
                            }
                        }

                        $this->collLogEditHostSchedulesRelatedByOldHostIdPartial = true;
                    }

                    return $collLogEditHostSchedulesRelatedByOldHostId;
                }

                if ($partial && $this->collLogEditHostSchedulesRelatedByOldHostId) {
                    foreach ($this->collLogEditHostSchedulesRelatedByOldHostId as $obj) {
                        if ($obj->isNew()) {
                            $collLogEditHostSchedulesRelatedByOldHostId[] = $obj;
                        }
                    }
                }

                $this->collLogEditHostSchedulesRelatedByOldHostId = $collLogEditHostSchedulesRelatedByOldHostId;
                $this->collLogEditHostSchedulesRelatedByOldHostIdPartial = false;
            }
        }

        return $this->collLogEditHostSchedulesRelatedByOldHostId;
    }

    /**
     * Sets a collection of ChildLogEditHostSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $logEditHostSchedulesRelatedByOldHostId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function setLogEditHostSchedulesRelatedByOldHostId(Collection $logEditHostSchedulesRelatedByOldHostId, ConnectionInterface $con = null)
    {
        /** @var ChildLogEditHostSchedule[] $logEditHostSchedulesRelatedByOldHostIdToDelete */
        $logEditHostSchedulesRelatedByOldHostIdToDelete = $this->getLogEditHostSchedulesRelatedByOldHostId(new Criteria(), $con)->diff($logEditHostSchedulesRelatedByOldHostId);


        $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion = $logEditHostSchedulesRelatedByOldHostIdToDelete;

        foreach ($logEditHostSchedulesRelatedByOldHostIdToDelete as $logEditHostScheduleRelatedByOldHostIdRemoved) {
            $logEditHostScheduleRelatedByOldHostIdRemoved->setHostRelatedByOldHostId(null);
        }

        $this->collLogEditHostSchedulesRelatedByOldHostId = null;
        foreach ($logEditHostSchedulesRelatedByOldHostId as $logEditHostScheduleRelatedByOldHostId) {
            $this->addLogEditHostScheduleRelatedByOldHostId($logEditHostScheduleRelatedByOldHostId);
        }

        $this->collLogEditHostSchedulesRelatedByOldHostId = $logEditHostSchedulesRelatedByOldHostId;
        $this->collLogEditHostSchedulesRelatedByOldHostIdPartial = false;

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
    public function countLogEditHostSchedulesRelatedByOldHostId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLogEditHostSchedulesRelatedByOldHostIdPartial && !$this->isNew();
        if (null === $this->collLogEditHostSchedulesRelatedByOldHostId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLogEditHostSchedulesRelatedByOldHostId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLogEditHostSchedulesRelatedByOldHostId());
            }

            $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHostRelatedByOldHostId($this)
                ->count($con);
        }

        return count($this->collLogEditHostSchedulesRelatedByOldHostId);
    }

    /**
     * Method called to associate a ChildLogEditHostSchedule object to this object
     * through the ChildLogEditHostSchedule foreign key attribute.
     *
     * @param  ChildLogEditHostSchedule $l ChildLogEditHostSchedule
     * @return $this|\Host The current object (for fluent API support)
     */
    public function addLogEditHostScheduleRelatedByOldHostId(ChildLogEditHostSchedule $l)
    {
        if ($this->collLogEditHostSchedulesRelatedByOldHostId === null) {
            $this->initLogEditHostSchedulesRelatedByOldHostId();
            $this->collLogEditHostSchedulesRelatedByOldHostIdPartial = true;
        }

        if (!$this->collLogEditHostSchedulesRelatedByOldHostId->contains($l)) {
            $this->doAddLogEditHostScheduleRelatedByOldHostId($l);

            if ($this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion and $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->contains($l)) {
                $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->remove($this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLogEditHostSchedule $logEditHostScheduleRelatedByOldHostId The ChildLogEditHostSchedule object to add.
     */
    protected function doAddLogEditHostScheduleRelatedByOldHostId(ChildLogEditHostSchedule $logEditHostScheduleRelatedByOldHostId)
    {
        $this->collLogEditHostSchedulesRelatedByOldHostId[]= $logEditHostScheduleRelatedByOldHostId;
        $logEditHostScheduleRelatedByOldHostId->setHostRelatedByOldHostId($this);
    }

    /**
     * @param  ChildLogEditHostSchedule $logEditHostScheduleRelatedByOldHostId The ChildLogEditHostSchedule object to remove.
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function removeLogEditHostScheduleRelatedByOldHostId(ChildLogEditHostSchedule $logEditHostScheduleRelatedByOldHostId)
    {
        if ($this->getLogEditHostSchedulesRelatedByOldHostId()->contains($logEditHostScheduleRelatedByOldHostId)) {
            $pos = $this->collLogEditHostSchedulesRelatedByOldHostId->search($logEditHostScheduleRelatedByOldHostId);
            $this->collLogEditHostSchedulesRelatedByOldHostId->remove($pos);
            if (null === $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion) {
                $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion = clone $this->collLogEditHostSchedulesRelatedByOldHostId;
                $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion->clear();
            }
            $this->logEditHostSchedulesRelatedByOldHostIdScheduledForDeletion[]= clone $logEditHostScheduleRelatedByOldHostId;
            $logEditHostScheduleRelatedByOldHostId->setHostRelatedByOldHostId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related LogEditHostSchedulesRelatedByOldHostId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesRelatedByOldHostIdJoinHostSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('HostSchedule', $joinBehavior);

        return $this->getLogEditHostSchedulesRelatedByOldHostId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related LogEditHostSchedulesRelatedByOldHostId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLogEditHostSchedule[] List of ChildLogEditHostSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLogEditHostSchedule}> List of ChildLogEditHostSchedule objects
     */
    public function getLogEditHostSchedulesRelatedByOldHostIdJoinLog(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLogEditHostScheduleQuery::create(null, $criteria);
        $query->joinWith('Log', $joinBehavior);

        return $this->getLogEditHostSchedulesRelatedByOldHostId($query, $con);
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
     * If this ChildHost is new, it will return
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
                    ->filterByHost($this)
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
     * @return $this|ChildHost The current object (for fluent API support)
     */
    public function setMacroSchedules(Collection $macroSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildMacroSchedule[] $macroSchedulesToDelete */
        $macroSchedulesToDelete = $this->getMacroSchedules(new Criteria(), $con)->diff($macroSchedules);


        $this->macroSchedulesScheduledForDeletion = $macroSchedulesToDelete;

        foreach ($macroSchedulesToDelete as $macroScheduleRemoved) {
            $macroScheduleRemoved->setHost(null);
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
                ->filterByHost($this)
                ->count($con);
        }

        return count($this->collMacroSchedules);
    }

    /**
     * Method called to associate a ChildMacroSchedule object to this object
     * through the ChildMacroSchedule foreign key attribute.
     *
     * @param  ChildMacroSchedule $l ChildMacroSchedule
     * @return $this|\Host The current object (for fluent API support)
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
        $macroSchedule->setHost($this);
    }

    /**
     * @param  ChildMacroSchedule $macroSchedule The ChildMacroSchedule object to remove.
     * @return $this|ChildHost The current object (for fluent API support)
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
            $macroSchedule->setHost(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
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
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMacroSchedule[] List of ChildMacroSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMacroSchedule}> List of ChildMacroSchedule objects
     */
    public function getMacroSchedulesJoinSchedule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMacroScheduleQuery::create(null, $criteria);
        $query->joinWith('Schedule', $joinBehavior);

        return $this->getMacroSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Host is new, it will return
     * an empty collection; or if this Host has previously
     * been saved, it will retrieve related MacroSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Host.
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
        $this->nome = null;
        $this->zabbixid = null;
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
            if ($this->collHostSchedules) {
                foreach ($this->collHostSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditHostSchedulesRelatedByNewHostId) {
                foreach ($this->collLogEditHostSchedulesRelatedByNewHostId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLogEditHostSchedulesRelatedByOldHostId) {
                foreach ($this->collLogEditHostSchedulesRelatedByOldHostId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMacroSchedules) {
                foreach ($this->collMacroSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collHostSchedules = null;
        $this->collLogEditHostSchedulesRelatedByNewHostId = null;
        $this->collLogEditHostSchedulesRelatedByOldHostId = null;
        $this->collMacroSchedules = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HostTableMap::DEFAULT_STRING_FORMAT);
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
