<?php

namespace PSFS\Auth\Models\Map;

use PSFS\Auth\Models\Account;
use PSFS\Auth\Models\AccountQuery;
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
 * This class defines the structure of the 'Auth_ACCOUNTS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PSFS.Auth.Models.Map.AccountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'Auth';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Auth_ACCOUNTS';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PSFS\\Auth\\Models\\Account';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PSFS.Auth.Models.Account';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the ID_ACCOUNT field
     */
    const COL_ID_ACCOUNT = 'Auth_ACCOUNTS.ID_ACCOUNT';

    /**
     * the column name for the ID_USER field
     */
    const COL_ID_USER = 'Auth_ACCOUNTS.ID_USER';

    /**
     * the column name for the ID_EXTERNAL field
     */
    const COL_ID_EXTERNAL = 'Auth_ACCOUNTS.ID_EXTERNAL';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'Auth_ACCOUNTS.TYPE';

    /**
     * the column name for the ACCESS_TOKEN field
     */
    const COL_ACCESS_TOKEN = 'Auth_ACCOUNTS.ACCESS_TOKEN';

    /**
     * the column name for the REFRESH_TOKEN field
     */
    const COL_REFRESH_TOKEN = 'Auth_ACCOUNTS.REFRESH_TOKEN';

    /**
     * the column name for the EXPIRES field
     */
    const COL_EXPIRES = 'Auth_ACCOUNTS.EXPIRES';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'Auth_ACCOUNTS.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'Auth_ACCOUNTS.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdAccount', 'IdUser', 'IdExternal', 'Type', 'AccessToken', 'RefreshToken', 'Expires', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('idAccount', 'idUser', 'idExternal', 'type', 'accessToken', 'refreshToken', 'expires', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ID_ACCOUNT, AccountTableMap::COL_ID_USER, AccountTableMap::COL_ID_EXTERNAL, AccountTableMap::COL_TYPE, AccountTableMap::COL_ACCESS_TOKEN, AccountTableMap::COL_REFRESH_TOKEN, AccountTableMap::COL_EXPIRES, AccountTableMap::COL_CREATED_AT, AccountTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT', 'ID_USER', 'ID_EXTERNAL', 'TYPE', 'ACCESS_TOKEN', 'REFRESH_TOKEN', 'EXPIRES', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdAccount' => 0, 'IdUser' => 1, 'IdExternal' => 2, 'Type' => 3, 'AccessToken' => 4, 'RefreshToken' => 5, 'Expires' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('idAccount' => 0, 'idUser' => 1, 'idExternal' => 2, 'type' => 3, 'accessToken' => 4, 'refreshToken' => 5, 'expires' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ID_ACCOUNT => 0, AccountTableMap::COL_ID_USER => 1, AccountTableMap::COL_ID_EXTERNAL => 2, AccountTableMap::COL_TYPE => 3, AccountTableMap::COL_ACCESS_TOKEN => 4, AccountTableMap::COL_REFRESH_TOKEN => 5, AccountTableMap::COL_EXPIRES => 6, AccountTableMap::COL_CREATED_AT => 7, AccountTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT' => 0, 'ID_USER' => 1, 'ID_EXTERNAL' => 2, 'TYPE' => 3, 'ACCESS_TOKEN' => 4, 'REFRESH_TOKEN' => 5, 'EXPIRES' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Auth_ACCOUNTS');
        $this->setPhpName('Account');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PSFS\\Auth\\Models\\Account');
        $this->setPackage('PSFS.Auth.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_ACCOUNT', 'IdAccount', 'INTEGER', true, null, null);
        $this->addColumn('ID_USER', 'IdUser', 'INTEGER', true, 11, null);
        $this->addColumn('ID_EXTERNAL', 'IdExternal', 'VARCHAR', true, 255, null);
        $this->addColumn('TYPE', 'Type', 'INTEGER', false, 1, 0);
        $this->addColumn('ACCESS_TOKEN', 'AccessToken', 'VARCHAR', true, 255, null);
        $this->addColumn('REFRESH_TOKEN', 'RefreshToken', 'VARCHAR', false, 255, null);
        $this->addColumn('EXPIRES', 'Expires', 'VARCHAR', false, 10, '0');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'archivable' => array('archive_table' => '', 'archive_phpname' => '', 'archive_class' => '', 'log_archived_at' => 'true', 'archived_at_column' => 'archived_at', 'archive_on_insert' => 'false', 'archive_on_update' => 'false', 'archive_on_delete' => 'true', ),
            'query_cache' => array('backend' => 'apc', 'lifetime' => '3600', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
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
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? AccountTableMap::CLASS_DEFAULT : AccountTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Account object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AccountTableMap::OM_CLASS;
            /** @var Account $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AccountTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Account $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AccountTableMap::addInstanceToPool($obj, $key);
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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AccountTableMap::COL_ID_ACCOUNT);
            $criteria->addSelectColumn(AccountTableMap::COL_ID_USER);
            $criteria->addSelectColumn(AccountTableMap::COL_ID_EXTERNAL);
            $criteria->addSelectColumn(AccountTableMap::COL_TYPE);
            $criteria->addSelectColumn(AccountTableMap::COL_ACCESS_TOKEN);
            $criteria->addSelectColumn(AccountTableMap::COL_REFRESH_TOKEN);
            $criteria->addSelectColumn(AccountTableMap::COL_EXPIRES);
            $criteria->addSelectColumn(AccountTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AccountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->addSelectColumn($alias . '.ID_USER');
            $criteria->addSelectColumn($alias . '.ID_EXTERNAL');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.ACCESS_TOKEN');
            $criteria->addSelectColumn($alias . '.REFRESH_TOKEN');
            $criteria->addSelectColumn($alias . '.EXPIRES');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME)->getTable(AccountTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AccountTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AccountTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Account or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Account object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PSFS\Auth\Models\Account) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AccountTableMap::DATABASE_NAME);
            $criteria->add(AccountTableMap::COL_ID_ACCOUNT, (array) $values, Criteria::IN);
        }

        $query = AccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Auth_ACCOUNTS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Account or Criteria object.
     *
     * @param mixed               $criteria Criteria or Account object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Account object
        }

        if ($criteria->containsKey(AccountTableMap::COL_ID_ACCOUNT) && $criteria->keyContainsValue(AccountTableMap::COL_ID_ACCOUNT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AccountTableMap::COL_ID_ACCOUNT.')');
        }


        // Set the correct dbName
        $query = AccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AccountTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AccountTableMap::buildTableMap();
