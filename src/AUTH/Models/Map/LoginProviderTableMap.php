<?php

namespace AUTH\Models\Map;

use AUTH\Models\LoginProvider;
use AUTH\Models\LoginProviderQuery;
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
 * This class defines the structure of the 'AUTH_PROVIDERS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LoginProviderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'AUTH.Models.Map.LoginProviderTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'AUTH_PROVIDERS';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LoginProvider';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\AUTH\\Models\\LoginProvider';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'AUTH.Models.LoginProvider';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the ID_PROVIDER field
     */
    public const COL_ID_PROVIDER = 'AUTH_PROVIDERS.ID_PROVIDER';

    /**
     * the column name for the NAME field
     */
    public const COL_NAME = 'AUTH_PROVIDERS.NAME';

    /**
     * the column name for the DEV field
     */
    public const COL_DEV = 'AUTH_PROVIDERS.DEV';

    /**
     * the column name for the CLIENT field
     */
    public const COL_CLIENT = 'AUTH_PROVIDERS.CLIENT';

    /**
     * the column name for the SECRET field
     */
    public const COL_SECRET = 'AUTH_PROVIDERS.SECRET';

    /**
     * the column name for the PARENT_REF field
     */
    public const COL_PARENT_REF = 'AUTH_PROVIDERS.PARENT_REF';

    /**
     * the column name for the SCOPES field
     */
    public const COL_SCOPES = 'AUTH_PROVIDERS.SCOPES';

    /**
     * the column name for the ACTIVE field
     */
    public const COL_ACTIVE = 'AUTH_PROVIDERS.ACTIVE';

    /**
     * the column name for the CUSTOMER_CODE field
     */
    public const COL_CUSTOMER_CODE = 'AUTH_PROVIDERS.CUSTOMER_CODE';

    /**
     * the column name for the EXPIRATION field
     */
    public const COL_EXPIRATION = 'AUTH_PROVIDERS.EXPIRATION';

    /**
     * the column name for the EXPIRATION_PERIOD field
     */
    public const COL_EXPIRATION_PERIOD = 'AUTH_PROVIDERS.EXPIRATION_PERIOD';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'AUTH_PROVIDERS.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'AUTH_PROVIDERS.updated_at';

    /**
     * the column name for the ACCOUNTS field
     */
    public const COL_ACCOUNTS = 'AUTH_PROVIDERS.ACCOUNTS';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the NAME field */
    public const COL_NAME_EMAIL = 'EMAIL';
    public const COL_NAME_GOOGLE = 'GOOGLE';
    public const COL_NAME_FACEBOOK = 'FACEBOOK';
    public const COL_NAME_TWITTER = 'TWITTER';
    public const COL_NAME_LINKEDIN = 'LINKEDIN';
    public const COL_NAME_LIVE = 'LIVE';

    /** The enumerated values for the EXPIRATION field */
    public const COL_EXPIRATION_NEVER = 'NEVER';
    public const COL_EXPIRATION_WEEKLY = 'WEEKLY';
    public const COL_EXPIRATION_MONTHLY = 'MONTHLY';
    public const COL_EXPIRATION_YEARLY = 'YEARLY';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdProvider', 'Name', 'Debug', 'Client', 'Secret', 'Parent', 'Scopes', 'Active', 'CustomerCode', 'Expiration', 'ExpirationPeriod', 'CreatedAt', 'UpdatedAt', 'Accounts', ],
        self::TYPE_CAMELNAME     => ['idProvider', 'name', 'debug', 'client', 'secret', 'parent', 'scopes', 'active', 'customerCode', 'expiration', 'expirationPeriod', 'createdAt', 'updatedAt', 'accounts', ],
        self::TYPE_COLNAME       => [LoginProviderTableMap::COL_ID_PROVIDER, LoginProviderTableMap::COL_NAME, LoginProviderTableMap::COL_DEV, LoginProviderTableMap::COL_CLIENT, LoginProviderTableMap::COL_SECRET, LoginProviderTableMap::COL_PARENT_REF, LoginProviderTableMap::COL_SCOPES, LoginProviderTableMap::COL_ACTIVE, LoginProviderTableMap::COL_CUSTOMER_CODE, LoginProviderTableMap::COL_EXPIRATION, LoginProviderTableMap::COL_EXPIRATION_PERIOD, LoginProviderTableMap::COL_CREATED_AT, LoginProviderTableMap::COL_UPDATED_AT, LoginProviderTableMap::COL_ACCOUNTS, ],
        self::TYPE_FIELDNAME     => ['ID_PROVIDER', 'NAME', 'DEV', 'CLIENT', 'SECRET', 'PARENT_REF', 'SCOPES', 'ACTIVE', 'CUSTOMER_CODE', 'EXPIRATION', 'EXPIRATION_PERIOD', 'created_at', 'updated_at', 'ACCOUNTS', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdProvider' => 0, 'Name' => 1, 'Debug' => 2, 'Client' => 3, 'Secret' => 4, 'Parent' => 5, 'Scopes' => 6, 'Active' => 7, 'CustomerCode' => 8, 'Expiration' => 9, 'ExpirationPeriod' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'Accounts' => 13, ],
        self::TYPE_CAMELNAME     => ['idProvider' => 0, 'name' => 1, 'debug' => 2, 'client' => 3, 'secret' => 4, 'parent' => 5, 'scopes' => 6, 'active' => 7, 'customerCode' => 8, 'expiration' => 9, 'expirationPeriod' => 10, 'createdAt' => 11, 'updatedAt' => 12, 'accounts' => 13, ],
        self::TYPE_COLNAME       => [LoginProviderTableMap::COL_ID_PROVIDER => 0, LoginProviderTableMap::COL_NAME => 1, LoginProviderTableMap::COL_DEV => 2, LoginProviderTableMap::COL_CLIENT => 3, LoginProviderTableMap::COL_SECRET => 4, LoginProviderTableMap::COL_PARENT_REF => 5, LoginProviderTableMap::COL_SCOPES => 6, LoginProviderTableMap::COL_ACTIVE => 7, LoginProviderTableMap::COL_CUSTOMER_CODE => 8, LoginProviderTableMap::COL_EXPIRATION => 9, LoginProviderTableMap::COL_EXPIRATION_PERIOD => 10, LoginProviderTableMap::COL_CREATED_AT => 11, LoginProviderTableMap::COL_UPDATED_AT => 12, LoginProviderTableMap::COL_ACCOUNTS => 13, ],
        self::TYPE_FIELDNAME     => ['ID_PROVIDER' => 0, 'NAME' => 1, 'DEV' => 2, 'CLIENT' => 3, 'SECRET' => 4, 'PARENT_REF' => 5, 'SCOPES' => 6, 'ACTIVE' => 7, 'CUSTOMER_CODE' => 8, 'EXPIRATION' => 9, 'EXPIRATION_PERIOD' => 10, 'created_at' => 11, 'updated_at' => 12, 'ACCOUNTS' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProvider' => 'ID_PROVIDER',
        'LoginProvider.IdProvider' => 'ID_PROVIDER',
        'idProvider' => 'ID_PROVIDER',
        'loginProvider.idProvider' => 'ID_PROVIDER',
        'LoginProviderTableMap::COL_ID_PROVIDER' => 'ID_PROVIDER',
        'COL_ID_PROVIDER' => 'ID_PROVIDER',
        'ID_PROVIDER' => 'ID_PROVIDER',
        'AUTH_PROVIDERS.ID_PROVIDER' => 'ID_PROVIDER',
        'Name' => 'NAME',
        'LoginProvider.Name' => 'NAME',
        'name' => 'NAME',
        'loginProvider.name' => 'NAME',
        'LoginProviderTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'NAME' => 'NAME',
        'AUTH_PROVIDERS.NAME' => 'NAME',
        'Debug' => 'DEV',
        'LoginProvider.Debug' => 'DEV',
        'debug' => 'DEV',
        'loginProvider.debug' => 'DEV',
        'LoginProviderTableMap::COL_DEV' => 'DEV',
        'COL_DEV' => 'DEV',
        'DEV' => 'DEV',
        'AUTH_PROVIDERS.DEV' => 'DEV',
        'Client' => 'CLIENT',
        'LoginProvider.Client' => 'CLIENT',
        'client' => 'CLIENT',
        'loginProvider.client' => 'CLIENT',
        'LoginProviderTableMap::COL_CLIENT' => 'CLIENT',
        'COL_CLIENT' => 'CLIENT',
        'CLIENT' => 'CLIENT',
        'AUTH_PROVIDERS.CLIENT' => 'CLIENT',
        'Secret' => 'SECRET',
        'LoginProvider.Secret' => 'SECRET',
        'secret' => 'SECRET',
        'loginProvider.secret' => 'SECRET',
        'LoginProviderTableMap::COL_SECRET' => 'SECRET',
        'COL_SECRET' => 'SECRET',
        'SECRET' => 'SECRET',
        'AUTH_PROVIDERS.SECRET' => 'SECRET',
        'Parent' => 'PARENT_REF',
        'LoginProvider.Parent' => 'PARENT_REF',
        'parent' => 'PARENT_REF',
        'loginProvider.parent' => 'PARENT_REF',
        'LoginProviderTableMap::COL_PARENT_REF' => 'PARENT_REF',
        'COL_PARENT_REF' => 'PARENT_REF',
        'PARENT_REF' => 'PARENT_REF',
        'AUTH_PROVIDERS.PARENT_REF' => 'PARENT_REF',
        'Scopes' => 'SCOPES',
        'LoginProvider.Scopes' => 'SCOPES',
        'scopes' => 'SCOPES',
        'loginProvider.scopes' => 'SCOPES',
        'LoginProviderTableMap::COL_SCOPES' => 'SCOPES',
        'COL_SCOPES' => 'SCOPES',
        'SCOPES' => 'SCOPES',
        'AUTH_PROVIDERS.SCOPES' => 'SCOPES',
        'Active' => 'ACTIVE',
        'LoginProvider.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'loginProvider.active' => 'ACTIVE',
        'LoginProviderTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'ACTIVE' => 'ACTIVE',
        'AUTH_PROVIDERS.ACTIVE' => 'ACTIVE',
        'CustomerCode' => 'CUSTOMER_CODE',
        'LoginProvider.CustomerCode' => 'CUSTOMER_CODE',
        'customerCode' => 'CUSTOMER_CODE',
        'loginProvider.customerCode' => 'CUSTOMER_CODE',
        'LoginProviderTableMap::COL_CUSTOMER_CODE' => 'CUSTOMER_CODE',
        'COL_CUSTOMER_CODE' => 'CUSTOMER_CODE',
        'CUSTOMER_CODE' => 'CUSTOMER_CODE',
        'AUTH_PROVIDERS.CUSTOMER_CODE' => 'CUSTOMER_CODE',
        'Expiration' => 'EXPIRATION',
        'LoginProvider.Expiration' => 'EXPIRATION',
        'expiration' => 'EXPIRATION',
        'loginProvider.expiration' => 'EXPIRATION',
        'LoginProviderTableMap::COL_EXPIRATION' => 'EXPIRATION',
        'COL_EXPIRATION' => 'EXPIRATION',
        'EXPIRATION' => 'EXPIRATION',
        'AUTH_PROVIDERS.EXPIRATION' => 'EXPIRATION',
        'ExpirationPeriod' => 'EXPIRATION_PERIOD',
        'LoginProvider.ExpirationPeriod' => 'EXPIRATION_PERIOD',
        'expirationPeriod' => 'EXPIRATION_PERIOD',
        'loginProvider.expirationPeriod' => 'EXPIRATION_PERIOD',
        'LoginProviderTableMap::COL_EXPIRATION_PERIOD' => 'EXPIRATION_PERIOD',
        'COL_EXPIRATION_PERIOD' => 'EXPIRATION_PERIOD',
        'EXPIRATION_PERIOD' => 'EXPIRATION_PERIOD',
        'AUTH_PROVIDERS.EXPIRATION_PERIOD' => 'EXPIRATION_PERIOD',
        'CreatedAt' => 'CREATED_AT',
        'LoginProvider.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'loginProvider.createdAt' => 'CREATED_AT',
        'LoginProviderTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'AUTH_PROVIDERS.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LoginProvider.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'loginProvider.updatedAt' => 'UPDATED_AT',
        'LoginProviderTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'AUTH_PROVIDERS.updated_at' => 'UPDATED_AT',
        'Accounts' => 'ACCOUNTS',
        'LoginProvider.Accounts' => 'ACCOUNTS',
        'accounts' => 'ACCOUNTS',
        'loginProvider.accounts' => 'ACCOUNTS',
        'LoginProviderTableMap::COL_ACCOUNTS' => 'ACCOUNTS',
        'COL_ACCOUNTS' => 'ACCOUNTS',
        'ACCOUNTS' => 'ACCOUNTS',
        'AUTH_PROVIDERS.ACCOUNTS' => 'ACCOUNTS',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                LoginProviderTableMap::COL_NAME => [
                            self::COL_NAME_EMAIL,
            self::COL_NAME_GOOGLE,
            self::COL_NAME_FACEBOOK,
            self::COL_NAME_TWITTER,
            self::COL_NAME_LINKEDIN,
            self::COL_NAME_LIVE,
        ],
                LoginProviderTableMap::COL_EXPIRATION => [
                            self::COL_EXPIRATION_NEVER,
            self::COL_EXPIRATION_WEEKLY,
            self::COL_EXPIRATION_MONTHLY,
            self::COL_EXPIRATION_YEARLY,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('AUTH_PROVIDERS');
        $this->setPhpName('LoginProvider');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AUTH\\Models\\LoginProvider');
        $this->setPackage('AUTH.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_PROVIDER', 'IdProvider', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'ENUM', true, null, null);
        $this->getColumn('NAME')->setValueSet(array (
  0 => 'EMAIL',
  1 => 'GOOGLE',
  2 => 'FACEBOOK',
  3 => 'TWITTER',
  4 => 'LINKEDIN',
  5 => 'LIVE',
));
        $this->addColumn('DEV', 'Debug', 'BOOLEAN', false, 1, true);
        $this->addColumn('CLIENT', 'Client', 'VARCHAR', true, 100, null);
        $this->addColumn('SECRET', 'Secret', 'BINARY', true, 100, null);
        $this->addColumn('PARENT_REF', 'Parent', 'VARCHAR', false, 50, null);
        $this->addColumn('SCOPES', 'Scopes', 'VARCHAR', false, 1000, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('CUSTOMER_CODE', 'CustomerCode', 'VARCHAR', false, 50, null);
        $this->addColumn('EXPIRATION', 'Expiration', 'ENUM', true, null, 'NEVER');
        $this->getColumn('EXPIRATION')->setValueSet(array (
  0 => 'NEVER',
  1 => 'WEEKLY',
  2 => 'MONTHLY',
  3 => 'YEARLY',
));
        $this->addColumn('EXPIRATION_PERIOD', 'ExpirationPeriod', 'INTEGER', false, 3, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACCOUNTS', 'Accounts', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('LoginPath', '\\AUTH\\Models\\LoginPath', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_PROVIDER',
    1 => ':ID_PROVIDER',
  ),
), null, null, 'LoginPaths', false);
        $this->addRelation('LoginAccount', '\\AUTH\\Models\\LoginAccount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_PROVIDER',
    1 => ':ID_PROVIDER',
  ),
), null, null, 'LoginAccounts', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'query_cache' => ['backend' => 'apc', 'lifetime' => '3600'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
            'aggregate_column' => ['name' => 'ACCOUNTS', 'expression' => 'COUNT(ID_ACCOUNT)', 'condition' => NULL, 'foreign_table' => 'ACCOUNTS', 'foreign_schema' => NULL],
        ];
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdProvider', TableMap::TYPE_PHPNAME, $indexType)
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
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? LoginProviderTableMap::CLASS_DEFAULT : LoginProviderTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (LoginProvider object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LoginProviderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LoginProviderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LoginProviderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LoginProviderTableMap::OM_CLASS;
            /** @var LoginProvider $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LoginProviderTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = LoginProviderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LoginProviderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LoginProvider $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LoginProviderTableMap::addInstanceToPool($obj, $key);
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
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LoginProviderTableMap::COL_ID_PROVIDER);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_NAME);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_DEV);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_CLIENT);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_SECRET);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_PARENT_REF);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_SCOPES);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_CUSTOMER_CODE);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_EXPIRATION);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_EXPIRATION_PERIOD);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_ACCOUNTS);
        } else {
            $criteria->addSelectColumn($alias . '.ID_PROVIDER');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.DEV');
            $criteria->addSelectColumn($alias . '.CLIENT');
            $criteria->addSelectColumn($alias . '.SECRET');
            $criteria->addSelectColumn($alias . '.PARENT_REF');
            $criteria->addSelectColumn($alias . '.SCOPES');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.CUSTOMER_CODE');
            $criteria->addSelectColumn($alias . '.EXPIRATION');
            $criteria->addSelectColumn($alias . '.EXPIRATION_PERIOD');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.ACCOUNTS');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_ID_PROVIDER);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_NAME);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_DEV);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_CLIENT);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_SECRET);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_PARENT_REF);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_SCOPES);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_CUSTOMER_CODE);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_EXPIRATION);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_EXPIRATION_PERIOD);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(LoginProviderTableMap::COL_ACCOUNTS);
        } else {
            $criteria->removeSelectColumn($alias . '.ID_PROVIDER');
            $criteria->removeSelectColumn($alias . '.NAME');
            $criteria->removeSelectColumn($alias . '.DEV');
            $criteria->removeSelectColumn($alias . '.CLIENT');
            $criteria->removeSelectColumn($alias . '.SECRET');
            $criteria->removeSelectColumn($alias . '.PARENT_REF');
            $criteria->removeSelectColumn($alias . '.SCOPES');
            $criteria->removeSelectColumn($alias . '.ACTIVE');
            $criteria->removeSelectColumn($alias . '.CUSTOMER_CODE');
            $criteria->removeSelectColumn($alias . '.EXPIRATION');
            $criteria->removeSelectColumn($alias . '.EXPIRATION_PERIOD');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.ACCOUNTS');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(LoginProviderTableMap::DATABASE_NAME)->getTable(LoginProviderTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LoginProvider or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LoginProvider object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AUTH\Models\LoginProvider) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LoginProviderTableMap::DATABASE_NAME);
            $criteria->add(LoginProviderTableMap::COL_ID_PROVIDER, (array) $values, Criteria::IN);
        }

        $query = LoginProviderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LoginProviderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LoginProviderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AUTH_PROVIDERS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LoginProviderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginProvider or Criteria object.
     *
     * @param mixed $criteria Criteria or LoginProvider object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LoginProvider object
        }

        if ($criteria->containsKey(LoginProviderTableMap::COL_ID_PROVIDER) && $criteria->keyContainsValue(LoginProviderTableMap::COL_ID_PROVIDER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LoginProviderTableMap::COL_ID_PROVIDER.')');
        }


        // Set the correct dbName
        $query = LoginProviderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
