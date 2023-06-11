<?php

namespace AUTH\Models\Base;

use \DateTime;
use \Exception;
use \PDO;
use AUTH\Models\LoginAccount as ChildLoginAccount;
use AUTH\Models\LoginAccountPassword as ChildLoginAccountPassword;
use AUTH\Models\LoginAccountPasswordQuery as ChildLoginAccountPasswordQuery;
use AUTH\Models\LoginAccountQuery as ChildLoginAccountQuery;
use AUTH\Models\LoginProvider as ChildLoginProvider;
use AUTH\Models\LoginProviderQuery as ChildLoginProviderQuery;
use AUTH\Models\LoginSession as ChildLoginSession;
use AUTH\Models\LoginSessionQuery as ChildLoginSessionQuery;
use AUTH\Models\Map\LoginAccountPasswordTableMap;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Models\Map\LoginSessionTableMap;
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
 * Base class that represents a row from the 'AUTH_ACCOUNTS' table.
 *
 * Table with the login accounts
 *
 * @package    propel.generator.AUTH.Models.Base
 */
abstract class LoginAccount implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\AUTH\\Models\\Map\\LoginAccountTableMap';


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
     * The value for the id_account field.
     *
     * @var        int
     */
    protected $id_account;

    /**
     * The value for the id_provider field.
     *
     * @var        int
     */
    protected $id_provider;

    /**
     * The value for the identifier field.
     *
     * @var        string
     */
    protected $identifier;

    /**
     * The value for the email field.
     *
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the access_token field.
     *
     * @var        string
     */
    protected $access_token;

    /**
     * The value for the refresh_token field.
     *
     * @var        string|null
     */
    protected $refresh_token;

    /**
     * The value for the expires field.
     *
     * @var        DateTime|null
     */
    protected $expires;

    /**
     * The value for the role field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $role;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $active;

    /**
     * The value for the verified field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $verified;

    /**
     * The value for the refresh_requested field.
     *
     * @var        DateTime|null
     */
    protected $refresh_requested;

    /**
     * The value for the reset_token field.
     *
     * @var        string|null
     */
    protected $reset_token;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        ChildLoginProvider
     */
    protected $aAccountProvider;

    /**
     * @var        ObjectCollection|ChildLoginAccountPassword[] Collection to store aggregation of ChildLoginAccountPassword objects.
     */
    protected $collLoginAccountPasswords;
    protected $collLoginAccountPasswordsPartial;

    /**
     * @var        ObjectCollection|ChildLoginSession[] Collection to store aggregation of ChildLoginSession objects.
     */
    protected $collLoginSessions;
    protected $collLoginSessionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // aggregate_column_relation_aggregate_column behavior
    /**
     * @var ChildLoginProvider
     */
    protected $oldAccountProviderAccounts;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLoginAccountPassword[]
     */
    protected $loginAccountPasswordsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLoginSession[]
     */
    protected $loginSessionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->role = 0;
        $this->active = true;
        $this->verified = false;
    }

    /**
     * Initializes internal state of AUTH\Models\Base\LoginAccount object.
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
     * Compares this with another <code>LoginAccount</code> instance.  If
     * <code>obj</code> is an instance of <code>LoginAccount</code>, delegates to
     * <code>equals(LoginAccount)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_account] column value.
     *
     * @return int
     */
    public function getIdAccount()
    {
        return $this->id_account;
    }

    /**
     * Get the [id_provider] column value.
     *
     * @return int
     */
    public function getIdSocial()
    {
        return $this->id_provider;
    }

    /**
     * Get the [identifier] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->identifier;
    }

    /**
     * Get the [email] column value.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [access_token] column value.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Get the [refresh_token] column value.
     *
     * @return string|null
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Get the [optionally formatted] temporal [expires] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpireDate($format = null)
    {
        if ($format === null) {
            return $this->expires;
        } else {
            return $this->expires instanceof \DateTimeInterface ? $this->expires->format($format) : null;
        }
    }

    /**
     * Get the [role] column value.
     *
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAccountRole()
    {
        if (null === $this->role) {
            return null;
        }
        $valueSet = LoginAccountTableMap::getValueSet(LoginAccountTableMap::COL_ROLE);
        if (!isset($valueSet[$this->role])) {
            throw new PropelException('Unknown stored enum key: ' . $this->role);
        }

        return $valueSet[$this->role];
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean|null
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [verified] column value.
     *
     * @return boolean|null
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the [verified] column value.
     *
     * @return boolean|null
     */
    public function isVerified()
    {
        return $this->getVerified();
    }

    /**
     * Get the [optionally formatted] temporal [refresh_requested] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRefreshRequest($format = null)
    {
        if ($format === null) {
            return $this->refresh_requested;
        } else {
            return $this->refresh_requested instanceof \DateTimeInterface ? $this->refresh_requested->format($format) : null;
        }
    }

    /**
     * Get the [reset_token] column value.
     *
     * @return string|null
     */
    public function getResetToken()
    {
        return $this->reset_token;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = null)
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
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id_account] column.
     *
     * @param int $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setIdAccount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_account !== $v) {
            $this->id_account = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_ID_ACCOUNT] = true;
        }

        return $this;
    } // setIdAccount()

    /**
     * Set the value of [id_provider] column.
     *
     * @param int $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setIdSocial($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_provider !== $v) {
            $this->id_provider = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_ID_PROVIDER] = true;
        }

        if ($this->aAccountProvider !== null && $this->aAccountProvider->getIdProvider() !== $v) {
            $this->aAccountProvider = null;
        }

        return $this;
    } // setIdSocial()

    /**
     * Set the value of [identifier] column.
     *
     * @param string $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->identifier !== $v) {
            $this->identifier = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_IDENTIFIER] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [email] column.
     *
     * @param string|null $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [access_token] column.
     *
     * @param string $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setAccessToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->access_token !== $v) {
            $this->access_token = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_ACCESS_TOKEN] = true;
        }

        return $this;
    } // setAccessToken()

    /**
     * Set the value of [refresh_token] column.
     *
     * @param string|null $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setRefreshToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->refresh_token !== $v) {
            $this->refresh_token = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_REFRESH_TOKEN] = true;
        }

        return $this;
    } // setRefreshToken()

    /**
     * Sets the value of [expires] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setExpireDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expires !== null || $dt !== null) {
            if ($this->expires === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->expires->format("Y-m-d H:i:s.u")) {
                $this->expires = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginAccountTableMap::COL_EXPIRES] = true;
            }
        } // if either are not null

        return $this;
    } // setExpireDate()

    /**
     * Set the value of [role] column.
     *
     * @param  string|null $v new value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setAccountRole($v)
    {
        if ($v !== null) {
            $valueSet = LoginAccountTableMap::getValueSet(LoginAccountTableMap::COL_ROLE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_ROLE] = true;
        }

        return $this;
    } // setAccountRole()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string|null $v The new value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
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
            $this->modifiedColumns[LoginAccountTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Sets the value of the [verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string|null $v The new value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->verified !== $v) {
            $this->verified = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_VERIFIED] = true;
        }

        return $this;
    } // setVerified()

    /**
     * Sets the value of [refresh_requested] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setRefreshRequest($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->refresh_requested !== null || $dt !== null) {
            if ($this->refresh_requested === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->refresh_requested->format("Y-m-d H:i:s.u")) {
                $this->refresh_requested = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginAccountTableMap::COL_REFRESH_REQUESTED] = true;
            }
        } // if either are not null

        return $this;
    } // setRefreshRequest()

    /**
     * Set the value of [reset_token] column.
     *
     * @param string|null $v New value
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setResetToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reset_token !== $v) {
            $this->reset_token = $v;
            $this->modifiedColumns[LoginAccountTableMap::COL_RESET_TOKEN] = true;
        }

        return $this;
    } // setResetToken()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginAccountTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LoginAccountTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

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
            if ($this->role !== 0) {
                return false;
            }

            if ($this->active !== true) {
                return false;
            }

            if ($this->verified !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LoginAccountTableMap::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_account = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LoginAccountTableMap::translateFieldName('IdSocial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_provider = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LoginAccountTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->identifier = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LoginAccountTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : LoginAccountTableMap::translateFieldName('AccessToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->access_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : LoginAccountTableMap::translateFieldName('RefreshToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->refresh_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : LoginAccountTableMap::translateFieldName('ExpireDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->expires = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : LoginAccountTableMap::translateFieldName('AccountRole', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : LoginAccountTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : LoginAccountTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : LoginAccountTableMap::translateFieldName('RefreshRequest', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->refresh_requested = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : LoginAccountTableMap::translateFieldName('ResetToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reset_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : LoginAccountTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : LoginAccountTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = LoginAccountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\AUTH\\Models\\LoginAccount'), 0, $e);
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
        if ($this->aAccountProvider !== null && $this->id_provider !== $this->aAccountProvider->getIdProvider()) {
            $this->aAccountProvider = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLoginAccountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAccountProvider = null;
            $this->collLoginAccountPasswords = null;

            $this->collLoginSessions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see LoginAccount::setDeleted()
     * @see LoginAccount::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLoginAccountQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(LoginAccountTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(LoginAccountTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(LoginAccountTableMap::COL_UPDATED_AT)) {
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
                // aggregate_column_relation_aggregate_column behavior
                $this->updateRelatedAccountProviderAccounts($con);
                LoginAccountTableMap::addInstanceToPool($this);
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

            if ($this->aAccountProvider !== null) {
                if ($this->aAccountProvider->isModified() || $this->aAccountProvider->isNew()) {
                    $affectedRows += $this->aAccountProvider->save($con);
                }
                $this->setAccountProvider($this->aAccountProvider);
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

            if ($this->loginAccountPasswordsScheduledForDeletion !== null) {
                if (!$this->loginAccountPasswordsScheduledForDeletion->isEmpty()) {
                    \AUTH\Models\LoginAccountPasswordQuery::create()
                        ->filterByPrimaryKeys($this->loginAccountPasswordsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->loginAccountPasswordsScheduledForDeletion = null;
                }
            }

            if ($this->collLoginAccountPasswords !== null) {
                foreach ($this->collLoginAccountPasswords as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->loginSessionsScheduledForDeletion !== null) {
                if (!$this->loginSessionsScheduledForDeletion->isEmpty()) {
                    \AUTH\Models\LoginSessionQuery::create()
                        ->filterByPrimaryKeys($this->loginSessionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->loginSessionsScheduledForDeletion = null;
                }
            }

            if ($this->collLoginSessions !== null) {
                foreach ($this->collLoginSessions as $referrerFK) {
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

        $this->modifiedColumns[LoginAccountTableMap::COL_ID_ACCOUNT] = true;
        if (null !== $this->id_account) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LoginAccountTableMap::COL_ID_ACCOUNT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LoginAccountTableMap::COL_ID_ACCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'ID_ACCOUNT';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ID_PROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'ID_PROVIDER';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_IDENTIFIER)) {
            $modifiedColumns[':p' . $index++]  = 'IDENTIFIER';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ACCESS_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'ACCESS_TOKEN';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_REFRESH_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'REFRESH_TOKEN';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_EXPIRES)) {
            $modifiedColumns[':p' . $index++]  = 'EXPIRES';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ROLE)) {
            $modifiedColumns[':p' . $index++]  = 'ROLE';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVE';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'VERIFIED';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_REFRESH_REQUESTED)) {
            $modifiedColumns[':p' . $index++]  = 'REFRESH_REQUESTED';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_RESET_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'RESET_TOKEN';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO AUTH_ACCOUNTS (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID_ACCOUNT':
                        $stmt->bindValue($identifier, $this->id_account, PDO::PARAM_INT);
                        break;
                    case 'ID_PROVIDER':
                        $stmt->bindValue($identifier, $this->id_provider, PDO::PARAM_INT);
                        break;
                    case 'IDENTIFIER':
                        $stmt->bindValue($identifier, $this->identifier, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'ACCESS_TOKEN':
                        $stmt->bindValue($identifier, $this->access_token, PDO::PARAM_STR);
                        break;
                    case 'REFRESH_TOKEN':
                        $stmt->bindValue($identifier, $this->refresh_token, PDO::PARAM_STR);
                        break;
                    case 'EXPIRES':
                        $stmt->bindValue($identifier, $this->expires ? $this->expires->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ROLE':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_INT);
                        break;
                    case 'ACTIVE':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case 'VERIFIED':
                        $stmt->bindValue($identifier, (int) $this->verified, PDO::PARAM_INT);
                        break;
                    case 'REFRESH_REQUESTED':
                        $stmt->bindValue($identifier, $this->refresh_requested ? $this->refresh_requested->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'RESET_TOKEN':
                        $stmt->bindValue($identifier, $this->reset_token, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $this->setIdAccount($pk);

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
        $pos = LoginAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAccount();
                break;
            case 1:
                return $this->getIdSocial();
                break;
            case 2:
                return $this->getId();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getAccessToken();
                break;
            case 5:
                return $this->getRefreshToken();
                break;
            case 6:
                return $this->getExpireDate();
                break;
            case 7:
                return $this->getAccountRole();
                break;
            case 8:
                return $this->getActive();
                break;
            case 9:
                return $this->getVerified();
                break;
            case 10:
                return $this->getRefreshRequest();
                break;
            case 11:
                return $this->getResetToken();
                break;
            case 12:
                return $this->getCreatedAt();
                break;
            case 13:
                return $this->getUpdatedAt();
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

        if (isset($alreadyDumpedObjects['LoginAccount'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LoginAccount'][$this->hashCode()] = true;
        $keys = LoginAccountTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdAccount(),
            $keys[1] => $this->getIdSocial(),
            $keys[2] => $this->getId(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getAccessToken(),
            $keys[5] => $this->getRefreshToken(),
            $keys[6] => $this->getExpireDate(),
            $keys[7] => $this->getAccountRole(),
            $keys[8] => $this->getActive(),
            $keys[9] => $this->getVerified(),
            $keys[10] => $this->getRefreshRequest(),
            $keys[11] => $this->getResetToken(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
        );
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAccountProvider) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'loginProvider';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'AUTH_PROVIDERS';
                        break;
                    default:
                        $key = 'AccountProvider';
                }

                $result[$key] = $this->aAccountProvider->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLoginAccountPasswords) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'loginAccountPasswords';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'AUTH_ACCOUNT_PASSWORDSs';
                        break;
                    default:
                        $key = 'LoginAccountPasswords';
                }

                $result[$key] = $this->collLoginAccountPasswords->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLoginSessions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'loginSessions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'AUTH_SESSIONSs';
                        break;
                    default:
                        $key = 'LoginSessions';
                }

                $result[$key] = $this->collLoginSessions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\AUTH\Models\LoginAccount
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LoginAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\AUTH\Models\LoginAccount
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdAccount($value);
                break;
            case 1:
                $this->setIdSocial($value);
                break;
            case 2:
                $this->setId($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setAccessToken($value);
                break;
            case 5:
                $this->setRefreshToken($value);
                break;
            case 6:
                $this->setExpireDate($value);
                break;
            case 7:
                $valueSet = LoginAccountTableMap::getValueSet(LoginAccountTableMap::COL_ROLE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setAccountRole($value);
                break;
            case 8:
                $this->setActive($value);
                break;
            case 9:
                $this->setVerified($value);
                break;
            case 10:
                $this->setRefreshRequest($value);
                break;
            case 11:
                $this->setResetToken($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
                $this->setUpdatedAt($value);
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
        $keys = LoginAccountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdAccount($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdSocial($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAccessToken($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRefreshToken($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExpireDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAccountRole($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setActive($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setVerified($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRefreshRequest($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setResetToken($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUpdatedAt($arr[$keys[13]]);
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
     * @return $this|\AUTH\Models\LoginAccount The current object, for fluid interface
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
        $criteria = new Criteria(LoginAccountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LoginAccountTableMap::COL_ID_ACCOUNT)) {
            $criteria->add(LoginAccountTableMap::COL_ID_ACCOUNT, $this->id_account);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ID_PROVIDER)) {
            $criteria->add(LoginAccountTableMap::COL_ID_PROVIDER, $this->id_provider);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_IDENTIFIER)) {
            $criteria->add(LoginAccountTableMap::COL_IDENTIFIER, $this->identifier);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_EMAIL)) {
            $criteria->add(LoginAccountTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ACCESS_TOKEN)) {
            $criteria->add(LoginAccountTableMap::COL_ACCESS_TOKEN, $this->access_token);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_REFRESH_TOKEN)) {
            $criteria->add(LoginAccountTableMap::COL_REFRESH_TOKEN, $this->refresh_token);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_EXPIRES)) {
            $criteria->add(LoginAccountTableMap::COL_EXPIRES, $this->expires);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ROLE)) {
            $criteria->add(LoginAccountTableMap::COL_ROLE, $this->role);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_ACTIVE)) {
            $criteria->add(LoginAccountTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_VERIFIED)) {
            $criteria->add(LoginAccountTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_REFRESH_REQUESTED)) {
            $criteria->add(LoginAccountTableMap::COL_REFRESH_REQUESTED, $this->refresh_requested);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_RESET_TOKEN)) {
            $criteria->add(LoginAccountTableMap::COL_RESET_TOKEN, $this->reset_token);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_CREATED_AT)) {
            $criteria->add(LoginAccountTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(LoginAccountTableMap::COL_UPDATED_AT)) {
            $criteria->add(LoginAccountTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildLoginAccountQuery::create();
        $criteria->add(LoginAccountTableMap::COL_ID_ACCOUNT, $this->id_account);

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
        $validPk = null !== $this->getIdAccount();

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
        return $this->getIdAccount();
    }

    /**
     * Generic method to set the primary key (id_account column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdAccount($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdAccount();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \AUTH\Models\LoginAccount (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdSocial($this->getIdSocial());
        $copyObj->setId($this->getId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAccessToken($this->getAccessToken());
        $copyObj->setRefreshToken($this->getRefreshToken());
        $copyObj->setExpireDate($this->getExpireDate());
        $copyObj->setAccountRole($this->getAccountRole());
        $copyObj->setActive($this->getActive());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setRefreshRequest($this->getRefreshRequest());
        $copyObj->setResetToken($this->getResetToken());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLoginAccountPasswords() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLoginAccountPassword($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLoginSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLoginSession($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAccount(NULL); // this is a auto-increment column, so set to default value
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
     * @return \AUTH\Models\LoginAccount Clone of current object.
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
     * Declares an association between this object and a ChildLoginProvider object.
     *
     * @param  ChildLoginProvider $v
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAccountProvider(ChildLoginProvider $v = null)
    {
        // aggregate_column_relation behavior
        if (null !== $this->aAccountProvider && $v !== $this->aAccountProvider) {
            $this->oldAccountProviderAccounts = $this->aAccountProvider;
        }
        if ($v === null) {
            $this->setIdSocial(NULL);
        } else {
            $this->setIdSocial($v->getIdProvider());
        }

        $this->aAccountProvider = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLoginProvider object, it will not be re-added.
        if ($v !== null) {
            $v->addLoginAccount($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLoginProvider object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLoginProvider The associated ChildLoginProvider object.
     * @throws PropelException
     */
    public function getAccountProvider(ConnectionInterface $con = null)
    {
        if ($this->aAccountProvider === null && ($this->id_provider != 0)) {
            $this->aAccountProvider = ChildLoginProviderQuery::create()->findPk($this->id_provider, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAccountProvider->addLoginAccounts($this);
             */
        }

        return $this->aAccountProvider;
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
        if ('LoginAccountPassword' === $relationName) {
            $this->initLoginAccountPasswords();
            return;
        }
        if ('LoginSession' === $relationName) {
            $this->initLoginSessions();
            return;
        }
    }

    /**
     * Clears out the collLoginAccountPasswords collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLoginAccountPasswords()
     */
    public function clearLoginAccountPasswords()
    {
        $this->collLoginAccountPasswords = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLoginAccountPasswords collection loaded partially.
     */
    public function resetPartialLoginAccountPasswords($v = true)
    {
        $this->collLoginAccountPasswordsPartial = $v;
    }

    /**
     * Initializes the collLoginAccountPasswords collection.
     *
     * By default this just sets the collLoginAccountPasswords collection to an empty array (like clearcollLoginAccountPasswords());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLoginAccountPasswords($overrideExisting = true)
    {
        if (null !== $this->collLoginAccountPasswords && !$overrideExisting) {
            return;
        }

        $collectionClassName = LoginAccountPasswordTableMap::getTableMap()->getCollectionClassName();

        $this->collLoginAccountPasswords = new $collectionClassName;
        $this->collLoginAccountPasswords->setModel('\AUTH\Models\LoginAccountPassword');
    }

    /**
     * Gets an array of ChildLoginAccountPassword objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLoginAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLoginAccountPassword[] List of ChildLoginAccountPassword objects
     * @throws PropelException
     */
    public function getLoginAccountPasswords(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginAccountPasswordsPartial && !$this->isNew();
        if (null === $this->collLoginAccountPasswords || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLoginAccountPasswords) {
                    $this->initLoginAccountPasswords();
                } else {
                    $collectionClassName = LoginAccountPasswordTableMap::getTableMap()->getCollectionClassName();

                    $collLoginAccountPasswords = new $collectionClassName;
                    $collLoginAccountPasswords->setModel('\AUTH\Models\LoginAccountPassword');

                    return $collLoginAccountPasswords;
                }
            } else {
                $collLoginAccountPasswords = ChildLoginAccountPasswordQuery::create(null, $criteria)
                    ->filterByAccountPasswords($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLoginAccountPasswordsPartial && count($collLoginAccountPasswords)) {
                        $this->initLoginAccountPasswords(false);

                        foreach ($collLoginAccountPasswords as $obj) {
                            if (false == $this->collLoginAccountPasswords->contains($obj)) {
                                $this->collLoginAccountPasswords->append($obj);
                            }
                        }

                        $this->collLoginAccountPasswordsPartial = true;
                    }

                    return $collLoginAccountPasswords;
                }

                if ($partial && $this->collLoginAccountPasswords) {
                    foreach ($this->collLoginAccountPasswords as $obj) {
                        if ($obj->isNew()) {
                            $collLoginAccountPasswords[] = $obj;
                        }
                    }
                }

                $this->collLoginAccountPasswords = $collLoginAccountPasswords;
                $this->collLoginAccountPasswordsPartial = false;
            }
        }

        return $this->collLoginAccountPasswords;
    }

    /**
     * Sets a collection of ChildLoginAccountPassword objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $loginAccountPasswords A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLoginAccount The current object (for fluent API support)
     */
    public function setLoginAccountPasswords(Collection $loginAccountPasswords, ConnectionInterface $con = null)
    {
        /** @var ChildLoginAccountPassword[] $loginAccountPasswordsToDelete */
        $loginAccountPasswordsToDelete = $this->getLoginAccountPasswords(new Criteria(), $con)->diff($loginAccountPasswords);


        $this->loginAccountPasswordsScheduledForDeletion = $loginAccountPasswordsToDelete;

        foreach ($loginAccountPasswordsToDelete as $loginAccountPasswordRemoved) {
            $loginAccountPasswordRemoved->setAccountPasswords(null);
        }

        $this->collLoginAccountPasswords = null;
        foreach ($loginAccountPasswords as $loginAccountPassword) {
            $this->addLoginAccountPassword($loginAccountPassword);
        }

        $this->collLoginAccountPasswords = $loginAccountPasswords;
        $this->collLoginAccountPasswordsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LoginAccountPassword objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LoginAccountPassword objects.
     * @throws PropelException
     */
    public function countLoginAccountPasswords(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginAccountPasswordsPartial && !$this->isNew();
        if (null === $this->collLoginAccountPasswords || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLoginAccountPasswords) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLoginAccountPasswords());
            }

            $query = ChildLoginAccountPasswordQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccountPasswords($this)
                ->count($con);
        }

        return count($this->collLoginAccountPasswords);
    }

    /**
     * Method called to associate a ChildLoginAccountPassword object to this object
     * through the ChildLoginAccountPassword foreign key attribute.
     *
     * @param  ChildLoginAccountPassword $l ChildLoginAccountPassword
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function addLoginAccountPassword(ChildLoginAccountPassword $l)
    {
        if ($this->collLoginAccountPasswords === null) {
            $this->initLoginAccountPasswords();
            $this->collLoginAccountPasswordsPartial = true;
        }

        if (!$this->collLoginAccountPasswords->contains($l)) {
            $this->doAddLoginAccountPassword($l);

            if ($this->loginAccountPasswordsScheduledForDeletion and $this->loginAccountPasswordsScheduledForDeletion->contains($l)) {
                $this->loginAccountPasswordsScheduledForDeletion->remove($this->loginAccountPasswordsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLoginAccountPassword $loginAccountPassword The ChildLoginAccountPassword object to add.
     */
    protected function doAddLoginAccountPassword(ChildLoginAccountPassword $loginAccountPassword)
    {
        $this->collLoginAccountPasswords[]= $loginAccountPassword;
        $loginAccountPassword->setAccountPasswords($this);
    }

    /**
     * @param  ChildLoginAccountPassword $loginAccountPassword The ChildLoginAccountPassword object to remove.
     * @return $this|ChildLoginAccount The current object (for fluent API support)
     */
    public function removeLoginAccountPassword(ChildLoginAccountPassword $loginAccountPassword)
    {
        if ($this->getLoginAccountPasswords()->contains($loginAccountPassword)) {
            $pos = $this->collLoginAccountPasswords->search($loginAccountPassword);
            $this->collLoginAccountPasswords->remove($pos);
            if (null === $this->loginAccountPasswordsScheduledForDeletion) {
                $this->loginAccountPasswordsScheduledForDeletion = clone $this->collLoginAccountPasswords;
                $this->loginAccountPasswordsScheduledForDeletion->clear();
            }
            $this->loginAccountPasswordsScheduledForDeletion[]= clone $loginAccountPassword;
            $loginAccountPassword->setAccountPasswords(null);
        }

        return $this;
    }

    /**
     * Clears out the collLoginSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLoginSessions()
     */
    public function clearLoginSessions()
    {
        $this->collLoginSessions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLoginSessions collection loaded partially.
     */
    public function resetPartialLoginSessions($v = true)
    {
        $this->collLoginSessionsPartial = $v;
    }

    /**
     * Initializes the collLoginSessions collection.
     *
     * By default this just sets the collLoginSessions collection to an empty array (like clearcollLoginSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLoginSessions($overrideExisting = true)
    {
        if (null !== $this->collLoginSessions && !$overrideExisting) {
            return;
        }

        $collectionClassName = LoginSessionTableMap::getTableMap()->getCollectionClassName();

        $this->collLoginSessions = new $collectionClassName;
        $this->collLoginSessions->setModel('\AUTH\Models\LoginSession');
    }

    /**
     * Gets an array of ChildLoginSession objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLoginAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLoginSession[] List of ChildLoginSession objects
     * @throws PropelException
     */
    public function getLoginSessions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginSessionsPartial && !$this->isNew();
        if (null === $this->collLoginSessions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLoginSessions) {
                    $this->initLoginSessions();
                } else {
                    $collectionClassName = LoginSessionTableMap::getTableMap()->getCollectionClassName();

                    $collLoginSessions = new $collectionClassName;
                    $collLoginSessions->setModel('\AUTH\Models\LoginSession');

                    return $collLoginSessions;
                }
            } else {
                $collLoginSessions = ChildLoginSessionQuery::create(null, $criteria)
                    ->filterByAccountSession($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLoginSessionsPartial && count($collLoginSessions)) {
                        $this->initLoginSessions(false);

                        foreach ($collLoginSessions as $obj) {
                            if (false == $this->collLoginSessions->contains($obj)) {
                                $this->collLoginSessions->append($obj);
                            }
                        }

                        $this->collLoginSessionsPartial = true;
                    }

                    return $collLoginSessions;
                }

                if ($partial && $this->collLoginSessions) {
                    foreach ($this->collLoginSessions as $obj) {
                        if ($obj->isNew()) {
                            $collLoginSessions[] = $obj;
                        }
                    }
                }

                $this->collLoginSessions = $collLoginSessions;
                $this->collLoginSessionsPartial = false;
            }
        }

        return $this->collLoginSessions;
    }

    /**
     * Sets a collection of ChildLoginSession objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $loginSessions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLoginAccount The current object (for fluent API support)
     */
    public function setLoginSessions(Collection $loginSessions, ConnectionInterface $con = null)
    {
        /** @var ChildLoginSession[] $loginSessionsToDelete */
        $loginSessionsToDelete = $this->getLoginSessions(new Criteria(), $con)->diff($loginSessions);


        $this->loginSessionsScheduledForDeletion = $loginSessionsToDelete;

        foreach ($loginSessionsToDelete as $loginSessionRemoved) {
            $loginSessionRemoved->setAccountSession(null);
        }

        $this->collLoginSessions = null;
        foreach ($loginSessions as $loginSession) {
            $this->addLoginSession($loginSession);
        }

        $this->collLoginSessions = $loginSessions;
        $this->collLoginSessionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LoginSession objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LoginSession objects.
     * @throws PropelException
     */
    public function countLoginSessions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLoginSessionsPartial && !$this->isNew();
        if (null === $this->collLoginSessions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLoginSessions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLoginSessions());
            }

            $query = ChildLoginSessionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccountSession($this)
                ->count($con);
        }

        return count($this->collLoginSessions);
    }

    /**
     * Method called to associate a ChildLoginSession object to this object
     * through the ChildLoginSession foreign key attribute.
     *
     * @param  ChildLoginSession $l ChildLoginSession
     * @return $this|\AUTH\Models\LoginAccount The current object (for fluent API support)
     */
    public function addLoginSession(ChildLoginSession $l)
    {
        if ($this->collLoginSessions === null) {
            $this->initLoginSessions();
            $this->collLoginSessionsPartial = true;
        }

        if (!$this->collLoginSessions->contains($l)) {
            $this->doAddLoginSession($l);

            if ($this->loginSessionsScheduledForDeletion and $this->loginSessionsScheduledForDeletion->contains($l)) {
                $this->loginSessionsScheduledForDeletion->remove($this->loginSessionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLoginSession $loginSession The ChildLoginSession object to add.
     */
    protected function doAddLoginSession(ChildLoginSession $loginSession)
    {
        $this->collLoginSessions[]= $loginSession;
        $loginSession->setAccountSession($this);
    }

    /**
     * @param  ChildLoginSession $loginSession The ChildLoginSession object to remove.
     * @return $this|ChildLoginAccount The current object (for fluent API support)
     */
    public function removeLoginSession(ChildLoginSession $loginSession)
    {
        if ($this->getLoginSessions()->contains($loginSession)) {
            $pos = $this->collLoginSessions->search($loginSession);
            $this->collLoginSessions->remove($pos);
            if (null === $this->loginSessionsScheduledForDeletion) {
                $this->loginSessionsScheduledForDeletion = clone $this->collLoginSessions;
                $this->loginSessionsScheduledForDeletion->clear();
            }
            $this->loginSessionsScheduledForDeletion[]= clone $loginSession;
            $loginSession->setAccountSession(null);
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
        if (null !== $this->aAccountProvider) {
            $this->aAccountProvider->removeLoginAccount($this);
        }
        $this->id_account = null;
        $this->id_provider = null;
        $this->identifier = null;
        $this->email = null;
        $this->access_token = null;
        $this->refresh_token = null;
        $this->expires = null;
        $this->role = null;
        $this->active = null;
        $this->verified = null;
        $this->refresh_requested = null;
        $this->reset_token = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collLoginAccountPasswords) {
                foreach ($this->collLoginAccountPasswords as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLoginSessions) {
                foreach ($this->collLoginSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLoginAccountPasswords = null;
        $this->collLoginSessions = null;
        $this->aAccountProvider = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LoginAccountTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildLoginAccount The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[LoginAccountTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // aggregate_column_relation_aggregate_column behavior

    /**
     * Update the aggregate column in the related AccountProvider object
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function updateRelatedAccountProviderAccounts(ConnectionInterface $con)
    {
        if ($accountProvider = $this->getAccountProvider()) {
            $accountProvider->updateAccounts($con);
        }
        if ($this->oldAccountProviderAccounts) {
            $this->oldAccountProviderAccounts->updateAccounts($con);
            $this->oldAccountProviderAccounts = null;
        }
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
