<?php

namespace PSFS\Auth\Models\Map;

use PSFS\Auth\Models\SessionsArchive;
use PSFS\Auth\Models\SessionsArchiveQuery;
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
 * This class defines the structure of the 'Auth_SESSIONS_archive' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SessionsArchiveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PSFS.Auth.Models.Map.SessionsArchiveTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'Auth';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Auth_SESSIONS_archive';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PSFS\\Auth\\Models\\SessionsArchive';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PSFS.Auth.Models.SessionsArchive';

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
     * the column name for the ID_SESSION field
     */
    const COL_ID_SESSION = 'Auth_SESSIONS_archive.ID_SESSION';

    /**
     * the column name for the ID_USER field
     */
    const COL_ID_USER = 'Auth_SESSIONS_archive.ID_USER';

    /**
     * the column name for the IP field
     */
    const COL_IP = 'Auth_SESSIONS_archive.IP';

    /**
     * the column name for the TOKEN field
     */
    const COL_TOKEN = 'Auth_SESSIONS_archive.TOKEN';

    /**
     * the column name for the REFRESH_TOKEN field
     */
    const COL_REFRESH_TOKEN = 'Auth_SESSIONS_archive.REFRESH_TOKEN';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'Auth_SESSIONS_archive.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'Auth_SESSIONS_archive.updated_at';

    /**
     * the column name for the archived_at field
     */
    const COL_ARCHIVED_AT = 'Auth_SESSIONS_archive.archived_at';

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
        self::TYPE_PHPNAME       => array('IdSession', 'IdUser', 'Ip', 'Token', 'RefreshToken', 'CreatedAt', 'UpdatedAt', 'ArchivedAt', ),
        self::TYPE_CAMELNAME     => array('idSession', 'idUser', 'ip', 'token', 'refreshToken', 'createdAt', 'updatedAt', 'archivedAt', ),
        self::TYPE_COLNAME       => array(SessionsArchiveTableMap::COL_ID_SESSION, SessionsArchiveTableMap::COL_ID_USER, SessionsArchiveTableMap::COL_IP, SessionsArchiveTableMap::COL_TOKEN, SessionsArchiveTableMap::COL_REFRESH_TOKEN, SessionsArchiveTableMap::COL_CREATED_AT, SessionsArchiveTableMap::COL_UPDATED_AT, SessionsArchiveTableMap::COL_ARCHIVED_AT, ),
        self::TYPE_FIELDNAME     => array('ID_SESSION', 'ID_USER', 'IP', 'TOKEN', 'REFRESH_TOKEN', 'created_at', 'updated_at', 'archived_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdSession' => 0, 'IdUser' => 1, 'Ip' => 2, 'Token' => 3, 'RefreshToken' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'ArchivedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('idSession' => 0, 'idUser' => 1, 'ip' => 2, 'token' => 3, 'refreshToken' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'archivedAt' => 7, ),
        self::TYPE_COLNAME       => array(SessionsArchiveTableMap::COL_ID_SESSION => 0, SessionsArchiveTableMap::COL_ID_USER => 1, SessionsArchiveTableMap::COL_IP => 2, SessionsArchiveTableMap::COL_TOKEN => 3, SessionsArchiveTableMap::COL_REFRESH_TOKEN => 4, SessionsArchiveTableMap::COL_CREATED_AT => 5, SessionsArchiveTableMap::COL_UPDATED_AT => 6, SessionsArchiveTableMap::COL_ARCHIVED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('ID_SESSION' => 0, 'ID_USER' => 1, 'IP' => 2, 'TOKEN' => 3, 'REFRESH_TOKEN' => 4, 'created_at' => 5, 'updated_at' => 6, 'archived_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('Auth_SESSIONS_archive');
        $this->setPhpName('SessionsArchive');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PSFS\\Auth\\Models\\SessionsArchive');
        $this->setPackage('PSFS.Auth.Models');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID_SESSION', 'IdSession', 'INTEGER', true, null, null);
        $this->addColumn('ID_USER', 'IdUser', 'INTEGER', true, 11, null);
        $this->addColumn('IP', 'Ip', 'VARCHAR', true, 15, null);
        $this->addColumn('TOKEN', 'Token', 'VARCHAR', true, 100, null);
        $this->addColumn('REFRESH_TOKEN', 'RefreshToken', 'VARCHAR', false, 255, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SessionsArchiveTableMap::CLASS_DEFAULT : SessionsArchiveTableMap::OM_CLASS;
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
     * @return array           (SessionsArchive object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SessionsArchiveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SessionsArchiveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SessionsArchiveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SessionsArchiveTableMap::OM_CLASS;
            /** @var SessionsArchive $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SessionsArchiveTableMap::addInstanceToPool($obj, $key);
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
            $key = SessionsArchiveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SessionsArchiveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SessionsArchive $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SessionsArchiveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_ID_SESSION);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_ID_USER);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_IP);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_TOKEN);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_REFRESH_TOKEN);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SessionsArchiveTableMap::COL_ARCHIVED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID_SESSION');
            $criteria->addSelectColumn($alias . '.ID_USER');
            $criteria->addSelectColumn($alias . '.IP');
            $criteria->addSelectColumn($alias . '.TOKEN');
            $criteria->addSelectColumn($alias . '.REFRESH_TOKEN');
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
        return Propel::getServiceContainer()->getDatabaseMap(SessionsArchiveTableMap::DATABASE_NAME)->getTable(SessionsArchiveTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SessionsArchiveTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SessionsArchiveTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SessionsArchiveTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SessionsArchive or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SessionsArchive object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SessionsArchiveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PSFS\Auth\Models\SessionsArchive) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SessionsArchiveTableMap::DATABASE_NAME);
            $criteria->add(SessionsArchiveTableMap::COL_ID_SESSION, (array) $values, Criteria::IN);
        }

        $query = SessionsArchiveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SessionsArchiveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SessionsArchiveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Auth_SESSIONS_archive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SessionsArchiveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SessionsArchive or Criteria object.
     *
     * @param mixed               $criteria Criteria or SessionsArchive object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionsArchiveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SessionsArchive object
        }


        // Set the correct dbName
        $query = SessionsArchiveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SessionsArchiveTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SessionsArchiveTableMap::buildTableMap();
