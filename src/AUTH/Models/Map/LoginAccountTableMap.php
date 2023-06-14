<?php

namespace AUTH\Models\Map;

use AUTH\Models\LoginAccount;
use AUTH\Models\LoginAccountQuery;
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
 * This class defines the structure of the 'AUTH_ACCOUNTS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LoginAccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'AUTH.Models.Map.LoginAccountTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'AUTH_ACCOUNTS';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LoginAccount';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\AUTH\\Models\\LoginAccount';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'AUTH.Models.LoginAccount';

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
     * the column name for the ID_ACCOUNT field
     */
    public const COL_ID_ACCOUNT = 'AUTH_ACCOUNTS.ID_ACCOUNT';

    /**
     * the column name for the ID_PROVIDER field
     */
    public const COL_ID_PROVIDER = 'AUTH_ACCOUNTS.ID_PROVIDER';

    /**
     * the column name for the IDENTIFIER field
     */
    public const COL_IDENTIFIER = 'AUTH_ACCOUNTS.IDENTIFIER';

    /**
     * the column name for the EMAIL field
     */
    public const COL_EMAIL = 'AUTH_ACCOUNTS.EMAIL';

    /**
     * the column name for the ACCESS_TOKEN field
     */
    public const COL_ACCESS_TOKEN = 'AUTH_ACCOUNTS.ACCESS_TOKEN';

    /**
     * the column name for the REFRESH_TOKEN field
     */
    public const COL_REFRESH_TOKEN = 'AUTH_ACCOUNTS.REFRESH_TOKEN';

    /**
     * the column name for the EXPIRES field
     */
    public const COL_EXPIRES = 'AUTH_ACCOUNTS.EXPIRES';

    /**
     * the column name for the ROLE field
     */
    public const COL_ROLE = 'AUTH_ACCOUNTS.ROLE';

    /**
     * the column name for the ACTIVE field
     */
    public const COL_ACTIVE = 'AUTH_ACCOUNTS.ACTIVE';

    /**
     * the column name for the VERIFIED field
     */
    public const COL_VERIFIED = 'AUTH_ACCOUNTS.VERIFIED';

    /**
     * the column name for the REFRESH_REQUESTED field
     */
    public const COL_REFRESH_REQUESTED = 'AUTH_ACCOUNTS.REFRESH_REQUESTED';

    /**
     * the column name for the RESET_TOKEN field
     */
    public const COL_RESET_TOKEN = 'AUTH_ACCOUNTS.RESET_TOKEN';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'AUTH_ACCOUNTS.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'AUTH_ACCOUNTS.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the ROLE field */
    public const COL_ROLE_USER = 'USER';
    public const COL_ROLE_MANAGER = 'MANAGER';
    public const COL_ROLE_ADMIN = 'ADMIN';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdAccount', 'IdSocial', 'Id', 'Email', 'AccessToken', 'RefreshToken', 'ExpireDate', 'AccountRole', 'Active', 'Verified', 'RefreshRequest', 'ResetToken', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idAccount', 'idSocial', 'id', 'email', 'accessToken', 'refreshToken', 'expireDate', 'accountRole', 'active', 'verified', 'refreshRequest', 'resetToken', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [LoginAccountTableMap::COL_ID_ACCOUNT, LoginAccountTableMap::COL_ID_PROVIDER, LoginAccountTableMap::COL_IDENTIFIER, LoginAccountTableMap::COL_EMAIL, LoginAccountTableMap::COL_ACCESS_TOKEN, LoginAccountTableMap::COL_REFRESH_TOKEN, LoginAccountTableMap::COL_EXPIRES, LoginAccountTableMap::COL_ROLE, LoginAccountTableMap::COL_ACTIVE, LoginAccountTableMap::COL_VERIFIED, LoginAccountTableMap::COL_REFRESH_REQUESTED, LoginAccountTableMap::COL_RESET_TOKEN, LoginAccountTableMap::COL_CREATED_AT, LoginAccountTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['ID_ACCOUNT', 'ID_PROVIDER', 'IDENTIFIER', 'EMAIL', 'ACCESS_TOKEN', 'REFRESH_TOKEN', 'EXPIRES', 'ROLE', 'ACTIVE', 'VERIFIED', 'REFRESH_REQUESTED', 'RESET_TOKEN', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdAccount' => 0, 'IdSocial' => 1, 'Id' => 2, 'Email' => 3, 'AccessToken' => 4, 'RefreshToken' => 5, 'ExpireDate' => 6, 'AccountRole' => 7, 'Active' => 8, 'Verified' => 9, 'RefreshRequest' => 10, 'ResetToken' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ],
        self::TYPE_CAMELNAME     => ['idAccount' => 0, 'idSocial' => 1, 'id' => 2, 'email' => 3, 'accessToken' => 4, 'refreshToken' => 5, 'expireDate' => 6, 'accountRole' => 7, 'active' => 8, 'verified' => 9, 'refreshRequest' => 10, 'resetToken' => 11, 'createdAt' => 12, 'updatedAt' => 13, ],
        self::TYPE_COLNAME       => [LoginAccountTableMap::COL_ID_ACCOUNT => 0, LoginAccountTableMap::COL_ID_PROVIDER => 1, LoginAccountTableMap::COL_IDENTIFIER => 2, LoginAccountTableMap::COL_EMAIL => 3, LoginAccountTableMap::COL_ACCESS_TOKEN => 4, LoginAccountTableMap::COL_REFRESH_TOKEN => 5, LoginAccountTableMap::COL_EXPIRES => 6, LoginAccountTableMap::COL_ROLE => 7, LoginAccountTableMap::COL_ACTIVE => 8, LoginAccountTableMap::COL_VERIFIED => 9, LoginAccountTableMap::COL_REFRESH_REQUESTED => 10, LoginAccountTableMap::COL_RESET_TOKEN => 11, LoginAccountTableMap::COL_CREATED_AT => 12, LoginAccountTableMap::COL_UPDATED_AT => 13, ],
        self::TYPE_FIELDNAME     => ['ID_ACCOUNT' => 0, 'ID_PROVIDER' => 1, 'IDENTIFIER' => 2, 'EMAIL' => 3, 'ACCESS_TOKEN' => 4, 'REFRESH_TOKEN' => 5, 'EXPIRES' => 6, 'ROLE' => 7, 'ACTIVE' => 8, 'VERIFIED' => 9, 'REFRESH_REQUESTED' => 10, 'RESET_TOKEN' => 11, 'created_at' => 12, 'updated_at' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAccount' => 'ID_ACCOUNT',
        'LoginAccount.IdAccount' => 'ID_ACCOUNT',
        'idAccount' => 'ID_ACCOUNT',
        'loginAccount.idAccount' => 'ID_ACCOUNT',
        'LoginAccountTableMap::COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'ID_ACCOUNT' => 'ID_ACCOUNT',
        'AUTH_ACCOUNTS.ID_ACCOUNT' => 'ID_ACCOUNT',
        'IdSocial' => 'ID_PROVIDER',
        'LoginAccount.IdSocial' => 'ID_PROVIDER',
        'idSocial' => 'ID_PROVIDER',
        'loginAccount.idSocial' => 'ID_PROVIDER',
        'LoginAccountTableMap::COL_ID_PROVIDER' => 'ID_PROVIDER',
        'COL_ID_PROVIDER' => 'ID_PROVIDER',
        'ID_PROVIDER' => 'ID_PROVIDER',
        'AUTH_ACCOUNTS.ID_PROVIDER' => 'ID_PROVIDER',
        'Id' => 'IDENTIFIER',
        'LoginAccount.Id' => 'IDENTIFIER',
        'id' => 'IDENTIFIER',
        'loginAccount.id' => 'IDENTIFIER',
        'LoginAccountTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'IDENTIFIER' => 'IDENTIFIER',
        'AUTH_ACCOUNTS.IDENTIFIER' => 'IDENTIFIER',
        'Email' => 'EMAIL',
        'LoginAccount.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'loginAccount.email' => 'EMAIL',
        'LoginAccountTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'EMAIL' => 'EMAIL',
        'AUTH_ACCOUNTS.EMAIL' => 'EMAIL',
        'AccessToken' => 'ACCESS_TOKEN',
        'LoginAccount.AccessToken' => 'ACCESS_TOKEN',
        'accessToken' => 'ACCESS_TOKEN',
        'loginAccount.accessToken' => 'ACCESS_TOKEN',
        'LoginAccountTableMap::COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'AUTH_ACCOUNTS.ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'RefreshToken' => 'REFRESH_TOKEN',
        'LoginAccount.RefreshToken' => 'REFRESH_TOKEN',
        'refreshToken' => 'REFRESH_TOKEN',
        'loginAccount.refreshToken' => 'REFRESH_TOKEN',
        'LoginAccountTableMap::COL_REFRESH_TOKEN' => 'REFRESH_TOKEN',
        'COL_REFRESH_TOKEN' => 'REFRESH_TOKEN',
        'REFRESH_TOKEN' => 'REFRESH_TOKEN',
        'AUTH_ACCOUNTS.REFRESH_TOKEN' => 'REFRESH_TOKEN',
        'ExpireDate' => 'EXPIRES',
        'LoginAccount.ExpireDate' => 'EXPIRES',
        'expireDate' => 'EXPIRES',
        'loginAccount.expireDate' => 'EXPIRES',
        'LoginAccountTableMap::COL_EXPIRES' => 'EXPIRES',
        'COL_EXPIRES' => 'EXPIRES',
        'EXPIRES' => 'EXPIRES',
        'AUTH_ACCOUNTS.EXPIRES' => 'EXPIRES',
        'AccountRole' => 'ROLE',
        'LoginAccount.AccountRole' => 'ROLE',
        'accountRole' => 'ROLE',
        'loginAccount.accountRole' => 'ROLE',
        'LoginAccountTableMap::COL_ROLE' => 'ROLE',
        'COL_ROLE' => 'ROLE',
        'ROLE' => 'ROLE',
        'AUTH_ACCOUNTS.ROLE' => 'ROLE',
        'Active' => 'ACTIVE',
        'LoginAccount.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'loginAccount.active' => 'ACTIVE',
        'LoginAccountTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'ACTIVE' => 'ACTIVE',
        'AUTH_ACCOUNTS.ACTIVE' => 'ACTIVE',
        'Verified' => 'VERIFIED',
        'LoginAccount.Verified' => 'VERIFIED',
        'verified' => 'VERIFIED',
        'loginAccount.verified' => 'VERIFIED',
        'LoginAccountTableMap::COL_VERIFIED' => 'VERIFIED',
        'COL_VERIFIED' => 'VERIFIED',
        'VERIFIED' => 'VERIFIED',
        'AUTH_ACCOUNTS.VERIFIED' => 'VERIFIED',
        'RefreshRequest' => 'REFRESH_REQUESTED',
        'LoginAccount.RefreshRequest' => 'REFRESH_REQUESTED',
        'refreshRequest' => 'REFRESH_REQUESTED',
        'loginAccount.refreshRequest' => 'REFRESH_REQUESTED',
        'LoginAccountTableMap::COL_REFRESH_REQUESTED' => 'REFRESH_REQUESTED',
        'COL_REFRESH_REQUESTED' => 'REFRESH_REQUESTED',
        'REFRESH_REQUESTED' => 'REFRESH_REQUESTED',
        'AUTH_ACCOUNTS.REFRESH_REQUESTED' => 'REFRESH_REQUESTED',
        'ResetToken' => 'RESET_TOKEN',
        'LoginAccount.ResetToken' => 'RESET_TOKEN',
        'resetToken' => 'RESET_TOKEN',
        'loginAccount.resetToken' => 'RESET_TOKEN',
        'LoginAccountTableMap::COL_RESET_TOKEN' => 'RESET_TOKEN',
        'COL_RESET_TOKEN' => 'RESET_TOKEN',
        'RESET_TOKEN' => 'RESET_TOKEN',
        'AUTH_ACCOUNTS.RESET_TOKEN' => 'RESET_TOKEN',
        'CreatedAt' => 'CREATED_AT',
        'LoginAccount.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'loginAccount.createdAt' => 'CREATED_AT',
        'LoginAccountTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'AUTH_ACCOUNTS.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LoginAccount.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'loginAccount.updatedAt' => 'UPDATED_AT',
        'LoginAccountTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'AUTH_ACCOUNTS.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                LoginAccountTableMap::COL_ROLE => [
                            self::COL_ROLE_USER,
            self::COL_ROLE_MANAGER,
            self::COL_ROLE_ADMIN,
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
        $this->setName('AUTH_ACCOUNTS');
        $this->setPhpName('LoginAccount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AUTH\\Models\\LoginAccount');
        $this->setPackage('AUTH.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_ACCOUNT', 'IdAccount', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_PROVIDER', 'IdSocial', 'INTEGER', 'AUTH_PROVIDERS', 'ID_PROVIDER', true, null, null);
        $this->addColumn('IDENTIFIER', 'Id', 'VARCHAR', true, 100, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 100, null);
        $this->addColumn('ACCESS_TOKEN', 'AccessToken', 'VARCHAR', true, 255, null);
        $this->addColumn('REFRESH_TOKEN', 'RefreshToken', 'BINARY', false, 255, null);
        $this->addColumn('EXPIRES', 'ExpireDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('ROLE', 'AccountRole', 'ENUM', false, null, 'USER');
        $this->getColumn('ROLE')->setValueSet(array (
  0 => 'USER',
  1 => 'MANAGER',
  2 => 'ADMIN',
));
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('VERIFIED', 'Verified', 'BOOLEAN', false, 1, false);
        $this->addColumn('REFRESH_REQUESTED', 'RefreshRequest', 'TIMESTAMP', false, null, null);
        $this->addColumn('RESET_TOKEN', 'ResetToken', 'VARCHAR', false, 100, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('AccountProvider', '\\AUTH\\Models\\LoginProvider', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_PROVIDER',
    1 => ':ID_PROVIDER',
  ),
), null, null, null, false);
        $this->addRelation('LoginAccountPassword', '\\AUTH\\Models\\LoginAccountPassword', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_ACCOUNT',
    1 => ':ID_ACCOUNT',
  ),
), null, null, 'LoginAccountPasswords', false);
        $this->addRelation('LoginSession', '\\AUTH\\Models\\LoginSession', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_ACCOUNT',
    1 => ':ID_ACCOUNT',
  ),
), null, null, 'LoginSessions', false);
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
            'aggregate_column_relation_aggregate_column' => ['foreign_table' => 'AUTH_PROVIDERS', 'update_method' => 'updateAccounts', 'aggregate_name' => 'Accounts'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAccount', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LoginAccountTableMap::CLASS_DEFAULT : LoginAccountTableMap::OM_CLASS;
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
     * @return array (LoginAccount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LoginAccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LoginAccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LoginAccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LoginAccountTableMap::OM_CLASS;
            /** @var LoginAccount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LoginAccountTableMap::addInstanceToPool($obj, $key);
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
            $key = LoginAccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LoginAccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LoginAccount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LoginAccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LoginAccountTableMap::COL_ID_ACCOUNT);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_ID_PROVIDER);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_EMAIL);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_ACCESS_TOKEN);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_REFRESH_TOKEN);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_EXPIRES);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_ROLE);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_REFRESH_REQUESTED);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_RESET_TOKEN);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LoginAccountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->addSelectColumn($alias . '.ID_PROVIDER');
            $criteria->addSelectColumn($alias . '.IDENTIFIER');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.ACCESS_TOKEN');
            $criteria->addSelectColumn($alias . '.REFRESH_TOKEN');
            $criteria->addSelectColumn($alias . '.EXPIRES');
            $criteria->addSelectColumn($alias . '.ROLE');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.VERIFIED');
            $criteria->addSelectColumn($alias . '.REFRESH_REQUESTED');
            $criteria->addSelectColumn($alias . '.RESET_TOKEN');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_ID_ACCOUNT);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_ID_PROVIDER);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_ACCESS_TOKEN);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_REFRESH_TOKEN);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_EXPIRES);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_ROLE);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_VERIFIED);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_REFRESH_REQUESTED);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_RESET_TOKEN);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LoginAccountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->removeSelectColumn($alias . '.ID_PROVIDER');
            $criteria->removeSelectColumn($alias . '.IDENTIFIER');
            $criteria->removeSelectColumn($alias . '.EMAIL');
            $criteria->removeSelectColumn($alias . '.ACCESS_TOKEN');
            $criteria->removeSelectColumn($alias . '.REFRESH_TOKEN');
            $criteria->removeSelectColumn($alias . '.EXPIRES');
            $criteria->removeSelectColumn($alias . '.ROLE');
            $criteria->removeSelectColumn($alias . '.ACTIVE');
            $criteria->removeSelectColumn($alias . '.VERIFIED');
            $criteria->removeSelectColumn($alias . '.REFRESH_REQUESTED');
            $criteria->removeSelectColumn($alias . '.RESET_TOKEN');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(LoginAccountTableMap::DATABASE_NAME)->getTable(LoginAccountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LoginAccount or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LoginAccount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AUTH\Models\LoginAccount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LoginAccountTableMap::DATABASE_NAME);
            $criteria->add(LoginAccountTableMap::COL_ID_ACCOUNT, (array) $values, Criteria::IN);
        }

        $query = LoginAccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LoginAccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LoginAccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AUTH_ACCOUNTS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LoginAccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginAccount or Criteria object.
     *
     * @param mixed $criteria Criteria or LoginAccount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LoginAccount object
        }

        if ($criteria->containsKey(LoginAccountTableMap::COL_ID_ACCOUNT) && $criteria->keyContainsValue(LoginAccountTableMap::COL_ID_ACCOUNT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LoginAccountTableMap::COL_ID_ACCOUNT.')');
        }


        // Set the correct dbName
        $query = LoginAccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
