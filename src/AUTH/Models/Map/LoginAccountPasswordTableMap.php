<?php

namespace AUTH\Models\Map;

use AUTH\Models\LoginAccountPassword;
use AUTH\Models\LoginAccountPasswordQuery;
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
 * This class defines the structure of the 'AUTH_ACCOUNT_PASSWORDS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LoginAccountPasswordTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'AUTH.Models.Map.LoginAccountPasswordTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'AUTH_ACCOUNT_PASSWORDS';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LoginAccountPassword';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\AUTH\\Models\\LoginAccountPassword';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'AUTH.Models.LoginAccountPassword';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the ID_PASSWORD field
     */
    public const COL_ID_PASSWORD = 'AUTH_ACCOUNT_PASSWORDS.ID_PASSWORD';

    /**
     * the column name for the ID_ACCOUNT field
     */
    public const COL_ID_ACCOUNT = 'AUTH_ACCOUNT_PASSWORDS.ID_ACCOUNT';

    /**
     * the column name for the VALUE field
     */
    public const COL_VALUE = 'AUTH_ACCOUNT_PASSWORDS.VALUE';

    /**
     * the column name for the EXPIRATION_DATE field
     */
    public const COL_EXPIRATION_DATE = 'AUTH_ACCOUNT_PASSWORDS.EXPIRATION_DATE';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'AUTH_ACCOUNT_PASSWORDS.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'AUTH_ACCOUNT_PASSWORDS.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdPassword', 'IdAccount', 'Value', 'ExpirationDate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPassword', 'idAccount', 'value', 'expirationDate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [LoginAccountPasswordTableMap::COL_ID_PASSWORD, LoginAccountPasswordTableMap::COL_ID_ACCOUNT, LoginAccountPasswordTableMap::COL_VALUE, LoginAccountPasswordTableMap::COL_EXPIRATION_DATE, LoginAccountPasswordTableMap::COL_CREATED_AT, LoginAccountPasswordTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['ID_PASSWORD', 'ID_ACCOUNT', 'VALUE', 'EXPIRATION_DATE', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdPassword' => 0, 'IdAccount' => 1, 'Value' => 2, 'ExpirationDate' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idPassword' => 0, 'idAccount' => 1, 'value' => 2, 'expirationDate' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [LoginAccountPasswordTableMap::COL_ID_PASSWORD => 0, LoginAccountPasswordTableMap::COL_ID_ACCOUNT => 1, LoginAccountPasswordTableMap::COL_VALUE => 2, LoginAccountPasswordTableMap::COL_EXPIRATION_DATE => 3, LoginAccountPasswordTableMap::COL_CREATED_AT => 4, LoginAccountPasswordTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['ID_PASSWORD' => 0, 'ID_ACCOUNT' => 1, 'VALUE' => 2, 'EXPIRATION_DATE' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPassword' => 'ID_PASSWORD',
        'LoginAccountPassword.IdPassword' => 'ID_PASSWORD',
        'idPassword' => 'ID_PASSWORD',
        'loginAccountPassword.idPassword' => 'ID_PASSWORD',
        'LoginAccountPasswordTableMap::COL_ID_PASSWORD' => 'ID_PASSWORD',
        'COL_ID_PASSWORD' => 'ID_PASSWORD',
        'ID_PASSWORD' => 'ID_PASSWORD',
        'AUTH_ACCOUNT_PASSWORDS.ID_PASSWORD' => 'ID_PASSWORD',
        'IdAccount' => 'ID_ACCOUNT',
        'LoginAccountPassword.IdAccount' => 'ID_ACCOUNT',
        'idAccount' => 'ID_ACCOUNT',
        'loginAccountPassword.idAccount' => 'ID_ACCOUNT',
        'LoginAccountPasswordTableMap::COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'ID_ACCOUNT' => 'ID_ACCOUNT',
        'AUTH_ACCOUNT_PASSWORDS.ID_ACCOUNT' => 'ID_ACCOUNT',
        'Value' => 'VALUE',
        'LoginAccountPassword.Value' => 'VALUE',
        'value' => 'VALUE',
        'loginAccountPassword.value' => 'VALUE',
        'LoginAccountPasswordTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'VALUE' => 'VALUE',
        'AUTH_ACCOUNT_PASSWORDS.VALUE' => 'VALUE',
        'ExpirationDate' => 'EXPIRATION_DATE',
        'LoginAccountPassword.ExpirationDate' => 'EXPIRATION_DATE',
        'expirationDate' => 'EXPIRATION_DATE',
        'loginAccountPassword.expirationDate' => 'EXPIRATION_DATE',
        'LoginAccountPasswordTableMap::COL_EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'COL_EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'AUTH_ACCOUNT_PASSWORDS.EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'CreatedAt' => 'CREATED_AT',
        'LoginAccountPassword.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'loginAccountPassword.createdAt' => 'CREATED_AT',
        'LoginAccountPasswordTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'AUTH_ACCOUNT_PASSWORDS.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LoginAccountPassword.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'loginAccountPassword.updatedAt' => 'UPDATED_AT',
        'LoginAccountPasswordTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'AUTH_ACCOUNT_PASSWORDS.updated_at' => 'UPDATED_AT',
    ];

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
        $this->setName('AUTH_ACCOUNT_PASSWORDS');
        $this->setPhpName('LoginAccountPassword');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AUTH\\Models\\LoginAccountPassword');
        $this->setPackage('AUTH.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_PASSWORD', 'IdPassword', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_ACCOUNT', 'IdAccount', 'INTEGER', 'AUTH_ACCOUNTS', 'ID_ACCOUNT', true, null, null);
        $this->addColumn('VALUE', 'Value', 'VARCHAR', true, 100, null);
        $this->addColumn('EXPIRATION_DATE', 'ExpirationDate', 'TIMESTAMP', true, null, null);
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
        $this->addRelation('AccountPasswords', '\\AUTH\\Models\\LoginAccount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_ACCOUNT',
    1 => ':ID_ACCOUNT',
  ),
), null, null, null, false);
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPassword', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LoginAccountPasswordTableMap::CLASS_DEFAULT : LoginAccountPasswordTableMap::OM_CLASS;
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
     * @return array (LoginAccountPassword object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LoginAccountPasswordTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LoginAccountPasswordTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LoginAccountPasswordTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LoginAccountPasswordTableMap::OM_CLASS;
            /** @var LoginAccountPassword $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LoginAccountPasswordTableMap::addInstanceToPool($obj, $key);
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
            $key = LoginAccountPasswordTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LoginAccountPasswordTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LoginAccountPassword $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LoginAccountPasswordTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_ID_PASSWORD);
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_ID_ACCOUNT);
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_VALUE);
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_EXPIRATION_DATE);
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LoginAccountPasswordTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID_PASSWORD');
            $criteria->addSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->addSelectColumn($alias . '.VALUE');
            $criteria->addSelectColumn($alias . '.EXPIRATION_DATE');
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
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_ID_PASSWORD);
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_ID_ACCOUNT);
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_VALUE);
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_EXPIRATION_DATE);
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LoginAccountPasswordTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.ID_PASSWORD');
            $criteria->removeSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->removeSelectColumn($alias . '.VALUE');
            $criteria->removeSelectColumn($alias . '.EXPIRATION_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(LoginAccountPasswordTableMap::DATABASE_NAME)->getTable(LoginAccountPasswordTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LoginAccountPassword or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LoginAccountPassword object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountPasswordTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AUTH\Models\LoginAccountPassword) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LoginAccountPasswordTableMap::DATABASE_NAME);
            $criteria->add(LoginAccountPasswordTableMap::COL_ID_PASSWORD, (array) $values, Criteria::IN);
        }

        $query = LoginAccountPasswordQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LoginAccountPasswordTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LoginAccountPasswordTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AUTH_ACCOUNT_PASSWORDS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LoginAccountPasswordQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginAccountPassword or Criteria object.
     *
     * @param mixed $criteria Criteria or LoginAccountPassword object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountPasswordTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LoginAccountPassword object
        }

        if ($criteria->containsKey(LoginAccountPasswordTableMap::COL_ID_PASSWORD) && $criteria->keyContainsValue(LoginAccountPasswordTableMap::COL_ID_PASSWORD) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LoginAccountPasswordTableMap::COL_ID_PASSWORD.')');
        }


        // Set the correct dbName
        $query = LoginAccountPasswordQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
