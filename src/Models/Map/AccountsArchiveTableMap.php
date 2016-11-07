<?php

namespace PSFS\Auth\Models\Map;

use PSFS\Auth\Models\AccountsArchive;
use PSFS\Auth\Models\AccountsArchiveQuery;
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
 * This class defines the structure of the 'Auth_ACCOUNTS_archive' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AccountsArchiveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PSFS.Auth.Models.Map.AccountsArchiveTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'Auth';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Auth_ACCOUNTS_archive';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PSFS\\Auth\\Models\\AccountsArchive';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PSFS.Auth.Models.AccountsArchive';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the ID_ACCOUNT field
     */
    const COL_ID_ACCOUNT = 'Auth_ACCOUNTS_archive.ID_ACCOUNT';

    /**
     * the column name for the ID_USER field
     */
    const COL_ID_USER = 'Auth_ACCOUNTS_archive.ID_USER';

    /**
     * the column name for the ID_EXTERNAL field
     */
    const COL_ID_EXTERNAL = 'Auth_ACCOUNTS_archive.ID_EXTERNAL';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'Auth_ACCOUNTS_archive.TYPE';

    /**
     * the column name for the ACCESS_TOKEN field
     */
    const COL_ACCESS_TOKEN = 'Auth_ACCOUNTS_archive.ACCESS_TOKEN';

    /**
     * the column name for the REFRESH_TOKEN field
     */
    const COL_REFRESH_TOKEN = 'Auth_ACCOUNTS_archive.REFRESH_TOKEN';

    /**
     * the column name for the EXPIRES field
     */
    const COL_EXPIRES = 'Auth_ACCOUNTS_archive.EXPIRES';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'Auth_ACCOUNTS_archive.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'Auth_ACCOUNTS_archive.updated_at';

    /**
     * the column name for the archived_at field
     */
    const COL_ARCHIVED_AT = 'Auth_ACCOUNTS_archive.archived_at';

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
        self::TYPE_PHPNAME       => array('IdAccount', 'IdUser', 'IdExternal', 'Type', 'AccessToken', 'RefreshToken', 'Expires', 'CreatedAt', 'UpdatedAt', 'ArchivedAt', ),
        self::TYPE_CAMELNAME     => array('idAccount', 'idUser', 'idExternal', 'type', 'accessToken', 'refreshToken', 'expires', 'createdAt', 'updatedAt', 'archivedAt', ),
        self::TYPE_COLNAME       => array(AccountsArchiveTableMap::COL_ID_ACCOUNT, AccountsArchiveTableMap::COL_ID_USER, AccountsArchiveTableMap::COL_ID_EXTERNAL, AccountsArchiveTableMap::COL_TYPE, AccountsArchiveTableMap::COL_ACCESS_TOKEN, AccountsArchiveTableMap::COL_REFRESH_TOKEN, AccountsArchiveTableMap::COL_EXPIRES, AccountsArchiveTableMap::COL_CREATED_AT, AccountsArchiveTableMap::COL_UPDATED_AT, AccountsArchiveTableMap::COL_ARCHIVED_AT, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT', 'ID_USER', 'ID_EXTERNAL', 'TYPE', 'ACCESS_TOKEN', 'REFRESH_TOKEN', 'EXPIRES', 'created_at', 'updated_at', 'archived_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdAccount' => 0, 'IdUser' => 1, 'IdExternal' => 2, 'Type' => 3, 'AccessToken' => 4, 'RefreshToken' => 5, 'Expires' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'ArchivedAt' => 9, ),
        self::TYPE_CAMELNAME     => array('idAccount' => 0, 'idUser' => 1, 'idExternal' => 2, 'type' => 3, 'accessToken' => 4, 'refreshToken' => 5, 'expires' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'archivedAt' => 9, ),
        self::TYPE_COLNAME       => array(AccountsArchiveTableMap::COL_ID_ACCOUNT => 0, AccountsArchiveTableMap::COL_ID_USER => 1, AccountsArchiveTableMap::COL_ID_EXTERNAL => 2, AccountsArchiveTableMap::COL_TYPE => 3, AccountsArchiveTableMap::COL_ACCESS_TOKEN => 4, AccountsArchiveTableMap::COL_REFRESH_TOKEN => 5, AccountsArchiveTableMap::COL_EXPIRES => 6, AccountsArchiveTableMap::COL_CREATED_AT => 7, AccountsArchiveTableMap::COL_UPDATED_AT => 8, AccountsArchiveTableMap::COL_ARCHIVED_AT => 9, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT' => 0, 'ID_USER' => 1, 'ID_EXTERNAL' => 2, 'TYPE' => 3, 'ACCESS_TOKEN' => 4, 'REFRESH_TOKEN' => 5, 'EXPIRES' => 6, 'created_at' => 7, 'updated_at' => 8, 'archived_at' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('Auth_ACCOUNTS_archive');
        $this->setPhpName('AccountsArchive');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PSFS\\Auth\\Models\\AccountsArchive');
        $this->setPackage('PSFS.Auth.Models');
        $this->setUseIdGenerator(false);
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
        $this->addColumn('archived_at', 'ArchivedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

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
        return $withPrefix ? AccountsArchiveTableMap::CLASS_DEFAULT : AccountsArchiveTableMap::OM_CLASS;
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
     * @return array           (AccountsArchive object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AccountsArchiveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AccountsArchiveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AccountsArchiveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AccountsArchiveTableMap::OM_CLASS;
            /** @var AccountsArchive $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AccountsArchiveTableMap::addInstanceToPool($obj, $key);
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
            $key = AccountsArchiveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AccountsArchiveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AccountsArchive $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AccountsArchiveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_ID_ACCOUNT);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_ID_USER);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_ID_EXTERNAL);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_TYPE);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_ACCESS_TOKEN);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_REFRESH_TOKEN);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_EXPIRES);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(AccountsArchiveTableMap::COL_ARCHIVED_AT);
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
            $criteria->addSelectColumn($alias . '.archived_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(AccountsArchiveTableMap::DATABASE_NAME)->getTable(AccountsArchiveTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AccountsArchiveTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AccountsArchiveTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AccountsArchiveTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a AccountsArchive or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or AccountsArchive object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsArchiveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PSFS\Auth\Models\AccountsArchive) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AccountsArchiveTableMap::DATABASE_NAME);
            $criteria->add(AccountsArchiveTableMap::COL_ID_ACCOUNT, (array) $values, Criteria::IN);
        }

        $query = AccountsArchiveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AccountsArchiveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AccountsArchiveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Auth_ACCOUNTS_archive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AccountsArchiveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AccountsArchive or Criteria object.
     *
     * @param mixed               $criteria Criteria or AccountsArchive object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsArchiveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AccountsArchive object
        }


        // Set the correct dbName
        $query = AccountsArchiveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AccountsArchiveTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AccountsArchiveTableMap::buildTableMap();
