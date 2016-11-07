<?php

namespace PSFS\Auth\Models\Base;

use \Exception;
use \PDO;
use PSFS\Auth\Models\SessionsArchive as ChildSessionsArchive;
use PSFS\Auth\Models\SessionsArchiveQuery as ChildSessionsArchiveQuery;
use PSFS\Auth\Models\Map\SessionsArchiveTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Auth_SESSIONS_archive' table.
 *
 *
 *
 * @method     ChildSessionsArchiveQuery orderByIdSession($order = Criteria::ASC) Order by the ID_SESSION column
 * @method     ChildSessionsArchiveQuery orderByIdUser($order = Criteria::ASC) Order by the ID_USER column
 * @method     ChildSessionsArchiveQuery orderByIp($order = Criteria::ASC) Order by the IP column
 * @method     ChildSessionsArchiveQuery orderByToken($order = Criteria::ASC) Order by the TOKEN column
 * @method     ChildSessionsArchiveQuery orderByRefreshToken($order = Criteria::ASC) Order by the REFRESH_TOKEN column
 * @method     ChildSessionsArchiveQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSessionsArchiveQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSessionsArchiveQuery orderByArchivedAt($order = Criteria::ASC) Order by the archived_at column
 *
 * @method     ChildSessionsArchiveQuery groupByIdSession() Group by the ID_SESSION column
 * @method     ChildSessionsArchiveQuery groupByIdUser() Group by the ID_USER column
 * @method     ChildSessionsArchiveQuery groupByIp() Group by the IP column
 * @method     ChildSessionsArchiveQuery groupByToken() Group by the TOKEN column
 * @method     ChildSessionsArchiveQuery groupByRefreshToken() Group by the REFRESH_TOKEN column
 * @method     ChildSessionsArchiveQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSessionsArchiveQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSessionsArchiveQuery groupByArchivedAt() Group by the archived_at column
 *
 * @method     ChildSessionsArchiveQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSessionsArchiveQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSessionsArchiveQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSessionsArchiveQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSessionsArchiveQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSessionsArchiveQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSessionsArchive findOne(ConnectionInterface $con = null) Return the first ChildSessionsArchive matching the query
 * @method     ChildSessionsArchive findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSessionsArchive matching the query, or a new ChildSessionsArchive object populated from the query conditions when no match is found
 *
 * @method     ChildSessionsArchive findOneByIdSession(int $ID_SESSION) Return the first ChildSessionsArchive filtered by the ID_SESSION column
 * @method     ChildSessionsArchive findOneByIdUser(int $ID_USER) Return the first ChildSessionsArchive filtered by the ID_USER column
 * @method     ChildSessionsArchive findOneByIp(string $IP) Return the first ChildSessionsArchive filtered by the IP column
 * @method     ChildSessionsArchive findOneByToken(string $TOKEN) Return the first ChildSessionsArchive filtered by the TOKEN column
 * @method     ChildSessionsArchive findOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildSessionsArchive filtered by the REFRESH_TOKEN column
 * @method     ChildSessionsArchive findOneByCreatedAt(string $created_at) Return the first ChildSessionsArchive filtered by the created_at column
 * @method     ChildSessionsArchive findOneByUpdatedAt(string $updated_at) Return the first ChildSessionsArchive filtered by the updated_at column
 * @method     ChildSessionsArchive findOneByArchivedAt(string $archived_at) Return the first ChildSessionsArchive filtered by the archived_at column *

 * @method     ChildSessionsArchive requirePk($key, ConnectionInterface $con = null) Return the ChildSessionsArchive by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOne(ConnectionInterface $con = null) Return the first ChildSessionsArchive matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSessionsArchive requireOneByIdSession(int $ID_SESSION) Return the first ChildSessionsArchive filtered by the ID_SESSION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByIdUser(int $ID_USER) Return the first ChildSessionsArchive filtered by the ID_USER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByIp(string $IP) Return the first ChildSessionsArchive filtered by the IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByToken(string $TOKEN) Return the first ChildSessionsArchive filtered by the TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildSessionsArchive filtered by the REFRESH_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByCreatedAt(string $created_at) Return the first ChildSessionsArchive filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByUpdatedAt(string $updated_at) Return the first ChildSessionsArchive filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionsArchive requireOneByArchivedAt(string $archived_at) Return the first ChildSessionsArchive filtered by the archived_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSessionsArchive[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSessionsArchive objects based on current ModelCriteria
 * @method     ChildSessionsArchive[]|ObjectCollection findByIdSession(int $ID_SESSION) Return ChildSessionsArchive objects filtered by the ID_SESSION column
 * @method     ChildSessionsArchive[]|ObjectCollection findByIdUser(int $ID_USER) Return ChildSessionsArchive objects filtered by the ID_USER column
 * @method     ChildSessionsArchive[]|ObjectCollection findByIp(string $IP) Return ChildSessionsArchive objects filtered by the IP column
 * @method     ChildSessionsArchive[]|ObjectCollection findByToken(string $TOKEN) Return ChildSessionsArchive objects filtered by the TOKEN column
 * @method     ChildSessionsArchive[]|ObjectCollection findByRefreshToken(string $REFRESH_TOKEN) Return ChildSessionsArchive objects filtered by the REFRESH_TOKEN column
 * @method     ChildSessionsArchive[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSessionsArchive objects filtered by the created_at column
 * @method     ChildSessionsArchive[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSessionsArchive objects filtered by the updated_at column
 * @method     ChildSessionsArchive[]|ObjectCollection findByArchivedAt(string $archived_at) Return ChildSessionsArchive objects filtered by the archived_at column
 * @method     ChildSessionsArchive[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SessionsArchiveQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PSFS\Auth\Models\Base\SessionsArchiveQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Auth', $modelName = '\\PSFS\\Auth\\Models\\SessionsArchive', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSessionsArchiveQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSessionsArchiveQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSessionsArchiveQuery) {
            return $criteria;
        }
        $query = new ChildSessionsArchiveQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSessionsArchive|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SessionsArchiveTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SessionsArchiveTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSessionsArchive A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_SESSION, ID_USER, IP, TOKEN, REFRESH_TOKEN, created_at, updated_at, archived_at FROM Auth_SESSIONS_archive WHERE ID_SESSION = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSessionsArchive $obj */
            $obj = new ChildSessionsArchive();
            $obj->hydrate($row);
            SessionsArchiveTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSessionsArchive|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID_SESSION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSession(1234); // WHERE ID_SESSION = 1234
     * $query->filterByIdSession(array(12, 34)); // WHERE ID_SESSION IN (12, 34)
     * $query->filterByIdSession(array('min' => 12)); // WHERE ID_SESSION > 12
     * </code>
     *
     * @param     mixed $idSession The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByIdSession($idSession = null, $comparison = null)
    {
        if (is_array($idSession)) {
            $useMinMax = false;
            if (isset($idSession['min'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $idSession['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSession['max'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $idSession['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $idSession, $comparison);
    }

    /**
     * Filter the query on the ID_USER column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE ID_USER = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE ID_USER IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE ID_USER > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the IP column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE IP = 'fooValue'
     * $query->filterByIp('%fooValue%', Criteria::LIKE); // WHERE IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the TOKEN column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE TOKEN = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE TOKEN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query on the REFRESH_TOKEN column
     *
     * Example usage:
     * <code>
     * $query->filterByRefreshToken('fooValue');   // WHERE REFRESH_TOKEN = 'fooValue'
     * $query->filterByRefreshToken('%fooValue%', Criteria::LIKE); // WHERE REFRESH_TOKEN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $refreshToken The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByRefreshToken($refreshToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refreshToken)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_REFRESH_TOKEN, $refreshToken, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the archived_at column
     *
     * Example usage:
     * <code>
     * $query->filterByArchivedAt('2011-03-14'); // WHERE archived_at = '2011-03-14'
     * $query->filterByArchivedAt('now'); // WHERE archived_at = '2011-03-14'
     * $query->filterByArchivedAt(array('max' => 'yesterday')); // WHERE archived_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $archivedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function filterByArchivedAt($archivedAt = null, $comparison = null)
    {
        if (is_array($archivedAt)) {
            $useMinMax = false;
            if (isset($archivedAt['min'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($archivedAt['max'])) {
                $this->addUsingAlias(SessionsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSessionsArchive $sessionsArchive Object to remove from the list of results
     *
     * @return $this|ChildSessionsArchiveQuery The current query, for fluid interface
     */
    public function prune($sessionsArchive = null)
    {
        if ($sessionsArchive) {
            $this->addUsingAlias(SessionsArchiveTableMap::COL_ID_SESSION, $sessionsArchive->getIdSession(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Auth_SESSIONS_archive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionsArchiveTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SessionsArchiveTableMap::clearInstancePool();
            SessionsArchiveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionsArchiveTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SessionsArchiveTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SessionsArchiveTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SessionsArchiveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SessionsArchiveQuery
