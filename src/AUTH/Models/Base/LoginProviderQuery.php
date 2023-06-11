<?php

namespace AUTH\Models\Base;

use \Exception;
use \PDO;
use AUTH\Models\LoginProvider as ChildLoginProvider;
use AUTH\Models\LoginProviderQuery as ChildLoginProviderQuery;
use AUTH\Models\Map\LoginProviderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'AUTH_PROVIDERS' table.
 *
 * Table with the login providers
 *
 * @method     ChildLoginProviderQuery orderByIdProvider($order = Criteria::ASC) Order by the ID_PROVIDER column
 * @method     ChildLoginProviderQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildLoginProviderQuery orderByDebug($order = Criteria::ASC) Order by the DEV column
 * @method     ChildLoginProviderQuery orderByClient($order = Criteria::ASC) Order by the CLIENT column
 * @method     ChildLoginProviderQuery orderBySecret($order = Criteria::ASC) Order by the SECRET column
 * @method     ChildLoginProviderQuery orderByParent($order = Criteria::ASC) Order by the PARENT_REF column
 * @method     ChildLoginProviderQuery orderByScopes($order = Criteria::ASC) Order by the SCOPES column
 * @method     ChildLoginProviderQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildLoginProviderQuery orderByCustomerCode($order = Criteria::ASC) Order by the CUSTOMER_CODE column
 * @method     ChildLoginProviderQuery orderByExpiration($order = Criteria::ASC) Order by the EXPIRATION column
 * @method     ChildLoginProviderQuery orderByExpirationPeriod($order = Criteria::ASC) Order by the EXPIRATION_PERIOD column
 * @method     ChildLoginProviderQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLoginProviderQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildLoginProviderQuery orderByAccounts($order = Criteria::ASC) Order by the ACCOUNTS column
 *
 * @method     ChildLoginProviderQuery groupByIdProvider() Group by the ID_PROVIDER column
 * @method     ChildLoginProviderQuery groupByName() Group by the NAME column
 * @method     ChildLoginProviderQuery groupByDebug() Group by the DEV column
 * @method     ChildLoginProviderQuery groupByClient() Group by the CLIENT column
 * @method     ChildLoginProviderQuery groupBySecret() Group by the SECRET column
 * @method     ChildLoginProviderQuery groupByParent() Group by the PARENT_REF column
 * @method     ChildLoginProviderQuery groupByScopes() Group by the SCOPES column
 * @method     ChildLoginProviderQuery groupByActive() Group by the ACTIVE column
 * @method     ChildLoginProviderQuery groupByCustomerCode() Group by the CUSTOMER_CODE column
 * @method     ChildLoginProviderQuery groupByExpiration() Group by the EXPIRATION column
 * @method     ChildLoginProviderQuery groupByExpirationPeriod() Group by the EXPIRATION_PERIOD column
 * @method     ChildLoginProviderQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLoginProviderQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildLoginProviderQuery groupByAccounts() Group by the ACCOUNTS column
 *
 * @method     ChildLoginProviderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginProviderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginProviderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginProviderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoginProviderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoginProviderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoginProviderQuery leftJoinLoginPath($relationAlias = null) Adds a LEFT JOIN clause to the query using the LoginPath relation
 * @method     ChildLoginProviderQuery rightJoinLoginPath($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LoginPath relation
 * @method     ChildLoginProviderQuery innerJoinLoginPath($relationAlias = null) Adds a INNER JOIN clause to the query using the LoginPath relation
 *
 * @method     ChildLoginProviderQuery joinWithLoginPath($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LoginPath relation
 *
 * @method     ChildLoginProviderQuery leftJoinWithLoginPath() Adds a LEFT JOIN clause and with to the query using the LoginPath relation
 * @method     ChildLoginProviderQuery rightJoinWithLoginPath() Adds a RIGHT JOIN clause and with to the query using the LoginPath relation
 * @method     ChildLoginProviderQuery innerJoinWithLoginPath() Adds a INNER JOIN clause and with to the query using the LoginPath relation
 *
 * @method     ChildLoginProviderQuery leftJoinLoginAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the LoginAccount relation
 * @method     ChildLoginProviderQuery rightJoinLoginAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LoginAccount relation
 * @method     ChildLoginProviderQuery innerJoinLoginAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the LoginAccount relation
 *
 * @method     ChildLoginProviderQuery joinWithLoginAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LoginAccount relation
 *
 * @method     ChildLoginProviderQuery leftJoinWithLoginAccount() Adds a LEFT JOIN clause and with to the query using the LoginAccount relation
 * @method     ChildLoginProviderQuery rightJoinWithLoginAccount() Adds a RIGHT JOIN clause and with to the query using the LoginAccount relation
 * @method     ChildLoginProviderQuery innerJoinWithLoginAccount() Adds a INNER JOIN clause and with to the query using the LoginAccount relation
 *
 * @method     \AUTH\Models\LoginPathQuery|\AUTH\Models\LoginAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginProvider|null findOne(ConnectionInterface $con = null) Return the first ChildLoginProvider matching the query
 * @method     ChildLoginProvider findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoginProvider matching the query, or a new ChildLoginProvider object populated from the query conditions when no match is found
 *
 * @method     ChildLoginProvider|null findOneByIdProvider(int $ID_PROVIDER) Return the first ChildLoginProvider filtered by the ID_PROVIDER column
 * @method     ChildLoginProvider|null findOneByName(int $NAME) Return the first ChildLoginProvider filtered by the NAME column
 * @method     ChildLoginProvider|null findOneByDebug(boolean $DEV) Return the first ChildLoginProvider filtered by the DEV column
 * @method     ChildLoginProvider|null findOneByClient(string $CLIENT) Return the first ChildLoginProvider filtered by the CLIENT column
 * @method     ChildLoginProvider|null findOneBySecret(string $SECRET) Return the first ChildLoginProvider filtered by the SECRET column
 * @method     ChildLoginProvider|null findOneByParent(string $PARENT_REF) Return the first ChildLoginProvider filtered by the PARENT_REF column
 * @method     ChildLoginProvider|null findOneByScopes(string $SCOPES) Return the first ChildLoginProvider filtered by the SCOPES column
 * @method     ChildLoginProvider|null findOneByActive(boolean $ACTIVE) Return the first ChildLoginProvider filtered by the ACTIVE column
 * @method     ChildLoginProvider|null findOneByCustomerCode(string $CUSTOMER_CODE) Return the first ChildLoginProvider filtered by the CUSTOMER_CODE column
 * @method     ChildLoginProvider|null findOneByExpiration(int $EXPIRATION) Return the first ChildLoginProvider filtered by the EXPIRATION column
 * @method     ChildLoginProvider|null findOneByExpirationPeriod(int $EXPIRATION_PERIOD) Return the first ChildLoginProvider filtered by the EXPIRATION_PERIOD column
 * @method     ChildLoginProvider|null findOneByCreatedAt(string $created_at) Return the first ChildLoginProvider filtered by the created_at column
 * @method     ChildLoginProvider|null findOneByUpdatedAt(string $updated_at) Return the first ChildLoginProvider filtered by the updated_at column
 * @method     ChildLoginProvider|null findOneByAccounts(int $ACCOUNTS) Return the first ChildLoginProvider filtered by the ACCOUNTS column *

 * @method     ChildLoginProvider requirePk($key, ConnectionInterface $con = null) Return the ChildLoginProvider by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOne(ConnectionInterface $con = null) Return the first ChildLoginProvider matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginProvider requireOneByIdProvider(int $ID_PROVIDER) Return the first ChildLoginProvider filtered by the ID_PROVIDER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByName(int $NAME) Return the first ChildLoginProvider filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByDebug(boolean $DEV) Return the first ChildLoginProvider filtered by the DEV column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByClient(string $CLIENT) Return the first ChildLoginProvider filtered by the CLIENT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneBySecret(string $SECRET) Return the first ChildLoginProvider filtered by the SECRET column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByParent(string $PARENT_REF) Return the first ChildLoginProvider filtered by the PARENT_REF column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByScopes(string $SCOPES) Return the first ChildLoginProvider filtered by the SCOPES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByActive(boolean $ACTIVE) Return the first ChildLoginProvider filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByCustomerCode(string $CUSTOMER_CODE) Return the first ChildLoginProvider filtered by the CUSTOMER_CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByExpiration(int $EXPIRATION) Return the first ChildLoginProvider filtered by the EXPIRATION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByExpirationPeriod(int $EXPIRATION_PERIOD) Return the first ChildLoginProvider filtered by the EXPIRATION_PERIOD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByCreatedAt(string $created_at) Return the first ChildLoginProvider filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByUpdatedAt(string $updated_at) Return the first ChildLoginProvider filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginProvider requireOneByAccounts(int $ACCOUNTS) Return the first ChildLoginProvider filtered by the ACCOUNTS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginProvider[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoginProvider objects based on current ModelCriteria
 * @method     ChildLoginProvider[]|ObjectCollection findByIdProvider(int $ID_PROVIDER) Return ChildLoginProvider objects filtered by the ID_PROVIDER column
 * @method     ChildLoginProvider[]|ObjectCollection findByName(int $NAME) Return ChildLoginProvider objects filtered by the NAME column
 * @method     ChildLoginProvider[]|ObjectCollection findByDebug(boolean $DEV) Return ChildLoginProvider objects filtered by the DEV column
 * @method     ChildLoginProvider[]|ObjectCollection findByClient(string $CLIENT) Return ChildLoginProvider objects filtered by the CLIENT column
 * @method     ChildLoginProvider[]|ObjectCollection findBySecret(string $SECRET) Return ChildLoginProvider objects filtered by the SECRET column
 * @method     ChildLoginProvider[]|ObjectCollection findByParent(string $PARENT_REF) Return ChildLoginProvider objects filtered by the PARENT_REF column
 * @method     ChildLoginProvider[]|ObjectCollection findByScopes(string $SCOPES) Return ChildLoginProvider objects filtered by the SCOPES column
 * @method     ChildLoginProvider[]|ObjectCollection findByActive(boolean $ACTIVE) Return ChildLoginProvider objects filtered by the ACTIVE column
 * @method     ChildLoginProvider[]|ObjectCollection findByCustomerCode(string $CUSTOMER_CODE) Return ChildLoginProvider objects filtered by the CUSTOMER_CODE column
 * @method     ChildLoginProvider[]|ObjectCollection findByExpiration(int $EXPIRATION) Return ChildLoginProvider objects filtered by the EXPIRATION column
 * @method     ChildLoginProvider[]|ObjectCollection findByExpirationPeriod(int $EXPIRATION_PERIOD) Return ChildLoginProvider objects filtered by the EXPIRATION_PERIOD column
 * @method     ChildLoginProvider[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildLoginProvider objects filtered by the created_at column
 * @method     ChildLoginProvider[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildLoginProvider objects filtered by the updated_at column
 * @method     ChildLoginProvider[]|ObjectCollection findByAccounts(int $ACCOUNTS) Return ChildLoginProvider objects filtered by the ACCOUNTS column
 * @method     ChildLoginProvider[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoginProviderQuery extends ModelCriteria
{

    // query_cache behavior
    protected $queryKey = '';
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginProviderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginProvider', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginProviderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginProviderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoginProviderQuery) {
            return $criteria;
        }
        $query = new ChildLoginProviderQuery();
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
     * @return ChildLoginProvider|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoginProviderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoginProvider A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_PROVIDER, NAME, DEV, CLIENT, SECRET, PARENT_REF, SCOPES, ACTIVE, CUSTOMER_CODE, EXPIRATION, EXPIRATION_PERIOD, created_at, updated_at, ACCOUNTS FROM AUTH_PROVIDERS WHERE ID_PROVIDER = :p0';
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
            /** @var ChildLoginProvider $obj */
            $obj = new ChildLoginProvider();
            $obj->hydrate($row);
            LoginProviderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoginProvider|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID_PROVIDER column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProvider(1234); // WHERE ID_PROVIDER = 1234
     * $query->filterByIdProvider(array(12, 34)); // WHERE ID_PROVIDER IN (12, 34)
     * $query->filterByIdProvider(array('min' => 12)); // WHERE ID_PROVIDER > 12
     * </code>
     *
     * @param     mixed $idProvider The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByIdProvider($idProvider = null, $comparison = null)
    {
        if (is_array($idProvider)) {
            $useMinMax = false;
            if (isset($idProvider['min'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $idProvider['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProvider['max'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $idProvider['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $idProvider, $comparison);
    }

    /**
     * Filter the query on the NAME column
     *
     * @param     mixed $name The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        $valueSet = LoginProviderTableMap::getValueSet(LoginProviderTableMap::COL_NAME);
        if (is_scalar($name)) {
            if (!in_array($name, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $name));
            }
            $name = array_search($name, $valueSet);
        } elseif (is_array($name)) {
            $convertedValues = array();
            foreach ($name as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $name = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the DEV column
     *
     * Example usage:
     * <code>
     * $query->filterByDebug(true); // WHERE DEV = true
     * $query->filterByDebug('yes'); // WHERE DEV = true
     * </code>
     *
     * @param     boolean|string $debug The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByDebug($debug = null, $comparison = null)
    {
        if (is_string($debug)) {
            $debug = in_array(strtolower($debug), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_DEV, $debug, $comparison);
    }

    /**
     * Filter the query on the CLIENT column
     *
     * Example usage:
     * <code>
     * $query->filterByClient('fooValue');   // WHERE CLIENT = 'fooValue'
     * $query->filterByClient('%fooValue%', Criteria::LIKE); // WHERE CLIENT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $client The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByClient($client = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($client)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_CLIENT, $client, $comparison);
    }

    /**
     * Filter the query on the SECRET column
     *
     * @param     mixed $secret The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterBySecret($secret = null, $comparison = null)
    {

        return $this->addUsingAlias(LoginProviderTableMap::COL_SECRET, $secret, $comparison);
    }

    /**
     * Filter the query on the PARENT_REF column
     *
     * Example usage:
     * <code>
     * $query->filterByParent('fooValue');   // WHERE PARENT_REF = 'fooValue'
     * $query->filterByParent('%fooValue%', Criteria::LIKE); // WHERE PARENT_REF LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parent The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByParent($parent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parent)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_PARENT_REF, $parent, $comparison);
    }

    /**
     * Filter the query on the SCOPES column
     *
     * Example usage:
     * <code>
     * $query->filterByScopes('fooValue');   // WHERE SCOPES = 'fooValue'
     * $query->filterByScopes('%fooValue%', Criteria::LIKE); // WHERE SCOPES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scopes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByScopes($scopes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scopes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_SCOPES, $scopes, $comparison);
    }

    /**
     * Filter the query on the ACTIVE column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE ACTIVE = true
     * $query->filterByActive('yes'); // WHERE ACTIVE = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the CUSTOMER_CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerCode('fooValue');   // WHERE CUSTOMER_CODE = 'fooValue'
     * $query->filterByCustomerCode('%fooValue%', Criteria::LIKE); // WHERE CUSTOMER_CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customerCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByCustomerCode($customerCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customerCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_CUSTOMER_CODE, $customerCode, $comparison);
    }

    /**
     * Filter the query on the EXPIRATION column
     *
     * @param     mixed $expiration The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByExpiration($expiration = null, $comparison = null)
    {
        $valueSet = LoginProviderTableMap::getValueSet(LoginProviderTableMap::COL_EXPIRATION);
        if (is_scalar($expiration)) {
            if (!in_array($expiration, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $expiration));
            }
            $expiration = array_search($expiration, $valueSet);
        } elseif (is_array($expiration)) {
            $convertedValues = array();
            foreach ($expiration as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $expiration = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_EXPIRATION, $expiration, $comparison);
    }

    /**
     * Filter the query on the EXPIRATION_PERIOD column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationPeriod(1234); // WHERE EXPIRATION_PERIOD = 1234
     * $query->filterByExpirationPeriod(array(12, 34)); // WHERE EXPIRATION_PERIOD IN (12, 34)
     * $query->filterByExpirationPeriod(array('min' => 12)); // WHERE EXPIRATION_PERIOD > 12
     * </code>
     *
     * @param     mixed $expirationPeriod The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByExpirationPeriod($expirationPeriod = null, $comparison = null)
    {
        if (is_array($expirationPeriod)) {
            $useMinMax = false;
            if (isset($expirationPeriod['min'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_EXPIRATION_PERIOD, $expirationPeriod['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationPeriod['max'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_EXPIRATION_PERIOD, $expirationPeriod['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_EXPIRATION_PERIOD, $expirationPeriod, $comparison);
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
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the ACCOUNTS column
     *
     * Example usage:
     * <code>
     * $query->filterByAccounts(1234); // WHERE ACCOUNTS = 1234
     * $query->filterByAccounts(array(12, 34)); // WHERE ACCOUNTS IN (12, 34)
     * $query->filterByAccounts(array('min' => 12)); // WHERE ACCOUNTS > 12
     * </code>
     *
     * @param     mixed $accounts The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByAccounts($accounts = null, $comparison = null)
    {
        if (is_array($accounts)) {
            $useMinMax = false;
            if (isset($accounts['min'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_ACCOUNTS, $accounts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accounts['max'])) {
                $this->addUsingAlias(LoginProviderTableMap::COL_ACCOUNTS, $accounts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginProviderTableMap::COL_ACCOUNTS, $accounts, $comparison);
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginPath object
     *
     * @param \AUTH\Models\LoginPath|ObjectCollection $loginPath the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByLoginPath($loginPath, $comparison = null)
    {
        if ($loginPath instanceof \AUTH\Models\LoginPath) {
            return $this
                ->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $loginPath->getIdSocial(), $comparison);
        } elseif ($loginPath instanceof ObjectCollection) {
            return $this
                ->useLoginPathQuery()
                ->filterByPrimaryKeys($loginPath->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLoginPath() only accepts arguments of type \AUTH\Models\LoginPath or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LoginPath relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function joinLoginPath($relationAlias = null, $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LoginPath');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'LoginPath');
        }

        return $this;
    }

    /**
     * Use the LoginPath relation LoginPath object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginPathQuery A secondary query class using the current class as primary query
     */
    public function useLoginPathQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinLoginPath($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LoginPath', '\AUTH\Models\LoginPathQuery');
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginAccount object
     *
     * @param \AUTH\Models\LoginAccount|ObjectCollection $loginAccount the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLoginProviderQuery The current query, for fluid interface
     */
    public function filterByLoginAccount($loginAccount, $comparison = null)
    {
        if ($loginAccount instanceof \AUTH\Models\LoginAccount) {
            return $this
                ->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $loginAccount->getIdSocial(), $comparison);
        } elseif ($loginAccount instanceof ObjectCollection) {
            return $this
                ->useLoginAccountQuery()
                ->filterByPrimaryKeys($loginAccount->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLoginAccount() only accepts arguments of type \AUTH\Models\LoginAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LoginAccount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function joinLoginAccount($relationAlias = null, $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LoginAccount');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'LoginAccount');
        }

        return $this;
    }

    /**
     * Use the LoginAccount relation LoginAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginAccountQuery A secondary query class using the current class as primary query
     */
    public function useLoginAccountQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinLoginAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LoginAccount', '\AUTH\Models\LoginAccountQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoginProvider $loginProvider Object to remove from the list of results
     *
     * @return $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function prune($loginProvider = null)
    {
        if ($loginProvider) {
            $this->addUsingAlias(LoginProviderTableMap::COL_ID_PROVIDER, $loginProvider->getIdProvider(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the AUTH_PROVIDERS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginProviderTableMap::clearInstancePool();
            LoginProviderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginProviderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginProviderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginProviderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginProviderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // query_cache behavior

    public function setQueryKey($key)
    {
        $this->queryKey = $key;

        return $this;
    }

    public function getQueryKey()
    {
        return $this->queryKey;
    }

    public function cacheContains($key)
    {

        return apc_fetch($key);
    }

    public function cacheFetch($key)
    {

        return apc_fetch($key);
    }

    public function cacheStore($key, $value, $lifetime = 3600)
    {
        apc_store($key, $value, $lifetime);
    }

    public function doSelect(ConnectionInterface $con = null)
    {
        // check that the columns of the main class are already added (if this is the primary ModelCriteria)
        if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
            $this->addSelfSelectColumns();
        }
        $this->configureSelectColumns();

        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LoginProviderTableMap::DATABASE_NAME);
        $db = Propel::getServiceContainer()->getAdapter(LoginProviderTableMap::DATABASE_NAME);

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            $params = array();
            $sql = $this->createSelectSql($params);
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
            } catch (Exception $e) {
                Propel::log($e->getMessage(), Propel::LOG_ERR);
                throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
            }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }

        return $con->getDataFetcher($stmt);
    }

    public function doCount(ConnectionInterface $con = null)
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap($this->getDbName());
        $db = Propel::getServiceContainer()->getAdapter($this->getDbName());

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            // check that the columns of the main class are already added (if this is the primary ModelCriteria)
            if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
                $this->addSelfSelectColumns();
            }

            $this->configureSelectColumns();

            $needsComplexCount = $this->getGroupByColumns()
                || $this->getOffset()
                || $this->getLimit() >= 0
                || $this->getHaving()
                || in_array(Criteria::DISTINCT, $this->getSelectModifiers())
                || count($this->selectQueries) > 0
            ;

            $params = array();
            if ($needsComplexCount) {
                if ($this->needsSelectAliases()) {
                    if ($this->getHaving()) {
                        throw new PropelException('Propel cannot create a COUNT query when using HAVING and  duplicate column names in the SELECT part');
                    }
                    $db->turnSelectColumnsToAliases($this);
                }
                $selectSql = $this->createSelectSql($params);
                $sql = 'SELECT COUNT(*) FROM (' . $selectSql . ') propelmatch4cnt';
            } else {
                // Replace SELECT columns with COUNT(*)
                $this->clearSelectColumns()->addSelectColumn('COUNT(*)');
                $sql = $this->createSelectSql($params);
            }
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute COUNT statement [%s]', $sql), 0, $e);
        }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }

        return $con->getDataFetcher($stmt);
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginProviderTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginProviderTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginProviderTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginProviderTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginProviderTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildLoginProviderQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginProviderTableMap::COL_CREATED_AT);
    }

} // LoginProviderQuery
