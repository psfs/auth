<?php

namespace AUTH\Models\Map;

use AUTH\Models\LoginPath;
use AUTH\Models\LoginPathQuery;
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
 * This class defines the structure of the 'AUTH_PATHS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LoginPathTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AUTH.Models.Map.LoginPathTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'AUTH';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'AUTH_PATHS';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AUTH\\Models\\LoginPath';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AUTH.Models.LoginPath';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the ID_PATH field
     */
    const COL_ID_PATH = 'AUTH_PATHS.ID_PATH';

    /**
     * the column name for the ID_PROVIDER field
     */
    const COL_ID_PROVIDER = 'AUTH_PATHS.ID_PROVIDER';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'AUTH_PATHS.TYPE';

    /**
     * the column name for the PATH field
     */
    const COL_PATH = 'AUTH_PATHS.PATH';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the TYPE field */
    const COL_TYPE_LOGIN_OK = 'LOGIN_OK';
    const COL_TYPE_LOGIN_ERROR = 'LOGIN_ERROR';
    const COL_TYPE_REGISTER_OK = 'REGISTER_OK';
    const COL_TYPE_REGISTER_ERROR = 'REGISTER_ERROR';
    const COL_TYPE_HANDSHAKE_ERROR = 'HANDSHAKE_ERROR';
    const COL_TYPE_LOGOUT_OK = 'LOGOUT_OK';
    const COL_TYPE_LOGOUT_ERROR = 'LOGOUT_ERROR';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdPath', 'IdSocial', 'Type', 'Path', ),
        self::TYPE_CAMELNAME     => array('idPath', 'idSocial', 'type', 'path', ),
        self::TYPE_COLNAME       => array(LoginPathTableMap::COL_ID_PATH, LoginPathTableMap::COL_ID_PROVIDER, LoginPathTableMap::COL_TYPE, LoginPathTableMap::COL_PATH, ),
        self::TYPE_FIELDNAME     => array('ID_PATH', 'ID_PROVIDER', 'TYPE', 'PATH', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdPath' => 0, 'IdSocial' => 1, 'Type' => 2, 'Path' => 3, ),
        self::TYPE_CAMELNAME     => array('idPath' => 0, 'idSocial' => 1, 'type' => 2, 'path' => 3, ),
        self::TYPE_COLNAME       => array(LoginPathTableMap::COL_ID_PATH => 0, LoginPathTableMap::COL_ID_PROVIDER => 1, LoginPathTableMap::COL_TYPE => 2, LoginPathTableMap::COL_PATH => 3, ),
        self::TYPE_FIELDNAME     => array('ID_PATH' => 0, 'ID_PROVIDER' => 1, 'TYPE' => 2, 'PATH' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                LoginPathTableMap::COL_TYPE => array(
                            self::COL_TYPE_LOGIN_OK,
            self::COL_TYPE_LOGIN_ERROR,
            self::COL_TYPE_REGISTER_OK,
            self::COL_TYPE_REGISTER_ERROR,
            self::COL_TYPE_HANDSHAKE_ERROR,
            self::COL_TYPE_LOGOUT_OK,
            self::COL_TYPE_LOGOUT_ERROR,
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
        $this->setName('AUTH_PATHS');
        $this->setPhpName('LoginPath');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AUTH\\Models\\LoginPath');
        $this->setPackage('AUTH.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_PATH', 'IdPath', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_PROVIDER', 'IdSocial', 'INTEGER', 'AUTH_PROVIDERS', 'ID_PROVIDER', true, null, null);
        $this->addColumn('TYPE', 'Type', 'ENUM', true, null, 'LOGIN_OK');
        $this->getColumn('TYPE')->setValueSet(array (
  0 => 'LOGIN_OK',
  1 => 'LOGIN_ERROR',
  2 => 'REGISTER_OK',
  3 => 'REGISTER_ERROR',
  4 => 'HANDSHAKE_ERROR',
  5 => 'LOGOUT_OK',
  6 => 'LOGOUT_ERROR',
));
        $this->addColumn('PATH', 'Path', 'VARCHAR', true, 500, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ProviderPath', '\\AUTH\\Models\\LoginProvider', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_PROVIDER',
    1 => ':ID_PROVIDER',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPath', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LoginPathTableMap::CLASS_DEFAULT : LoginPathTableMap::OM_CLASS;
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
     * @return array           (LoginPath object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LoginPathTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LoginPathTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LoginPathTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LoginPathTableMap::OM_CLASS;
            /** @var LoginPath $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LoginPathTableMap::addInstanceToPool($obj, $key);
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
            $key = LoginPathTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LoginPathTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LoginPath $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LoginPathTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LoginPathTableMap::COL_ID_PATH);
            $criteria->addSelectColumn(LoginPathTableMap::COL_ID_PROVIDER);
            $criteria->addSelectColumn(LoginPathTableMap::COL_TYPE);
            $criteria->addSelectColumn(LoginPathTableMap::COL_PATH);
        } else {
            $criteria->addSelectColumn($alias . '.ID_PATH');
            $criteria->addSelectColumn($alias . '.ID_PROVIDER');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.PATH');
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
        return Propel::getServiceContainer()->getDatabaseMap(LoginPathTableMap::DATABASE_NAME)->getTable(LoginPathTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LoginPathTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LoginPathTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LoginPathTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a LoginPath or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LoginPath object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginPathTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AUTH\Models\LoginPath) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LoginPathTableMap::DATABASE_NAME);
            $criteria->add(LoginPathTableMap::COL_ID_PATH, (array) $values, Criteria::IN);
        }

        $query = LoginPathQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LoginPathTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LoginPathTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AUTH_PATHS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LoginPathQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LoginPath or Criteria object.
     *
     * @param mixed               $criteria Criteria or LoginPath object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginPathTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LoginPath object
        }

        if ($criteria->containsKey(LoginPathTableMap::COL_ID_PATH) && $criteria->keyContainsValue(LoginPathTableMap::COL_ID_PATH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LoginPathTableMap::COL_ID_PATH.')');
        }


        // Set the correct dbName
        $query = LoginPathQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LoginPathTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LoginPathTableMap::buildTableMap();
