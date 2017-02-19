<?php

namespace AUTH\Models\Base;

use \DateTime;
use \Exception;
use \PDO;
use AUTH\Models\LoginAccount as ChildLoginAccount;
use AUTH\Models\LoginAccountQuery as ChildLoginAccountQuery;
use AUTH\Models\LoginProvider as ChildLoginProvider;
use AUTH\Models\LoginProviderQuery as ChildLoginProviderQuery;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Models\Map\LoginProviderTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'AUTH_PROVIDERS' table.
 *
 * Table with the login providers
 *
 * @package    propel.generator.AUTH.Models.Base
 */
abstract class LoginProvider implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\AUTH\\Models\\Map\\LoginProviderTableMap';


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
     * The value for the id_provider field.
     *
     * @var        int
     */
    protected $id_provider;

    /**
     * The value for the name field.
     *
     * @var        int
     */
    protected $name;

    /**
     * The value for the dev field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $dev;

    /**
     * The value for the client field.
     *
     * @var        string
     */
    protected $client;

    /**
     * The value for the secret field.
     *
     * @var        string
     */
    protected $secret;

    /**
     * The value for the callback_url field.
     *
     * @var        string
     */
    protected $callback_url;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * The value for the accounts field.
     *
     * @var        int
     */
    protected $accounts;

    /**
     * @var        ObjectCollection|ChildLoginAccount[] Collection to store aggregation of ChildLoginAccount objects.
     */
    protected $collLoginAccounts;
    protected $collLoginAccountsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLoginAccount[]
     */
    protected $loginAccountsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->dev = true;
        $this->active = true;
    }

    /**
     * Initializes internal state of AUTH\Models\Base\LoginProvider object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>LoginProvider</code> instance.  If
     * <code>obj</code> is an instance of <code>LoginProvider</code>, delegates to
     * <code>equals(LoginProvider)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|LoginProvider The current object, for fluid interface
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
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
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
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
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
     * Get the [id_provider] column value.
     *
     * @return int
     */
    public function getIdProvider()
    {
        return $this->id_provider;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getName()
    {
        if (null === $this->name) {
            return null;
        }
        $valueSet = LoginProviderTableMap::getValueSet(LoginProviderTableMap::COL_NAME);
        if (!isset($valueSet[$this->name])) {
            throw new PropelException('Unknown stored enum key: ' . $this->name);
        }

        return $valueSet[$this->name];
    }

    /**
     * Get the [dev] column value.
     *
     * @return boolean
     */
    public function getDebug()
    {
        return $this->dev;
    }

    /**
     * Get the [dev] column value.
     *
     * @return boolean
     */
    public function isDebug()
    {
        return $this->getDebug();
    }

    /**
     * Get the [client] column value.
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get the [secret] column value.
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Get the [callback_url] column value.
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callback_url;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [accounts] column value.
     *
     * @return int
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Set the value of [id_provider] column.
     *
     * @param int $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setIdProvider($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_provider !== $v) {
            $this->id_provider = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_ID_PROVIDER] = true;
        }

        return $this;
    } // setIdProvider()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setName($v)
    {
        if ($v !== null) {
            $valueSet = LoginProviderTableMap::getValueSet(LoginProviderTableMap::COL_NAME);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Sets the value of the [dev] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setDebug($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->dev !== $v) {
            $this->dev = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_DEV] = true;
        }

        return $this;
    } // setDebug()

    /**
     * Set the value of [client] column.
     *
     * @param string $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setClient($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client !== $v) {
            $this->client = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_CLIENT] = true;
        }

        return $this;
    } // setClient()

    /**
     * Set the value of [secret] column.
     *
     * @param string $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setSecret($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->secret !== $v) {
            $this->secret = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_SECRET] = true;
        }

        return $this;
    } // setSecret()

    /**
     * Set the value of [callback_url] column.
     *
     * @param string $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setCallbackUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->callback_url !== $v) {
            $this->callback_url = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_CALLBACK_URL] = true;
        }

        return $this;
    } // setCallbackUrl()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginProviderTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginProviderTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [accounts] column.
     *
     * @param int $v new value
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function setAccounts($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accounts !== $v) {
            $this->accounts = $v;
            $this->modifiedColumns[LoginProviderTableMap::COL_ACCOUNTS] = true;
        }

        return $this;
    } // setAccounts()

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
            if ($this->dev !== true) {
                return false;
            }

            if ($this->active !== true) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LoginProviderTableMap::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_provider = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LoginProviderTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LoginProviderTableMap::translateFieldName('Debug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dev = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LoginProviderTableMap::translateFieldName('Client', TableMap::TYPE_PHPNAME, $indexType)];
            $this->client = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : LoginProviderTableMap::translateFieldName('Secret', TableMap::TYPE_PHPNAME, $indexType)];
            $this->secret = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : LoginProviderTableMap::translateFieldName('CallbackUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->callback_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : LoginProviderTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : LoginProviderTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : LoginProviderTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : LoginProviderTableMap::translateFieldName('Accounts', TableMap::TYPE_PHPNAME, $indexType)];
            $this->accounts = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = LoginProviderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\AUTH\\Models\\LoginProvider'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLoginProviderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLoginAccounts = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see LoginProvider::setDeleted()
     * @see LoginProvider::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLoginProviderQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(LoginProviderTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
                if (!$this->isColumnModified(LoginProviderTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(LoginProviderTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                LoginProviderTableMap::addInstanceToPool($this);
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

            if ($this->loginAccountsScheduledForDeletion !== null) {
                if (!$this->loginAccountsScheduledForDeletion->isEmpty()) {
                    \AUTH\Models\LoginAccountQuery::create()
                        ->filterByPrimaryKeys($this->loginAccountsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->loginAccountsScheduledForDeletion = null;
                }
            }

            if ($this->collLoginAccounts !== null) {
                foreach ($this->collLoginAccounts as $referrerFK) {
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

        $this->modifiedColumns[LoginProviderTableMap::COL_ID_PROVIDER] = true;
        if (null !== $this->id_provider) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LoginProviderTableMap::COL_ID_PROVIDER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LoginProviderTableMap::COL_ID_PROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'ID_PROVIDER';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'NAME';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_DEV)) {
            $modifiedColumns[':p' . $index++]  = 'DEV';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CLIENT)) {
            $modifiedColumns[':p' . $index++]  = 'CLIENT';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_SECRET)) {
            $modifiedColumns[':p' . $index++]  = 'SECRET';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CALLBACK_URL)) {
            $modifiedColumns[':p' . $index++]  = 'CALLBACK_URL';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVE';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_ACCOUNTS)) {
            $modifiedColumns[':p' . $index++]  = 'ACCOUNTS';
        }

        $sql = sprintf(
            'INSERT INTO AUTH_PROVIDERS (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID_PROVIDER':
                        $stmt->bindValue($identifier, $this->id_provider, PDO::PARAM_INT);
                        break;
                    case 'NAME':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_INT);
                        break;
                    case 'DEV':
                        $stmt->bindValue($identifier, (int) $this->dev, PDO::PARAM_INT);
                        break;
                    case 'CLIENT':
                        $stmt->bindValue($identifier, $this->client, PDO::PARAM_STR);
                        break;
                    case 'SECRET':
                        $stmt->bindValue($identifier, $this->secret, PDO::PARAM_STR);
                        break;
                    case 'CALLBACK_URL':
                        $stmt->bindValue($identifier, $this->callback_url, PDO::PARAM_STR);
                        break;
                    case 'ACTIVE':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ACCOUNTS':
                        $stmt->bindValue($identifier, $this->accounts, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdProvider($pk);

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
        $pos = LoginProviderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProvider();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getDebug();
                break;
            case 3:
                return $this->getClient();
                break;
            case 4:
                return $this->getSecret();
                break;
            case 5:
                return $this->getCallbackUrl();
                break;
            case 6:
                return $this->getActive();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
                return $this->getUpdatedAt();
                break;
            case 9:
                return $this->getAccounts();
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

        if (isset($alreadyDumpedObjects['LoginProvider'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LoginProvider'][$this->hashCode()] = true;
        $keys = LoginProviderTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdProvider(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDebug(),
            $keys[3] => $this->getClient(),
            $keys[4] => $this->getSecret(),
            $keys[5] => $this->getCallbackUrl(),
            $keys[6] => $this->getActive(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getAccounts(),
        );
        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLoginAccounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'loginAccounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'AUTH_ACCOUNTSs';
                        break;
                    default:
                        $key = 'LoginAccounts';
                }

                $result[$key] = $this->collLoginAccounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\AUTH\Models\LoginProvider
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LoginProviderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\AUTH\Models\LoginProvider
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdProvider($value);
                break;
            case 1:
                $valueSet = LoginProviderTableMap::getValueSet(LoginProviderTableMap::COL_NAME);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setName($value);
                break;
            case 2:
                $this->setDebug($value);
                break;
            case 3:
                $this->setClient($value);
                break;
            case 4:
                $this->setSecret($value);
                break;
            case 5:
                $this->setCallbackUrl($value);
                break;
            case 6:
                $this->setActive($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setAccounts($value);
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
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = LoginProviderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProvider($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDebug($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setClient($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSecret($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCallbackUrl($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setActive($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAccounts($arr[$keys[9]]);
        }
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
     * @return $this|\AUTH\Models\LoginProvider The current object, for fluid interface
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
        $criteria = new Criteria(LoginProviderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LoginProviderTableMap::COL_ID_PROVIDER)) {
            $criteria->add(LoginProviderTableMap::COL_ID_PROVIDER, $this->id_provider);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_NAME)) {
            $criteria->add(LoginProviderTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_DEV)) {
            $criteria->add(LoginProviderTableMap::COL_DEV, $this->dev);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CLIENT)) {
            $criteria->add(LoginProviderTableMap::COL_CLIENT, $this->client);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_SECRET)) {
            $criteria->add(LoginProviderTableMap::COL_SECRET, $this->secret);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CALLBACK_URL)) {
            $criteria->add(LoginProviderTableMap::COL_CALLBACK_URL, $this->callback_url);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_ACTIVE)) {
            $criteria->add(LoginProviderTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_CREATED_AT)) {
            $criteria->add(LoginProviderTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_UPDATED_AT)) {
            $criteria->add(LoginProviderTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(LoginProviderTableMap::COL_ACCOUNTS)) {
            $criteria->add(LoginProviderTableMap::COL_ACCOUNTS, $this->accounts);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildLoginProviderQuery::create();
        $criteria->add(LoginProviderTableMap::COL_ID_PROVIDER, $this->id_provider);

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
        $validPk = null !== $this->getIdProvider();

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
        return $this->getIdProvider();
    }

    /**
     * Generic method to set the primary key (id_provider column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdProvider($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdProvider();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \AUTH\Models\LoginProvider (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDebug($this->getDebug());
        $copyObj->setClient($this->getClient());
        $copyObj->setSecret($this->getSecret());
        $copyObj->setCallbackUrl($this->getCallbackUrl());
        $copyObj->setActive($this->getActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAccounts($this->getAccounts());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLoginAccounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLoginAccount($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProvider(NULL); // this is a auto-increment column, so set to default value
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
     * @return \AUTH\Models\LoginProvider Clone of current object.
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
        if ('LoginAccount' == $relationName) {
            return $this->initLoginAccounts();
        }
    }

    /**
     * Clears out the collLoginAccounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLoginAccounts()
     */
    public function clearLoginAccounts()
    {
        $this->collLoginAccounts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLoginAccounts collection loaded partially.
     */
    public function resetPartialLoginAccounts($v = true)
    {
        $this->collLoginAccountsPartial = $v;
    }

    /**
     * Initializes the collLoginAccounts collection.
     *
     * By default this just sets the collLoginAccounts collection to an empty array (like clearcollLoginAccounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLoginAccounts($overrideExisting = true)
    {
        if (null !== $this->collLoginAccounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = LoginAccountTableMap::getTableMap()->getCollectionClassName();

        $this->collLoginAccounts = new $collectionClassName;
        $this->collLoginAccounts->setModel('\AUTH\Models\LoginAccount');
    }

    /**
     * Gets an array of ChildLoginAccount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLoginProvider is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLoginAccount[] List of ChildLoginAccount objects
     * @throws PropelException
     */
    public function getLoginAccounts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginAccountsPartial && !$this->isNew();
        if (null === $this->collLoginAccounts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLoginAccounts) {
                // return empty collection
                $this->initLoginAccounts();
            } else {
                $collLoginAccounts = ChildLoginAccountQuery::create(null, $criteria)
                    ->filterByAccountProvider($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLoginAccountsPartial && count($collLoginAccounts)) {
                        $this->initLoginAccounts(false);

                        foreach ($collLoginAccounts as $obj) {
                            if (false == $this->collLoginAccounts->contains($obj)) {
                                $this->collLoginAccounts->append($obj);
                            }
                        }

                        $this->collLoginAccountsPartial = true;
                    }

                    return $collLoginAccounts;
                }

                if ($partial && $this->collLoginAccounts) {
                    foreach ($this->collLoginAccounts as $obj) {
                        if ($obj->isNew()) {
                            $collLoginAccounts[] = $obj;
                        }
                    }
                }

                $this->collLoginAccounts = $collLoginAccounts;
                $this->collLoginAccountsPartial = false;
            }
        }

        return $this->collLoginAccounts;
    }

    /**
     * Sets a collection of ChildLoginAccount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $loginAccounts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLoginProvider The current object (for fluent API support)
     */
    public function setLoginAccounts(Collection $loginAccounts, ConnectionInterface $con = null)
    {
        /** @var ChildLoginAccount[] $loginAccountsToDelete */
        $loginAccountsToDelete = $this->getLoginAccounts(new Criteria(), $con)->diff($loginAccounts);


        $this->loginAccountsScheduledForDeletion = $loginAccountsToDelete;

        foreach ($loginAccountsToDelete as $loginAccountRemoved) {
            $loginAccountRemoved->setAccountProvider(null);
        }

        $this->collLoginAccounts = null;
        foreach ($loginAccounts as $loginAccount) {
            $this->addLoginAccount($loginAccount);
        }

        $this->collLoginAccounts = $loginAccounts;
        $this->collLoginAccountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LoginAccount objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LoginAccount objects.
     * @throws PropelException
     */
    public function countLoginAccounts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginAccountsPartial && !$this->isNew();
        if (null === $this->collLoginAccounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLoginAccounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLoginAccounts());
            }

            $query = ChildLoginAccountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccountProvider($this)
                ->count($con);
        }

        return count($this->collLoginAccounts);
    }

    /**
     * Method called to associate a ChildLoginAccount object to this object
     * through the ChildLoginAccount foreign key attribute.
     *
     * @param  ChildLoginAccount $l ChildLoginAccount
     * @return $this|\AUTH\Models\LoginProvider The current object (for fluent API support)
     */
    public function addLoginAccount(ChildLoginAccount $l)
    {
        if ($this->collLoginAccounts === null) {
            $this->initLoginAccounts();
            $this->collLoginAccountsPartial = true;
        }

        if (!$this->collLoginAccounts->contains($l)) {
            $this->doAddLoginAccount($l);

            if ($this->loginAccountsScheduledForDeletion and $this->loginAccountsScheduledForDeletion->contains($l)) {
                $this->loginAccountsScheduledForDeletion->remove($this->loginAccountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLoginAccount $loginAccount The ChildLoginAccount object to add.
     */
    protected function doAddLoginAccount(ChildLoginAccount $loginAccount)
    {
        $this->collLoginAccounts[]= $loginAccount;
        $loginAccount->setAccountProvider($this);
    }

    /**
     * @param  ChildLoginAccount $loginAccount The ChildLoginAccount object to remove.
     * @return $this|ChildLoginProvider The current object (for fluent API support)
     */
    public function removeLoginAccount(ChildLoginAccount $loginAccount)
    {
        if ($this->getLoginAccounts()->contains($loginAccount)) {
            $pos = $this->collLoginAccounts->search($loginAccount);
            $this->collLoginAccounts->remove($pos);
            if (null === $this->loginAccountsScheduledForDeletion) {
                $this->loginAccountsScheduledForDeletion = clone $this->collLoginAccounts;
                $this->loginAccountsScheduledForDeletion->clear();
            }
            $this->loginAccountsScheduledForDeletion[]= clone $loginAccount;
            $loginAccount->setAccountProvider(null);
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
        $this->id_provider = null;
        $this->name = null;
        $this->dev = null;
        $this->client = null;
        $this->secret = null;
        $this->callback_url = null;
        $this->active = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->accounts = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collLoginAccounts) {
                foreach ($this->collLoginAccounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLoginAccounts = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LoginProviderTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildLoginProvider The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[LoginProviderTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // aggregate_column behavior

    /**
     * Computes the value of the aggregate column ACCOUNTS *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeAccounts(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(ID_ACCOUNT) FROM AUTH_ACCOUNTS WHERE AUTH_ACCOUNTS.ID_PROVIDER = :p1');
        $stmt->bindValue(':p1', $this->getIdProvider());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column ACCOUNTS *
     * @param ConnectionInterface $con A connection object
     */
    public function updateAccounts(ConnectionInterface $con)
    {
        $this->setAccounts($this->computeAccounts($con));
        $this->save($con);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
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

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
