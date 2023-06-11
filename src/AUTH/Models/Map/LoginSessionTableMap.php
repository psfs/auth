<?php

namespace AUTH\Models\Map;

use AUTH\Models\LoginSession;
use AUTH\Models\LoginSessionQuery;
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
 * This class defines the structure of the 'AUTH_SESSIONS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LoginSessionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AUTH.Models.Map.LoginSessionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'AUTH_SESSIONS';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AUTH\\Models\\LoginSession';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AUTH.Models.LoginSession';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the ID_ACCOUNT field
     */
    const COL_ID_ACCOUNT = 'AUTH_SESSIONS.ID_ACCOUNT';

    /**
     * the column name for the DEVICE field
     */
    const COL_DEVICE = 'AUTH_SESSIONS.DEVICE';

    /**
     * the column name for the IP field
     */
    const COL_IP = 'AUTH_SESSIONS.IP';

    /**
     * the column name for the TOKEN field
     */
    const COL_TOKEN = 'AUTH_SESSIONS.TOKEN';

    /**
     * the column name for the ACTIVE field
     */
    const COL_ACTIVE = 'AUTH_SESSIONS.ACTIVE';

    /**
     * the column name for the id field
     */
    const COL_ID = 'AUTH_SESSIONS.id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'AUTH_SESSIONS.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'AUTH_SESSIONS.updated_at';

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
        self::TYPE_PHPNAME       => array('IdAccount', 'Device', 'IP', 'Token', 'Active', 'Id', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('idAccount', 'device', 'iP', 'token', 'active', 'id', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(LoginSessionTableMap::COL_ID_ACCOUNT, LoginSessionTableMap::COL_DEVICE, LoginSessionTableMap::COL_IP, LoginSessionTableMap::COL_TOKEN, LoginSessionTableMap::COL_ACTIVE, LoginSessionTableMap::COL_ID, LoginSessionTableMap::COL_CREATED_AT, LoginSessionTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT', 'DEVICE', 'IP', 'TOKEN', 'ACTIVE', 'id', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdAccount' => 0, 'Device' => 1, 'IP' => 2, 'Token' => 3, 'Active' => 4, 'Id' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('idAccount' => 0, 'device' => 1, 'iP' => 2, 'token' => 3, 'active' => 4, 'id' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(LoginSessionTableMap::COL_ID_ACCOUNT => 0, LoginSessionTableMap::COL_DEVICE => 1, LoginSessionTableMap::COL_IP => 2, LoginSessionTableMap::COL_TOKEN => 3, LoginSessionTableMap::COL_ACTIVE => 4, LoginSessionTableMap::COL_ID => 5, LoginSessionTableMap::COL_CREATED_AT => 6, LoginSessionTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('ID_ACCOUNT' => 0, 'DEVICE' => 1, 'IP' => 2, 'TOKEN' => 3, 'ACTIVE' => 4, 'id' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'IdAccount' => 'ID_ACCOUNT',
        'LoginSession.IdAccount' => 'ID_ACCOUNT',
        'idAccount' => 'ID_ACCOUNT',
        'loginSession.idAccount' => 'ID_ACCOUNT',
        'LoginSessionTableMap::COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'COL_ID_ACCOUNT' => 'ID_ACCOUNT',
        'ID_ACCOUNT' => 'ID_ACCOUNT',
        'AUTH_SESSIONS.ID_ACCOUNT' => 'ID_ACCOUNT',
        'Device' => 'DEVICE',
        'LoginSession.Device' => 'DEVICE',
        'device' => 'DEVICE',
        'loginSession.device' => 'DEVICE',
        'LoginSessionTableMap::COL_DEVICE' => 'DEVICE',
        'COL_DEVICE' => 'DEVICE',
        'DEVICE' => 'DEVICE',
        'AUTH_SESSIONS.DEVICE' => 'DEVICE',
        'IP' => 'IP',
        'LoginSession.IP' => 'IP',
        'iP' => 'IP',
        'loginSession.iP' => 'IP',
        'LoginSessionTableMap::COL_IP' => 'IP',
        'COL_IP' => 'IP',
        'IP' => 'IP',
        'AUTH_SESSIONS.IP' => 'IP',
        'Token' => 'TOKEN',
        'LoginSession.Token' => 'TOKEN',
        'token' => 'TOKEN',
        'loginSession.token' => 'TOKEN',
        'LoginSessionTableMap::COL_TOKEN' => 'TOKEN',
        'COL_TOKEN' => 'TOKEN',
        'TOKEN' => 'TOKEN',
        'AUTH_SESSIONS.TOKEN' => 'TOKEN',
        'Active' => 'ACTIVE',
        'LoginSession.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'loginSession.active' => 'ACTIVE',
        'LoginSessionTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'ACTIVE' => 'ACTIVE',
        'AUTH_SESSIONS.ACTIVE' => 'ACTIVE',
        'Id' => 'ID',
        'LoginSession.Id' => 'ID',
        'id' => 'ID',
        'loginSession.id' => 'ID',
        'LoginSessionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'AUTH_SESSIONS.id' => 'ID',
        'CreatedAt' => 'CREATED_AT',
        'LoginSession.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'loginSession.createdAt' => 'CREATED_AT',
        'LoginSessionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'AUTH_SESSIONS.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LoginSession.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'loginSession.updatedAt' => 'UPDATED_AT',
        'LoginSessionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'AUTH_SESSIONS.updated_at' => 'UPDATED_AT',
    ];

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
        $this->setName('AUTH_SESSIONS');
        $this->setPhpName('LoginSession');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AUTH\\Models\\LoginSession');
        $this->setPackage('AUTH.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignKey('ID_ACCOUNT', 'IdAccount', 'INTEGER', 'AUTH_ACCOUNTS', 'ID_ACCOUNT', true, null, null);
        $this->addColumn('DEVICE', 'Device', 'VARCHAR', true, 500, null);
        $this->addColumn('IP', 'IP', 'VARCHAR', true, 50, null);
        $this->addColumn('TOKEN', 'Token', 'BINARY', true, null, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, true);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('AccountSession', '\\AUTH\\Models\\LoginAccount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_ACCOUNT',
    1 => ':ID_ACCOUNT',
  ),
), null, null, null, false);
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
            'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 5 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LoginSessionTableMap::CLASS_DEFAULT : LoginSessionTableMap::OM_CLASS;
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
     * @return array           (LoginSession object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LoginSessionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LoginSessionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LoginSessionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LoginSessionTableMap::OM_CLASS;
            /** @var LoginSession $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LoginSessionTableMap::addInstanceToPool($obj, $key);
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
            $key = LoginSessionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LoginSessionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LoginSession $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LoginSessionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LoginSessionTableMap::COL_ID_ACCOUNT);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_DEVICE);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_IP);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_TOKEN);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_ID);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LoginSessionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->addSelectColumn($alias . '.DEVICE');
            $criteria->addSelectColumn($alias . '.IP');
            $criteria->addSelectColumn($alias . '.TOKEN');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.id');
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
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_ID_ACCOUNT);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_DEVICE);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_IP);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_TOKEN);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_ID);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LoginSessionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.ID_ACCOUNT');
            $criteria->removeSelectColumn($alias . '.DEVICE');
            $criteria->removeSelectColumn($alias . '.IP');
            $criteria->removeSelectColumn($alias . '.TOKEN');
            $criteria->removeSelectColumn($alias . '.ACTIVE');
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(LoginSessionTableMap::DATABASE_NAME)->getTable(LoginSessionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LoginSessionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LoginSessionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LoginSessionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a LoginSession or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LoginSession object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginSessionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AUTH\Models\LoginSession) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LoginSessionTableMap::DATABASE_NAME);
            $criteria->add(LoginSessionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LoginSessionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LoginSessionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LoginSessionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AUTH_SESSIONS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LoginSessionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginSession or Criteria object.
     *
     * @param mixed               $criteria Criteria or LoginSession object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginSessionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LoginSession object
        }

        if ($criteria->containsKey(LoginSessionTableMap::COL_ID) && $criteria->keyContainsValue(LoginSessionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LoginSessionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LoginSessionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LoginSessionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LoginSessionTableMap::buildTableMap();
