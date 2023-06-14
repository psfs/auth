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
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `AUTH_ACCOUNTS` table.
 *
 * Table with the login accounts
 *
 * @method     ChildLoginAccountQuery orderByIdAccount($order = Criteria::ASC) Order by the ID_ACCOUNT column
 * @method     ChildLoginAccountQuery orderByIdSocial($order = Criteria::ASC) Order by the ID_PROVIDER column
 * @method     ChildLoginAccountQuery orderById($order = Criteria::ASC) Order by the IDENTIFIER column
 * @method     ChildLoginAccountQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildLoginAccountQuery orderByAccessToken($order = Criteria::ASC) Order by the ACCESS_TOKEN column
 * @method     ChildLoginAccountQuery orderByRefreshToken($order = Criteria::ASC) Order by the REFRESH_TOKEN column
 * @method     ChildLoginAccountQuery orderByExpireDate($order = Criteria::ASC) Order by the EXPIRES column
 * @method     ChildLoginAccountQuery orderByAccountRole($order = Criteria::ASC) Order by the ROLE column
 * @method     ChildLoginAccountQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildLoginAccountQuery orderByVerified($order = Criteria::ASC) Order by the VERIFIED column
 * @method     ChildLoginAccountQuery orderByRefreshRequest($order = Criteria::ASC) Order by the REFRESH_REQUESTED column
 * @method     ChildLoginAccountQuery orderByResetToken($order = Criteria::ASC) Order by the RESET_TOKEN column
 * @method     ChildLoginAccountQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLoginAccountQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLoginAccountQuery groupByIdAccount() Group by the ID_ACCOUNT column
 * @method     ChildLoginAccountQuery groupByIdSocial() Group by the ID_PROVIDER column
 * @method     ChildLoginAccountQuery groupById() Group by the IDENTIFIER column
 * @method     ChildLoginAccountQuery groupByEmail() Group by the EMAIL column
 * @method     ChildLoginAccountQuery groupByAccessToken() Group by the ACCESS_TOKEN column
 * @method     ChildLoginAccountQuery groupByRefreshToken() Group by the REFRESH_TOKEN column
 * @method     ChildLoginAccountQuery groupByExpireDate() Group by the EXPIRES column
 * @method     ChildLoginAccountQuery groupByAccountRole() Group by the ROLE column
 * @method     ChildLoginAccountQuery groupByActive() Group by the ACTIVE column
 * @method     ChildLoginAccountQuery groupByVerified() Group by the VERIFIED column
 * @method     ChildLoginAccountQuery groupByRefreshRequest() Group by the REFRESH_REQUESTED column
 * @method     ChildLoginAccountQuery groupByResetToken() Group by the RESET_TOKEN column
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
 * @method     ChildLoginAccountQuery leftJoinLoginAccountPassword($relationAlias = null) Adds a LEFT JOIN clause to the query using the LoginAccountPassword relation
 * @method     ChildLoginAccountQuery rightJoinLoginAccountPassword($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LoginAccountPassword relation
 * @method     ChildLoginAccountQuery innerJoinLoginAccountPassword($relationAlias = null) Adds a INNER JOIN clause to the query using the LoginAccountPassword relation
 *
 * @method     ChildLoginAccountQuery joinWithLoginAccountPassword($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LoginAccountPassword relation
 *
 * @method     ChildLoginAccountQuery leftJoinWithLoginAccountPassword() Adds a LEFT JOIN clause and with to the query using the LoginAccountPassword relation
 * @method     ChildLoginAccountQuery rightJoinWithLoginAccountPassword() Adds a RIGHT JOIN clause and with to the query using the LoginAccountPassword relation
 * @method     ChildLoginAccountQuery innerJoinWithLoginAccountPassword() Adds a INNER JOIN clause and with to the query using the LoginAccountPassword relation
 *
 * @method     ChildLoginAccountQuery leftJoinLoginSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the LoginSession relation
 * @method     ChildLoginAccountQuery rightJoinLoginSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LoginSession relation
 * @method     ChildLoginAccountQuery innerJoinLoginSession($relationAlias = null) Adds a INNER JOIN clause to the query using the LoginSession relation
 *
 * @method     ChildLoginAccountQuery joinWithLoginSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LoginSession relation
 *
 * @method     ChildLoginAccountQuery leftJoinWithLoginSession() Adds a LEFT JOIN clause and with to the query using the LoginSession relation
 * @method     ChildLoginAccountQuery rightJoinWithLoginSession() Adds a RIGHT JOIN clause and with to the query using the LoginSession relation
 * @method     ChildLoginAccountQuery innerJoinWithLoginSession() Adds a INNER JOIN clause and with to the query using the LoginSession relation
 *
 * @method     \AUTH\Models\LoginProviderQuery|\AUTH\Models\LoginAccountPasswordQuery|\AUTH\Models\LoginSessionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginAccount|null findOne(?ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query
 * @method     ChildLoginAccount findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query, or a new ChildLoginAccount object populated from the query conditions when no match is found
 *
 * @method     ChildLoginAccount|null findOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccount filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccount|null findOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginAccount filtered by the ID_PROVIDER column
 * @method     ChildLoginAccount|null findOneById(string $IDENTIFIER) Return the first ChildLoginAccount filtered by the IDENTIFIER column
 * @method     ChildLoginAccount|null findOneByEmail(string $EMAIL) Return the first ChildLoginAccount filtered by the EMAIL column
 * @method     ChildLoginAccount|null findOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildLoginAccount filtered by the ACCESS_TOKEN column
 * @method     ChildLoginAccount|null findOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildLoginAccount filtered by the REFRESH_TOKEN column
 * @method     ChildLoginAccount|null findOneByExpireDate(string $EXPIRES) Return the first ChildLoginAccount filtered by the EXPIRES column
 * @method     ChildLoginAccount|null findOneByAccountRole(int $ROLE) Return the first ChildLoginAccount filtered by the ROLE column
 * @method     ChildLoginAccount|null findOneByActive(boolean $ACTIVE) Return the first ChildLoginAccount filtered by the ACTIVE column
 * @method     ChildLoginAccount|null findOneByVerified(boolean $VERIFIED) Return the first ChildLoginAccount filtered by the VERIFIED column
 * @method     ChildLoginAccount|null findOneByRefreshRequest(string $REFRESH_REQUESTED) Return the first ChildLoginAccount filtered by the REFRESH_REQUESTED column
 * @method     ChildLoginAccount|null findOneByResetToken(string $RESET_TOKEN) Return the first ChildLoginAccount filtered by the RESET_TOKEN column
 * @method     ChildLoginAccount|null findOneByCreatedAt(string $created_at) Return the first ChildLoginAccount filtered by the created_at column
 * @method     ChildLoginAccount|null findOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccount filtered by the updated_at column
 *
 * @method     ChildLoginAccount requirePk($key, ?ConnectionInterface $con = null) Return the ChildLoginAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOne(?ConnectionInterface $con = null) Return the first ChildLoginAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccount requireOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccount filtered by the ID_ACCOUNT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginAccount filtered by the ID_PROVIDER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneById(string $IDENTIFIER) Return the first ChildLoginAccount filtered by the IDENTIFIER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByEmail(string $EMAIL) Return the first ChildLoginAccount filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByAccessToken(string $ACCESS_TOKEN) Return the first ChildLoginAccount filtered by the ACCESS_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByRefreshToken(string $REFRESH_TOKEN) Return the first ChildLoginAccount filtered by the REFRESH_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByExpireDate(string $EXPIRES) Return the first ChildLoginAccount filtered by the EXPIRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByAccountRole(int $ROLE) Return the first ChildLoginAccount filtered by the ROLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByActive(boolean $ACTIVE) Return the first ChildLoginAccount filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByVerified(boolean $VERIFIED) Return the first ChildLoginAccount filtered by the VERIFIED column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByRefreshRequest(string $REFRESH_REQUESTED) Return the first ChildLoginAccount filtered by the REFRESH_REQUESTED column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByResetToken(string $RESET_TOKEN) Return the first ChildLoginAccount filtered by the RESET_TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByCreatedAt(string $created_at) Return the first ChildLoginAccount filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccount requireOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccount filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccount[]|Collection find(?ConnectionInterface $con = null) Return ChildLoginAccount objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLoginAccount> find(?ConnectionInterface $con = null) Return ChildLoginAccount objects based on current ModelCriteria
 *
 * @method     ChildLoginAccount[]|Collection findByIdAccount(int|array<int> $ID_ACCOUNT) Return ChildLoginAccount objects filtered by the ID_ACCOUNT column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByIdAccount(int|array<int> $ID_ACCOUNT) Return ChildLoginAccount objects filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccount[]|Collection findByIdSocial(int|array<int> $ID_PROVIDER) Return ChildLoginAccount objects filtered by the ID_PROVIDER column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByIdSocial(int|array<int> $ID_PROVIDER) Return ChildLoginAccount objects filtered by the ID_PROVIDER column
 * @method     ChildLoginAccount[]|Collection findById(string|array<string> $IDENTIFIER) Return ChildLoginAccount objects filtered by the IDENTIFIER column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findById(string|array<string> $IDENTIFIER) Return ChildLoginAccount objects filtered by the IDENTIFIER column
 * @method     ChildLoginAccount[]|Collection findByEmail(string|array<string> $EMAIL) Return ChildLoginAccount objects filtered by the EMAIL column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByEmail(string|array<string> $EMAIL) Return ChildLoginAccount objects filtered by the EMAIL column
 * @method     ChildLoginAccount[]|Collection findByAccessToken(string|array<string> $ACCESS_TOKEN) Return ChildLoginAccount objects filtered by the ACCESS_TOKEN column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByAccessToken(string|array<string> $ACCESS_TOKEN) Return ChildLoginAccount objects filtered by the ACCESS_TOKEN column
 * @method     ChildLoginAccount[]|Collection findByRefreshToken(string|array<string> $REFRESH_TOKEN) Return ChildLoginAccount objects filtered by the REFRESH_TOKEN column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByRefreshToken(string|array<string> $REFRESH_TOKEN) Return ChildLoginAccount objects filtered by the REFRESH_TOKEN column
 * @method     ChildLoginAccount[]|Collection findByExpireDate(string|array<string> $EXPIRES) Return ChildLoginAccount objects filtered by the EXPIRES column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByExpireDate(string|array<string> $EXPIRES) Return ChildLoginAccount objects filtered by the EXPIRES column
 * @method     ChildLoginAccount[]|Collection findByAccountRole(int|array<int> $ROLE) Return ChildLoginAccount objects filtered by the ROLE column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByAccountRole(int|array<int> $ROLE) Return ChildLoginAccount objects filtered by the ROLE column
 * @method     ChildLoginAccount[]|Collection findByActive(boolean|array<boolean> $ACTIVE) Return ChildLoginAccount objects filtered by the ACTIVE column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByActive(boolean|array<boolean> $ACTIVE) Return ChildLoginAccount objects filtered by the ACTIVE column
 * @method     ChildLoginAccount[]|Collection findByVerified(boolean|array<boolean> $VERIFIED) Return ChildLoginAccount objects filtered by the VERIFIED column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByVerified(boolean|array<boolean> $VERIFIED) Return ChildLoginAccount objects filtered by the VERIFIED column
 * @method     ChildLoginAccount[]|Collection findByRefreshRequest(string|array<string> $REFRESH_REQUESTED) Return ChildLoginAccount objects filtered by the REFRESH_REQUESTED column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByRefreshRequest(string|array<string> $REFRESH_REQUESTED) Return ChildLoginAccount objects filtered by the REFRESH_REQUESTED column
 * @method     ChildLoginAccount[]|Collection findByResetToken(string|array<string> $RESET_TOKEN) Return ChildLoginAccount objects filtered by the RESET_TOKEN column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByResetToken(string|array<string> $RESET_TOKEN) Return ChildLoginAccount objects filtered by the RESET_TOKEN column
 * @method     ChildLoginAccount[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLoginAccount objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByCreatedAt(string|array<string> $created_at) Return ChildLoginAccount objects filtered by the created_at column
 * @method     ChildLoginAccount[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLoginAccount objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLoginAccount> findByUpdatedAt(string|array<string> $updated_at) Return ChildLoginAccount objects filtered by the updated_at column
 *
 * @method     ChildLoginAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLoginAccount> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LoginAccountQuery extends ModelCriteria
{

    // query_cache behavior
    protected $queryKey = '';
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginAccountQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginAccountQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginAccountQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
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
    public function findPk($key, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoginAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_ACCOUNT, ID_PROVIDER, IDENTIFIER, EMAIL, ACCESS_TOKEN, REFRESH_TOKEN, EXPIRES, ROLE, ACTIVE, VERIFIED, REFRESH_REQUESTED, RESET_TOKEN, created_at, updated_at FROM AUTH_ACCOUNTS WHERE ID_ACCOUNT = :p0';
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
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
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $keys, Criteria::IN);

        return $this;
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
     * @param mixed $idAccount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAccount($idAccount = null, ?string $comparison = null)
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

        $this->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $idAccount, $comparison);

        return $this;
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
     * @param mixed $idSocial The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSocial($idSocial = null, ?string $comparison = null)
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

        $this->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $idSocial, $comparison);

        return $this;
    }

    /**
     * Filter the query on the IDENTIFIER column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE IDENTIFIER = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE IDENTIFIER LIKE '%fooValue%'
     * $query->filterById(['foo', 'bar']); // WHERE IDENTIFIER IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $id The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_IDENTIFIER, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE EMAIL LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE EMAIL IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ACCESS_TOKEN column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessToken('fooValue');   // WHERE ACCESS_TOKEN = 'fooValue'
     * $query->filterByAccessToken('%fooValue%', Criteria::LIKE); // WHERE ACCESS_TOKEN LIKE '%fooValue%'
     * $query->filterByAccessToken(['foo', 'bar']); // WHERE ACCESS_TOKEN IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $accessToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccessToken($accessToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accessToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_ACCESS_TOKEN, $accessToken, $comparison);

        return $this;
    }

    /**
     * Filter the query on the REFRESH_TOKEN column
     *
     * @param mixed $refreshToken The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefreshToken($refreshToken = null, ?string $comparison = null)
    {

        $this->addUsingAlias(LoginAccountTableMap::COL_REFRESH_TOKEN, $refreshToken, $comparison);

        return $this;
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
     * @param mixed $expireDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpireDate($expireDate = null, ?string $comparison = null)
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

        $this->addUsingAlias(LoginAccountTableMap::COL_EXPIRES, $expireDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ROLE column
     *
     * @param mixed $accountRole The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccountRole($accountRole = null, ?string $comparison = null)
    {
        $valueSet = LoginAccountTableMap::getValueSet(LoginAccountTableMap::COL_ROLE);
        if (is_scalar($accountRole)) {
            if (!in_array($accountRole, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $accountRole));
            }
            $accountRole = array_search($accountRole, $valueSet);
        } elseif (is_array($accountRole)) {
            $convertedValues = [];
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

        $this->addUsingAlias(LoginAccountTableMap::COL_ROLE, $accountRole, $comparison);

        return $this;
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
     * @param bool|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActive($active = null, ?string $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
    }

    /**
     * Filter the query on the VERIFIED column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(true); // WHERE VERIFIED = true
     * $query->filterByVerified('yes'); // WHERE VERIFIED = true
     * </code>
     *
     * @param bool|string $verified The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVerified($verified = null, ?string $comparison = null)
    {
        if (is_string($verified)) {
            $verified = in_array(strtolower($verified), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_VERIFIED, $verified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the REFRESH_REQUESTED column
     *
     * Example usage:
     * <code>
     * $query->filterByRefreshRequest('2011-03-14'); // WHERE REFRESH_REQUESTED = '2011-03-14'
     * $query->filterByRefreshRequest('now'); // WHERE REFRESH_REQUESTED = '2011-03-14'
     * $query->filterByRefreshRequest(array('max' => 'yesterday')); // WHERE REFRESH_REQUESTED > '2011-03-13'
     * </code>
     *
     * @param mixed $refreshRequest The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefreshRequest($refreshRequest = null, ?string $comparison = null)
    {
        if (is_array($refreshRequest)) {
            $useMinMax = false;
            if (isset($refreshRequest['min'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_REFRESH_REQUESTED, $refreshRequest['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($refreshRequest['max'])) {
                $this->addUsingAlias(LoginAccountTableMap::COL_REFRESH_REQUESTED, $refreshRequest['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_REFRESH_REQUESTED, $refreshRequest, $comparison);

        return $this;
    }

    /**
     * Filter the query on the RESET_TOKEN column
     *
     * Example usage:
     * <code>
     * $query->filterByResetToken('fooValue');   // WHERE RESET_TOKEN = 'fooValue'
     * $query->filterByResetToken('%fooValue%', Criteria::LIKE); // WHERE RESET_TOKEN LIKE '%fooValue%'
     * $query->filterByResetToken(['foo', 'bar']); // WHERE RESET_TOKEN IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $resetToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResetToken($resetToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resetToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginAccountTableMap::COL_RESET_TOKEN, $resetToken, $comparison);

        return $this;
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
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
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

        $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
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
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
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

        $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginProvider object
     *
     * @param \AUTH\Models\LoginProvider|ObjectCollection $loginProvider The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccountProvider($loginProvider, ?string $comparison = null)
    {
        if ($loginProvider instanceof \AUTH\Models\LoginProvider) {
            return $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $loginProvider->getIdProvider(), $comparison);
        } elseif ($loginProvider instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_PROVIDER, $loginProvider->toKeyValue('PrimaryKey', 'IdProvider'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAccountProvider() only accepts arguments of type \AUTH\Models\LoginProvider or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AccountProvider relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAccountProvider(?string $relationAlias = null, ?string $joinType = 'INNER JOIN')
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Use the AccountProvider relation LoginProvider object
     *
     * @param callable(\AUTH\Models\LoginProviderQuery):\AUTH\Models\LoginProviderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAccountProviderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = 'INNER JOIN'
    ) {
        $relatedQuery = $this->useAccountProviderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the AccountProvider relation to the LoginProvider table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the EXISTS statement
     */
    public function useAccountProviderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useExistsQuery('AccountProvider', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the AccountProvider relation to the LoginProvider table for a NOT EXISTS query.
     *
     * @see useAccountProviderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the NOT EXISTS statement
     */
    public function useAccountProviderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useExistsQuery('AccountProvider', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the AccountProvider relation to the LoginProvider table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the IN statement
     */
    public function useInAccountProviderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useInQuery('AccountProvider', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the AccountProvider relation to the LoginProvider table for a NOT IN query.
     *
     * @see useAccountProviderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the NOT IN statement
     */
    public function useNotInAccountProviderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useInQuery('AccountProvider', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginAccountPassword object
     *
     * @param \AUTH\Models\LoginAccountPassword|ObjectCollection $loginAccountPassword the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLoginAccountPassword($loginAccountPassword, ?string $comparison = null)
    {
        if ($loginAccountPassword instanceof \AUTH\Models\LoginAccountPassword) {
            $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $loginAccountPassword->getIdAccount(), $comparison);

            return $this;
        } elseif ($loginAccountPassword instanceof ObjectCollection) {
            $this
                ->useLoginAccountPasswordQuery()
                ->filterByPrimaryKeys($loginAccountPassword->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLoginAccountPassword() only accepts arguments of type \AUTH\Models\LoginAccountPassword or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LoginAccountPassword relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLoginAccountPassword(?string $relationAlias = null, ?string $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LoginAccountPassword');

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
            $this->addJoinObject($join, 'LoginAccountPassword');
        }

        return $this;
    }

    /**
     * Use the LoginAccountPassword relation LoginAccountPassword object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginAccountPasswordQuery A secondary query class using the current class as primary query
     */
    public function useLoginAccountPasswordQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinLoginAccountPassword($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LoginAccountPassword', '\AUTH\Models\LoginAccountPasswordQuery');
    }

    /**
     * Use the LoginAccountPassword relation LoginAccountPassword object
     *
     * @param callable(\AUTH\Models\LoginAccountPasswordQuery):\AUTH\Models\LoginAccountPasswordQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLoginAccountPasswordQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = 'INNER JOIN'
    ) {
        $relatedQuery = $this->useLoginAccountPasswordQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to LoginAccountPassword table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \AUTH\Models\LoginAccountPasswordQuery The inner query object of the EXISTS statement
     */
    public function useLoginAccountPasswordExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \AUTH\Models\LoginAccountPasswordQuery */
        $q = $this->useExistsQuery('LoginAccountPassword', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to LoginAccountPassword table for a NOT EXISTS query.
     *
     * @see useLoginAccountPasswordExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginAccountPasswordQuery The inner query object of the NOT EXISTS statement
     */
    public function useLoginAccountPasswordNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginAccountPasswordQuery */
        $q = $this->useExistsQuery('LoginAccountPassword', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to LoginAccountPassword table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \AUTH\Models\LoginAccountPasswordQuery The inner query object of the IN statement
     */
    public function useInLoginAccountPasswordQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \AUTH\Models\LoginAccountPasswordQuery */
        $q = $this->useInQuery('LoginAccountPassword', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to LoginAccountPassword table for a NOT IN query.
     *
     * @see useLoginAccountPasswordInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginAccountPasswordQuery The inner query object of the NOT IN statement
     */
    public function useNotInLoginAccountPasswordQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginAccountPasswordQuery */
        $q = $this->useInQuery('LoginAccountPassword', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginSession object
     *
     * @param \AUTH\Models\LoginSession|ObjectCollection $loginSession the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLoginSession($loginSession, ?string $comparison = null)
    {
        if ($loginSession instanceof \AUTH\Models\LoginSession) {
            $this
                ->addUsingAlias(LoginAccountTableMap::COL_ID_ACCOUNT, $loginSession->getIdAccount(), $comparison);

            return $this;
        } elseif ($loginSession instanceof ObjectCollection) {
            $this
                ->useLoginSessionQuery()
                ->filterByPrimaryKeys($loginSession->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLoginSession() only accepts arguments of type \AUTH\Models\LoginSession or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LoginSession relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLoginSession(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LoginSession');

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
            $this->addJoinObject($join, 'LoginSession');
        }

        return $this;
    }

    /**
     * Use the LoginSession relation LoginSession object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginSessionQuery A secondary query class using the current class as primary query
     */
    public function useLoginSessionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLoginSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LoginSession', '\AUTH\Models\LoginSessionQuery');
    }

    /**
     * Use the LoginSession relation LoginSession object
     *
     * @param callable(\AUTH\Models\LoginSessionQuery):\AUTH\Models\LoginSessionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLoginSessionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLoginSessionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to LoginSession table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \AUTH\Models\LoginSessionQuery The inner query object of the EXISTS statement
     */
    public function useLoginSessionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \AUTH\Models\LoginSessionQuery */
        $q = $this->useExistsQuery('LoginSession', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to LoginSession table for a NOT EXISTS query.
     *
     * @see useLoginSessionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginSessionQuery The inner query object of the NOT EXISTS statement
     */
    public function useLoginSessionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginSessionQuery */
        $q = $this->useExistsQuery('LoginSession', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to LoginSession table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \AUTH\Models\LoginSessionQuery The inner query object of the IN statement
     */
    public function useInLoginSessionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \AUTH\Models\LoginSessionQuery */
        $q = $this->useInQuery('LoginSession', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to LoginSession table for a NOT IN query.
     *
     * @see useLoginSessionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginSessionQuery The inner query object of the NOT IN statement
     */
    public function useNotInLoginSessionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginSessionQuery */
        $q = $this->useInQuery('LoginSession', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLoginAccount $loginAccount Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
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
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePreDelete(ConnectionInterface $con): ?int
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->findRelatedAccountProviderAccountss($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param int $affectedRows the number of deleted rows
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePostDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->updateRelatedAccountProviderAccountss($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param array $values The associative array of columns and values for the update
     * @param ConnectionInterface $con The connection object used by the query
     * @param bool $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     *
     * @return int|null
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false): ?int
    {
        // aggregate_column_relation_aggregate_column behavior
        $this->findRelatedAccountProviderAccountss($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param int $affectedRows the number of updated rows
     * @param ConnectionInterface $con The connection object used by the query
     *
     * @return int|null
     */
    protected function basePostUpdate($affectedRows, ConnectionInterface $con): ?int
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
    public function doDeleteAll(?ConnectionInterface $con = null): int
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
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
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

    public function doSelect(?ConnectionInterface $con = null): \Propel\Runtime\DataFetcher\DataFetcherInterface
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
            $params = [];
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

    public function doCount(?ConnectionInterface $con = null): \Propel\Runtime\DataFetcher\DataFetcherInterface
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

            $params = [];
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
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(LoginAccountTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(LoginAccountTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(LoginAccountTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(LoginAccountTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(LoginAccountTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(LoginAccountTableMap::COL_CREATED_AT);

        return $this;
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
        $this->accountProviderAccountss = [];
    }

}
