<?php

namespace PSFS\Auth\Models\Base;

use \Exception;
use \PDO;
use PSFS\Auth\Models\AccountsArchive as ChildAccountsArchive;
use PSFS\Auth\Models\AccountsArchiveQuery as ChildAccountsArchiveQuery;
use PSFS\Auth\Models\Map\AccountsArchiveTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Auth_ACCOUNTS_archive' table.
 *
 *
 *
 * @method     ChildAccountsArchiveQuery orderByIdAccount($order = Criteria::ASC) Order by the ID_ACCOUNT column
 * @method     ChildAccountsArchiveQuery orderByIdUser($order = Criteria::ASC) Order by the ID_USER column
 * @method     ChildAccountsArchiveQuery orderByIdExternal($order = Criteria::ASC) Order by the ID_EXTERNAL column
 * @method     ChildAccountsArchiveQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildAccountsArchiveQuery orderByAccessToken($order = Criteria::ASC) Order by the ACCESS_TOKEN column
 * @method     ChildAccountsArchiveQuery orderByRefreshToken($order = Criteria::ASC) Order by the REFRESH_TOKEN column
 * @method     ChildAccountsArchiveQuery orderByExpires($order = Criteria::ASC) Order by the EXPIRES column
 * @method     ChildAccountsArchiveQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAccountsArchiveQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildAccountsArchiveQuery orderByArchivedAt($order = Criteria::ASC) Order by the archived_at column
 *
 * @method     ChildAccountsArchiveQuery groupByIdAccount() Group by the ID_ACCOUNT column
 * @method     ChildAccountsArchiveQuery groupByIdUser() Group by the ID_USER column
 * @method     ChildAccountsArchiveQuery groupByIdExternal() Group by the ID_EXTERNAL column
 * @method     ChildAccountsArchiveQuery groupByType() Group by the TYPE column
 * @method     ChildAccountsArchiveQuery groupByAccessToken() Group by the ACCESS_TOKEN column
 * @method     ChildAccountsArchiveQuery groupByRefreshToken() Group by the REFRESH_TOKEN column
 * @method     ChildAccountsArchiveQuery groupByExpires() Group by the EXPIRES column
 * @method     ChildAccountsArchiveQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAccountsArchiveQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildAccountsArchiveQuery groupByArchivedAt() Group by the archived_at column
 *
 * @method     ChildAccountsArchiveQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountsArchiveQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountsArchiveQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountsArchiveQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountsArchiveQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountsArchiveQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccountsArchive findOne(ConnectionInterface $con = null) Return the first ChildAccountsArchive matching the query
 * @method     ChildAccountsArchive findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccountsArchive matching the query, or a new ChildAccountsArchive object populated from the query conditions when no match is found
 *
 * @method     ChildAccountsArchive findOneByIdAccount(int $ID_ACCOUNT) Return the first ChildAccountsArchive filtered by the ID_ACCOUNT column
 * @method     ChildAccountsArchive findOneByIdUser(int $ID_USER) Return the first ChildAccountsArchive filtered by the ID_USER column
 * @method     ChildAccountsArchive findOneByIdExternal(string $ID_EXTERNAL) Return the first ChildAccountsArchive filtered by the ID_EXTERNAL column
 * @method     ChildAccountsArchive findOneByType(int $TYPE) Return the first ChildAccountsArchive filtered by the TYPE column
 * @method     ChildAccountsArchive findOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildAccountsArchive filtered by the ACCESS_TOKEN column
 * @method     ChildAccountsArchive findOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildAccountsArchive filtered by the REFRESH_TOKEN column
 * @method     ChildAccountsArchive findOneByExpires(string $EXPIRES) Return the first ChildAccountsArchive filtered by the EXPIRES column
 * @method     ChildAccountsArchive findOneByCreatedAt(string $created_at) Return the first ChildAccountsArchive filtered by the created_at column
 * @method     ChildAccountsArchive findOneByUpdatedAt(string $updated_at) Return the first ChildAccountsArchive filtered by the updated_at column
 * @method     ChildAccountsArchive findOneByArchivedAt(string $archived_at) Return the first ChildAccountsArchive filtered by the archived_at column *

 * @method     ChildAccountsArchive requirePk($key, ConnectionInterface $con = null) Return the ChildAccountsArchive by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOne(ConnectionInterface $con = null) Return the first ChildAccountsArchive matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccountsArchive requireOneByIdAccount(int $ID_ACCOUNT) Return the first ChildAccountsArchive filtered by the ID_ACCOUNT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByIdUser(int $ID_USER) Return the first ChildAccountsArchive filtered by the ID_USER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByIdExternal(string $ID_EXTERNAL) Return the first ChildAccountsArchive filtered by the ID_EXTERNAL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByType(int $TYPE) Return the first ChildAccountsArchive filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildAccountsArchive filtered by the ACCESS_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildAccountsArchive filtered by the REFRESH_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByExpires(string $EXPIRES) Return the first ChildAccountsArchive filtered by the EXPIRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByCreatedAt(string $created_at) Return the first ChildAccountsArchive filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByUpdatedAt(string $updated_at) Return the first ChildAccountsArchive filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountsArchive requireOneByArchivedAt(string $archived_at) Return the first ChildAccountsArchive filtered by the archived_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccountsArchive[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccountsArchive objects based on current ModelCriteria
 * @method     ChildAccountsArchive[]|ObjectCollection findByIdAccount(int $ID_ACCOUNT) Return ChildAccountsArchive objects filtered by the ID_ACCOUNT column
 * @method     ChildAccountsArchive[]|ObjectCollection findByIdUser(int $ID_USER) Return ChildAccountsArchive objects filtered by the ID_USER column
 * @method     ChildAccountsArchive[]|ObjectCollection findByIdExternal(string $ID_EXTERNAL) Return ChildAccountsArchive objects filtered by the ID_EXTERNAL column
 * @method     ChildAccountsArchive[]|ObjectCollection findByType(int $TYPE) Return ChildAccountsArchive objects filtered by the TYPE column
 * @method     ChildAccountsArchive[]|ObjectCollection findByAccessToken(string $ACCESS_TOKEN) Return ChildAccountsArchive objects filtered by the ACCESS_TOKEN column
 * @method     ChildAccountsArchive[]|ObjectCollection findByRefreshToken(string $REFRESH_TOKEN) Return ChildAccountsArchive objects filtered by the REFRESH_TOKEN column
 * @method     ChildAccountsArchive[]|ObjectCollection findByExpires(string $EXPIRES) Return ChildAccountsArchive objects filtered by the EXPIRES column
 * @method     ChildAccountsArchive[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildAccountsArchive objects filtered by the created_at column
 * @method     ChildAccountsArchive[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildAccountsArchive objects filtered by the updated_at column
 * @method     ChildAccountsArchive[]|ObjectCollection findByArchivedAt(string $archived_at) Return ChildAccountsArchive objects filtered by the archived_at column
 * @method     ChildAccountsArchive[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountsArchiveQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PSFS\Auth\Models\Base\AccountsArchiveQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Auth', $modelName = '\\PSFS\\Auth\\Models\\AccountsArchive', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountsArchiveQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountsArchiveQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountsArchiveQuery) {
            return $criteria;
        }
        $query = new ChildAccountsArchiveQuery();
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
     * @return ChildAccountsArchive|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountsArchiveTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountsArchiveTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccountsArchive A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_ACCOUNT, ID_USER, ID_EXTERNAL, TYPE, ACCESS_TOKEN, REFRESH_TOKEN, EXPIRES, created_at, updated_at, archived_at FROM Auth_ACCOUNTS_archive WHERE ID_ACCOUNT = :p0';
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
            /** @var ChildAccountsArchive $obj */
            $obj = new ChildAccountsArchive();
            $obj->hydrate($row);
            AccountsArchiveTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccountsArchive|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID_ACCOUNT column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAccount(1234); // WHERE ID_ACCOUNT = 1234
     * $query->filterByIdAccount(array(12, 34)); // WHERE ID_ACCOUNT IN (12, 34)
     * $query->filterByIdAccount(array('min' => 12)); // WHERE ID_ACCOUNT > 12
     * </code>
     *
     * @param     mixed $idAccount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByIdAccount($idAccount = null, $comparison = null)
    {
        if (is_array($idAccount)) {
            $useMinMax = false;
            if (isset($idAccount['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $idAccount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAccount['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $idAccount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $idAccount, $comparison);
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the ID_EXTERNAL column
     *
     * Example usage:
     * <code>
     * $query->filterByIdExternal('fooValue');   // WHERE ID_EXTERNAL = 'fooValue'
     * $query->filterByIdExternal('%fooValue%', Criteria::LIKE); // WHERE ID_EXTERNAL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idExternal The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByIdExternal($idExternal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idExternal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_EXTERNAL, $idExternal, $comparison);
    }

    /**
     * Filter the query on the TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE TYPE = 1234
     * $query->filterByType(array(12, 34)); // WHERE TYPE IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE TYPE > 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the ACCESS_TOKEN column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessToken('fooValue');   // WHERE ACCESS_TOKEN = 'fooValue'
     * $query->filterByAccessToken('%fooValue%', Criteria::LIKE); // WHERE ACCESS_TOKEN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accessToken The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByAccessToken($accessToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accessToken)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ACCESS_TOKEN, $accessToken, $comparison);
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByRefreshToken($refreshToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refreshToken)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_REFRESH_TOKEN, $refreshToken, $comparison);
    }

    /**
     * Filter the query on the EXPIRES column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires('fooValue');   // WHERE EXPIRES = 'fooValue'
     * $query->filterByExpires('%fooValue%', Criteria::LIKE); // WHERE EXPIRES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $expires The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByExpires($expires = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expires)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_EXPIRES, $expires, $comparison);
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function filterByArchivedAt($archivedAt = null, $comparison = null)
    {
        if (is_array($archivedAt)) {
            $useMinMax = false;
            if (isset($archivedAt['min'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($archivedAt['max'])) {
                $this->addUsingAlias(AccountsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsArchiveTableMap::COL_ARCHIVED_AT, $archivedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAccountsArchive $accountsArchive Object to remove from the list of results
     *
     * @return $this|ChildAccountsArchiveQuery The current query, for fluid interface
     */
    public function prune($accountsArchive = null)
    {
        if ($accountsArchive) {
            $this->addUsingAlias(AccountsArchiveTableMap::COL_ID_ACCOUNT, $accountsArchive->getIdAccount(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Auth_ACCOUNTS_archive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsArchiveTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountsArchiveTableMap::clearInstancePool();
            AccountsArchiveTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsArchiveTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountsArchiveTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccountsArchiveTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccountsArchiveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AccountsArchiveQuery
