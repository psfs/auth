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
 *
 */
class LoginProviderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AUTH.Models.Map.LoginProviderTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'AUTH_PROVIDERS';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AUTH\\Models\\LoginProvider';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AUTH.Models.LoginProvider';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the ID_PROVIDER field
     */
    const COL_ID_PROVIDER = 'AUTH_PROVIDERS.ID_PROVIDER';

    /**
     * the column name for the NAME field
     */
    const COL_NAME = 'AUTH_PROVIDERS.NAME';

    /**
     * the column name for the DEV field
     */
    const COL_DEV = 'AUTH_PROVIDERS.DEV';

    /**
     * the column name for the CLIENT field
     */
    const COL_CLIENT = 'AUTH_PROVIDERS.CLIENT';

    /**
     * the column name for the SECRET field
     */
    const COL_SECRET = 'AUTH_PROVIDERS.SECRET';

    /**
     * the column name for the PARENT_REF field
     */
    const COL_PARENT_REF = 'AUTH_PROVIDERS.PARENT_REF';

    /**
     * the column name for the ACTIVE field
     */
    const COL_ACTIVE = 'AUTH_PROVIDERS.ACTIVE';

    /**
     * the column name for the CUSTOMER_CODE field
     */
    const COL_CUSTOMER_CODE = 'AUTH_PROVIDERS.CUSTOMER_CODE';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'AUTH_PROVIDERS.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'AUTH_PROVIDERS.updated_at';

    /**
     * the column name for the ACCOUNTS field
     */
    const COL_ACCOUNTS = 'AUTH_PROVIDERS.ACCOUNTS';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the NAME field */
    const COL_NAME_EMAIL = 'EMAIL';
    const COL_NAME_GOOGLE = 'GOOGLE';
    const COL_NAME_FACEBOOK = 'FACEBOOK';
    const COL_NAME_TWITTER = 'TWITTER';
    const COL_NAME_LINKEDIN = 'LINKEDIN';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdProvider', 'Name', 'Debug', 'Client', 'Secret', 'Parent', 'Active', 'CustomerCode', 'CreatedAt', 'UpdatedAt', 'Accounts', ),
        self::TYPE_CAMELNAME     => array('idProvider', 'name', 'debug', 'client', 'secret', 'parent', 'active', 'customerCode', 'createdAt', 'updatedAt', 'accounts', ),
        self::TYPE_COLNAME       => array(LoginProviderTableMap::COL_ID_PROVIDER, LoginProviderTableMap::COL_NAME, LoginProviderTableMap::COL_DEV, LoginProviderTableMap::COL_CLIENT, LoginProviderTableMap::COL_SECRET, LoginProviderTableMap::COL_PARENT_REF, LoginProviderTableMap::COL_ACTIVE, LoginProviderTableMap::COL_CUSTOMER_CODE, LoginProviderTableMap::COL_CREATED_AT, LoginProviderTableMap::COL_UPDATED_AT, LoginProviderTableMap::COL_ACCOUNTS, ),
        self::TYPE_FIELDNAME     => array('ID_PROVIDER', 'NAME', 'DEV', 'CLIENT', 'SECRET', 'PARENT_REF', 'ACTIVE', 'CUSTOMER_CODE', 'created_at', 'updated_at', 'ACCOUNTS', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdProvider' => 0, 'Name' => 1, 'Debug' => 2, 'Client' => 3, 'Secret' => 4, 'Parent' => 5, 'Active' => 6, 'CustomerCode' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'Accounts' => 10, ),
        self::TYPE_CAMELNAME     => array('idProvider' => 0, 'name' => 1, 'debug' => 2, 'client' => 3, 'secret' => 4, 'parent' => 5, 'active' => 6, 'customerCode' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'accounts' => 10, ),
        self::TYPE_COLNAME       => array(LoginProviderTableMap::COL_ID_PROVIDER => 0, LoginProviderTableMap::COL_NAME => 1, LoginProviderTableMap::COL_DEV => 2, LoginProviderTableMap::COL_CLIENT => 3, LoginProviderTableMap::COL_SECRET => 4, LoginProviderTableMap::COL_PARENT_REF => 5, LoginProviderTableMap::COL_ACTIVE => 6, LoginProviderTableMap::COL_CUSTOMER_CODE => 7, LoginProviderTableMap::COL_CREATED_AT => 8, LoginProviderTableMap::COL_UPDATED_AT => 9, LoginProviderTableMap::COL_ACCOUNTS => 10, ),
        self::TYPE_FIELDNAME     => array('ID_PROVIDER' => 0, 'NAME' => 1, 'DEV' => 2, 'CLIENT' => 3, 'SECRET' => 4, 'PARENT_REF' => 5, 'ACTIVE' => 6, 'CUSTOMER_CODE' => 7, 'created_at' => 8, 'updated_at' => 9, 'ACCOUNTS' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                LoginProviderTableMap::COL_NAME => array(
                            self::COL_NAME_EMAIL,
            self::COL_NAME_GOOGLE,
            self::COL_NAME_FACEBOOK,
            self::COL_NAME_TWITTER,
            self::COL_NAME_LINKEDIN,
        ),
    );

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets()
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
));
        $this->addColumn('DEV', 'Debug', 'BOOLEAN', false, 1, true);
        $this->addColumn('CLIENT', 'Client', 'VARCHAR', true, 100, null);
        $this->addColumn('SECRET', 'Secret', 'BINARY', true, 100, null);
        $this->addColumn('PARENT_REF', 'Parent', 'VARCHAR', false, 50, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('CUSTOMER_CODE', 'CustomerCode', 'VARCHAR', false, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACCOUNTS', 'Accounts', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LoginAccount', '\\AUTH\\Models\\LoginAccount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_PROVIDER',
    1 => ':ID_PROVIDER',
  ),
), null, null, 'LoginAccounts', false);
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
            'query_cache' => array('backend' => 'apc', 'lifetime' => '3600', ),
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'aggregate_column' => array('name' => 'ACCOUNTS', 'expression' => 'COUNT(ID_ACCOUNT)', 'condition' => '', 'foreign_table' => 'ACCOUNTS', 'foreign_schema' => '', ),
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? LoginProviderTableMap::CLASS_DEFAULT : LoginProviderTableMap::OM_CLASS;
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
     * @return array           (LoginProvider object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LoginProviderTableMap::COL_ID_PROVIDER);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_NAME);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_DEV);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_CLIENT);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_SECRET);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_PARENT_REF);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(LoginProviderTableMap::COL_CUSTOMER_CODE);
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
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.CUSTOMER_CODE');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.ACCOUNTS');
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
        return Propel::getServiceContainer()->getDatabaseMap(LoginProviderTableMap::DATABASE_NAME)->getTable(LoginProviderTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LoginProviderTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LoginProviderTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LoginProviderTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a LoginProvider or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LoginProvider object or primary key or array of primary keys
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
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LoginProviderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginProvider or Criteria object.
     *
     * @param mixed               $criteria Criteria or LoginProvider object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
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

} // LoginProviderTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LoginProviderTableMap::buildTableMap();
