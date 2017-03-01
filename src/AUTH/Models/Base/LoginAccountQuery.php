<?php

namespace AUTH\Models\Base;

use \Exception;
use \PDO;
use AUTH\Models\LoginAccount as ChildLoginAccount;
use AUTH\Models\LoginAccountQuery as ChildLoginAccountQuery;
use AUTH\Models\Map\LoginAccountTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'AUTH_ACCOUNTS' table.
 *
 * Table with the login accounts
 *
 * @method     ChildLoginAccountQuery orderByIdAccount($order = Criteria::ASC) Order by the ID_ACCOUNT column
 * @method     ChildLoginAccountQuery orderByIdSocial($order = Criteria::ASC) Order by the ID_PROVIDER column
 * @method     ChildLoginAccountQuery orderById($order = Criteria::ASC) Order by the IDENTIFIER column
 * @method     ChildLoginAccountQuery orderByAccessToken($order = Criteria::ASC) Order by the ACCESS_TOKEN column
 * @method     ChildLoginAccountQuery orderByRefreshToken($order = Criteria::ASC) Order by the REFRESH_TOKEN column
 * @method     ChildLoginAccountQuery orderByExpireDate($order = Criteria::ASC) Order by the EXPIRES column
 * @method     ChildLoginAccountQuery orderByAccountRole($order = Criteria::ASC) Order by the ROLE column
 * @method     ChildLoginAccountQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLoginAccountQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLoginAccountQuery groupByIdAccount() Group by the ID_ACCOUNT column
 * @method     ChildLoginAccountQuery groupByIdSocial() Group by the ID_PROVIDER column
 * @method     ChildLoginAccountQuery groupById() Group by the IDENTIFIER column
 * @method     ChildLoginAccountQuery groupByAccessToken() Group by the ACCESS_TOKEN column
 * @method     ChildLoginAccountQuery groupByRefreshToken() Group by the REFRESH_TOKEN column
 * @method     ChildLoginAccountQuery groupByExpireDate() Group by the EXPIRES column
 * @method     ChildLoginAccountQuery groupByAccountRole() Group by the ROLE column
 * @method     ChildLoginAccountQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLoginAccountQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLoginAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoginAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoginAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoginAccountQuery leftJoinAccountProvider($relationAlias = null) Adds a LEFT JOIN clause to the query using the AccountProvider relation
 * @method     ChildLoginAccountQuery rightJoinAccountProvider($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AccountProvider relation
 * @method     ChildLoginAccountQuery innerJoinAccountProvider($relationAlias = null) Adds a INNER JOIN clause to the query using the AccountProvider relation
 *
 * @method     ChildLoginAccountQuery joinWithAccountProvider($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AccountProvider relation
 *
 * @method     ChildLoginAccountQuery leftJoinWithAccountProvider() Adds a LEFT JOIN clause and with to the query using the AccountProvider relation
 * @method     ChildLoginAccountQuery rightJoinWithAccountProvider() Adds a RIGHT JOIN clause and with to the query using the AccountProvider relation
 * @method     ChildLoginAccountQuery innerJoinWithAccountProvider() Adds a INNER JOIN clause and with to the query using the AccountProvider relation
 *
 * @method     \AUTH\Models\LoginProviderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginAccount findOne(ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query
 * @method     ChildLoginAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query, or a new ChildLoginAccount object populated from the query conditions when no match is found
 *
 * @method     ChildLoginAccount findOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccount filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccount findOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginAccount filtered by the ID_PROVIDER column
 * @method     ChildLoginAccount findOneById(string $IDENTIFIER) Return the first ChildLoginAccount filtered by the IDENTIFIER column
 * @method     ChildLoginAccount findOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildLoginAccount filtered by the ACCESS_TOKEN column
 * @method     ChildLoginAccount findOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildLoginAccount filtered by the REFRESH_TOKEN column
 * @method     ChildLoginAccount findOneByExpireDate(string $EXPIRES) Return the first ChildLoginAccount filtered by the EXPIRES column
 * @method     ChildLoginAccount findOneByAccountRole(int $ROLE) Return the first ChildLoginAccount filtered by the ROLE column
 * @method     ChildLoginAccount findOneByCreatedAt(string $created_at) Return the first ChildLoginAccount filtered by the created_at column
 * @method     ChildLoginAccount findOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccount filtered by the updated_at column *

 * @method     ChildLoginAccount requirePk($key, ConnectionInterface $con = null) Return the ChildLoginAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOne(ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccount requireOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccount filtered by the ID_ACCOUNT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginAccount filtered by the ID_PROVIDER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneById(string $IDENTIFIER) Return the first ChildLoginAccount filtered by the IDENTIFIER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildLoginAccount filtered by the ACCESS_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildLoginAccount filtered by the REFRESH_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByExpireDate(string $EXPIRES) Return the first ChildLoginAccount filtered by the EXPIRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByAccountRole(int $ROLE) Return the first ChildLoginAccount filtered by the ROLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByCreatedAt(string $created_at) Return the first ChildLoginAccount filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccount filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoginAccount objects based on current ModelCriteria
 * @method     ChildLoginAccount[]|ObjectCollection findByIdAccount(int $ID_ACCOUNT) Return ChildLoginAccount objects filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccount[]|ObjectCollection findByIdSocial(int $ID_PROVIDER) Return ChildLoginAccount objects filtered by the ID_PROVIDER column
 * @method     ChildLoginAccount[]|ObjectCollection findById(string $IDENTIFIER) Return ChildLoginAccount objects filtered by the IDENTIFIER column
 * @method     ChildLoginAccount[]|ObjectCollection findByAccessToken(string $ACCESS_TOKEN) Return ChildLoginAccount objects filtered by the ACCESS_TOKEN column
 * @method     ChildLoginAccount[]|ObjectCollection findByRefreshToken(string $REFRESH_TOKEN) Return ChildLoginAccount objects filtered by the REFRESH_TOKEN column
 * @method     ChildLoginAccount[]|ObjectCollection findByExpireDate(string $EXPIRES) Return ChildLoginAccount objects filtered by the EXPIRES column
 * @method     ChildLoginAccount[]|ObjectCollection findByAccountRole(int $ROLE) Return ChildLoginAccount objects filtered by the ROLE column
 * @method     ChildLoginAccount[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildLoginAccount objects filtered by the created_at column
 * @method     ChildLoginAccount[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildLoginAccount objects filtered by the updated_at column
 * @method     ChildLoginAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoginAccountQuery extends ModelCriteria
{

    // query_cache behavior
    protected $queryKey = '';
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginAccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoginAccountQuery) {
            return $criteria;
        }
        $query = new ChildLoginAccountQuery();
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
     * @return ChildLoginAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoginAccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoginAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_ACCOUNT, ID_PROVIDER, IDENTIFIER, ACCESS_TOKEN, REFRESH_TOKEN, EXPIRES, ROLE, created_at, updated_at FROM AUTH_ACCOUNTS WHERE ID_ACCOUNT = :p0';
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
            /** @var ChildLoginAccount $obj */
            $obj = new ChildLoginAccount();
            $obj->hydrate($row);
            LoginAccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoginAccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $keys, Criteria::IN);
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
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByIdAccount($idAccount = null, $comparison = null)
    {
        if (is_array($idAccount)) {
            $useMinMax = false;
            if (isset($idAccount['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $idAccount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAccount['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $idAccount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $idAccount, $comparison);
    }

    /**
     * Filter the query on the ID_PROVIDER column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSocial(1234); // WHERE ID_PROVIDER = 1234
     * $query->filterByIdSocial(array(12, 34)); // WHERE ID_PROVIDER IN (12, 34)
     * $query->filterByIdSocial(array('min' => 12)); // WHERE ID_PROVIDER > 12
     * </code>
     *
     * @see       filterByAccountProvider()
     *
     * @param     mixed $idSocial The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByIdSocial($idSocial = null, $comparison = null)
    {
        if (is_array($idSocial)) {
            $useMinMax = false;
            if (isset($idSocial['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $idSocial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSocial['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $idSocial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $idSocial, $comparison);
    }

    /**
     * Filter the query on the IDENTIFIER column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE IDENTIFIER = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE IDENTIFIER LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_IDENTIFIER, $id, $comparison);
    }

    /**
     * Filter the query on the ACCESS_TOKEN column
     *
     * @param     mixed $accessToken The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByAccessToken($accessToken = null, $comparison = null)
    {

        return $this->addUsingAlias(LoginAccountTableMap::COL_ACCESS_TOKEN, $accessToken, $comparison);
    }

    /**
     * Filter the query on the REFRESH_TOKEN column
     *
     * @param     mixed $refreshToken The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByRefreshToken($refreshToken = null, $comparison = null)
    {

        return $this->addUsingAlias(LoginAccountTableMap::COL_REFRESH_TOKEN, $refreshToken, $comparison);
    }

    /**
     * Filter the query on the EXPIRES column
     *
     * Example usage:
     * <code>
     * $query->filterByExpireDate('2011-03-14'); // WHERE EXPIRES = '2011-03-14'
     * $query->filterByExpireDate('now'); // WHERE EXPIRES = '2011-03-14'
     * $query->filterByExpireDate(array('max' => 'yesterday')); // WHERE EXPIRES > '2011-03-13'
     * </code>
     *
     * @param     mixed $expireDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByExpireDate($expireDate = null, $comparison = null)
    {
        if (is_array($expireDate)) {
            $useMinMax = false;
            if (isset($expireDate['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_EXPIRES, $expireDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expireDate['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_EXPIRES, $expireDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_EXPIRES, $expireDate, $comparison);
    }

    /**
     * Filter the query on the ROLE column
     *
     * @param     mixed $accountRole The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByAccountRole($accountRole = null, $comparison = null)
    {
        $valueSet = LoginAccountTableMap::getValueSet(LoginAccountTableMap::COL_ROLE);
        if (is_scalar($accountRole)) {
            if (!in_array($accountRole, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $accountRole));
            }
            $accountRole = array_search($accountRole, $valueSet);
        } elseif (is_array($accountRole)) {
            $convertedValues = array();
            foreach ($accountRole as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $accountRole = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_ROLE, $accountRole, $comparison);
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
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginProvider object
     *
     * @param \AUTH\Models\LoginProvider|ObjectCollection $loginProvider The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoginAccountQuery The current query, for fluid interface
     */
    public function filterByAccountProvider($loginProvider, $comparison = null)
    {
        if ($loginProvider instanceof \AUTH\Models\LoginProvider) {
            return $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $loginProvider->getIdProvider(), $comparison);
        } elseif ($loginProvider instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $loginProvider->toKeyValue('PrimaryKey', 'IdProvider'), $comparison);
        } else {
            throw new PropelException('filterByAccountProvider() only accepts arguments of type \AUTH\Models\LoginProvider or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AccountProvider relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function joinAccountProvider($relationAlias = null, $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AccountProvider');

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
            $this->addJoinObject($join, 'AccountProvider');
        }

        return $this;
    }

    /**
     * Use the AccountProvider relation LoginProvider object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginProviderQuery A secondary query class using the current class as primary query
     */
    public function useAccountProviderQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinAccountProvider($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AccountProvider', '\AUTH\Models\LoginProviderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoginAccount $loginAccount Object to remove from the list of results
     *
     * @return $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function prune($loginAccount = null)
    {
        if ($loginAccount) {
            $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $loginAccount->getIdAccount(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePreDelete(ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->findRelatedAccountProviderAccountss($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param     int $affectedRows the number of deleted rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostDelete($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->updateRelatedAccountProviderAccountss($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param     array $values The associative array of columns and values for the update
     * @param     ConnectionInterface $con The connection object used by the query
     * @param     boolean $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->findRelatedAccountProviderAccountss($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param     int $affectedRows the number of updated rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostUpdate($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->updateRelatedAccountProviderAccountss($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the AUTH_ACCOUNTS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginAccountTableMap::clearInstancePool();
            LoginAccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginAccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginAccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginAccountTableMap::clearRelatedInstancePool();

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

        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LoginAccountTableMap::DATABASE_NAME);
        $db = Propel::getServiceContainer()->getAdapter(LoginAccountTableMap::DATABASE_NAME);

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
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginAccountTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginAccountTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginAccountTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildLoginAccountQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginAccountTableMap::COL_CREATED_AT);
    }

    // aggregate_column_relation_aggregate_column behavior

    /**
     * Finds the related LoginProvider objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedAccountProviderAccountss($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->accountProviderAccountss = \AUTH\Models\LoginProviderQuery::create()
            ->joinLoginAccount($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedAccountProviderAccountss($con)
    {
        foreach ($this->accountProviderAccountss as $accountProviderAccounts) {
            $accountProviderAccounts->updateAccounts($con);
        }
        $this->accountProviderAccountss = array();
    }

} // LoginAccountQuery
