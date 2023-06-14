<?php

namespace AUTH\Models\Base;

use \Exception;
use \PDO;
use AUTH\Models\LoginSession as ChildLoginSession;
use AUTH\Models\LoginSessionQuery as ChildLoginSessionQuery;
use AUTH\Models\Map\LoginSessionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `AUTH_SESSIONS` table.
 *
 * Table with the login session token
 *
 * @method     ChildLoginSessionQuery orderByIdAccount($order = Criteria::ASC) Order by the ID_ACCOUNT column
 * @method     ChildLoginSessionQuery orderByDevice($order = Criteria::ASC) Order by the DEVICE column
 * @method     ChildLoginSessionQuery orderByIP($order = Criteria::ASC) Order by the IP column
 * @method     ChildLoginSessionQuery orderByToken($order = Criteria::ASC) Order by the TOKEN column
 * @method     ChildLoginSessionQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildLoginSessionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLoginSessionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLoginSessionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLoginSessionQuery groupByIdAccount() Group by the ID_ACCOUNT column
 * @method     ChildLoginSessionQuery groupByDevice() Group by the DEVICE column
 * @method     ChildLoginSessionQuery groupByIP() Group by the IP column
 * @method     ChildLoginSessionQuery groupByToken() Group by the TOKEN column
 * @method     ChildLoginSessionQuery groupByActive() Group by the ACTIVE column
 * @method     ChildLoginSessionQuery groupById() Group by the id column
 * @method     ChildLoginSessionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLoginSessionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLoginSessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginSessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginSessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginSessionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoginSessionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoginSessionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoginSessionQuery leftJoinAccountSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the AccountSession relation
 * @method     ChildLoginSessionQuery rightJoinAccountSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AccountSession relation
 * @method     ChildLoginSessionQuery innerJoinAccountSession($relationAlias = null) Adds a INNER JOIN clause to the query using the AccountSession relation
 *
 * @method     ChildLoginSessionQuery joinWithAccountSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AccountSession relation
 *
 * @method     ChildLoginSessionQuery leftJoinWithAccountSession() Adds a LEFT JOIN clause and with to the query using the AccountSession relation
 * @method     ChildLoginSessionQuery rightJoinWithAccountSession() Adds a RIGHT JOIN clause and with to the query using the AccountSession relation
 * @method     ChildLoginSessionQuery innerJoinWithAccountSession() Adds a INNER JOIN clause and with to the query using the AccountSession relation
 *
 * @method     \AUTH\Models\LoginAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginSession|null findOne(?ConnectionInterface $con = null) Return the first ChildLoginSession matching the query
 * @method     ChildLoginSession findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLoginSession matching the query, or a new ChildLoginSession object populated from the query conditions when no match is found
 *
 * @method     ChildLoginSession|null findOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginSession filtered by the ID_ACCOUNT column
 * @method     ChildLoginSession|null findOneByDevice(string $DEVICE) Return the first ChildLoginSession filtered by the DEVICE column
 * @method     ChildLoginSession|null findOneByIP(string $IP) Return the first ChildLoginSession filtered by the IP column
 * @method     ChildLoginSession|null findOneByToken(string $TOKEN) Return the first ChildLoginSession filtered by the TOKEN column
 * @method     ChildLoginSession|null findOneByActive(boolean $ACTIVE) Return the first ChildLoginSession filtered by the ACTIVE column
 * @method     ChildLoginSession|null findOneById(int $id) Return the first ChildLoginSession filtered by the id column
 * @method     ChildLoginSession|null findOneByCreatedAt(string $created_at) Return the first ChildLoginSession filtered by the created_at column
 * @method     ChildLoginSession|null findOneByUpdatedAt(string $updated_at) Return the first ChildLoginSession filtered by the updated_at column
 *
 * @method     ChildLoginSession requirePk($key, ?ConnectionInterface $con = null) Return the ChildLoginSession by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOne(?ConnectionInterface $con = null) Return the first ChildLoginSession matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginSession requireOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginSession filtered by the ID_ACCOUNT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByDevice(string $DEVICE) Return the first ChildLoginSession filtered by the DEVICE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByIP(string $IP) Return the first ChildLoginSession filtered by the IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByToken(string $TOKEN) Return the first ChildLoginSession filtered by the TOKEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByActive(boolean $ACTIVE) Return the first ChildLoginSession filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneById(int $id) Return the first ChildLoginSession filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByCreatedAt(string $created_at) Return the first ChildLoginSession filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginSession requireOneByUpdatedAt(string $updated_at) Return the first ChildLoginSession filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginSession[]|Collection find(?ConnectionInterface $con = null) Return ChildLoginSession objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLoginSession> find(?ConnectionInterface $con = null) Return ChildLoginSession objects based on current ModelCriteria
 *
 * @method     ChildLoginSession[]|Collection findByIdAccount(int|array<int> $ID_ACCOUNT) Return ChildLoginSession objects filtered by the ID_ACCOUNT column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByIdAccount(int|array<int> $ID_ACCOUNT) Return ChildLoginSession objects filtered by the ID_ACCOUNT column
 * @method     ChildLoginSession[]|Collection findByDevice(string|array<string> $DEVICE) Return ChildLoginSession objects filtered by the DEVICE column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByDevice(string|array<string> $DEVICE) Return ChildLoginSession objects filtered by the DEVICE column
 * @method     ChildLoginSession[]|Collection findByIP(string|array<string> $IP) Return ChildLoginSession objects filtered by the IP column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByIP(string|array<string> $IP) Return ChildLoginSession objects filtered by the IP column
 * @method     ChildLoginSession[]|Collection findByToken(string|array<string> $TOKEN) Return ChildLoginSession objects filtered by the TOKEN column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByToken(string|array<string> $TOKEN) Return ChildLoginSession objects filtered by the TOKEN column
 * @method     ChildLoginSession[]|Collection findByActive(boolean|array<boolean> $ACTIVE) Return ChildLoginSession objects filtered by the ACTIVE column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByActive(boolean|array<boolean> $ACTIVE) Return ChildLoginSession objects filtered by the ACTIVE column
 * @method     ChildLoginSession[]|Collection findById(int|array<int> $id) Return ChildLoginSession objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findById(int|array<int> $id) Return ChildLoginSession objects filtered by the id column
 * @method     ChildLoginSession[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLoginSession objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByCreatedAt(string|array<string> $created_at) Return ChildLoginSession objects filtered by the created_at column
 * @method     ChildLoginSession[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLoginSession objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLoginSession> findByUpdatedAt(string|array<string> $updated_at) Return ChildLoginSession objects filtered by the updated_at column
 *
 * @method     ChildLoginSession[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLoginSession> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LoginSessionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginSessionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginSession', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginSessionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginSessionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLoginSessionQuery) {
            return $criteria;
        }
        $query = new ChildLoginSessionQuery();
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
     * @return ChildLoginSession|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginSessionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoginSessionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoginSession A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_ACCOUNT, DEVICE, IP, TOKEN, ACTIVE, id, created_at, updated_at FROM AUTH_SESSIONS WHERE id = :p0';
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
            /** @var ChildLoginSession $obj */
            $obj = new ChildLoginSession();
            $obj->hydrate($row);
            LoginSessionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoginSession|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LoginSessionTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LoginSessionTableMap::COL_ID, $keys, Criteria::IN);

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
     * @see       filterByAccountSession()
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
                $this->addUsingAlias(LoginSessionTableMap::COL_ID_ACCOUNT, $idAccount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAccount['max'])) {
                $this->addUsingAlias(LoginSessionTableMap::COL_ID_ACCOUNT, $idAccount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_ID_ACCOUNT, $idAccount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the DEVICE column
     *
     * Example usage:
     * <code>
     * $query->filterByDevice('fooValue');   // WHERE DEVICE = 'fooValue'
     * $query->filterByDevice('%fooValue%', Criteria::LIKE); // WHERE DEVICE LIKE '%fooValue%'
     * $query->filterByDevice(['foo', 'bar']); // WHERE DEVICE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $device The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDevice($device = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($device)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_DEVICE, $device, $comparison);

        return $this;
    }

    /**
     * Filter the query on the IP column
     *
     * Example usage:
     * <code>
     * $query->filterByIP('fooValue');   // WHERE IP = 'fooValue'
     * $query->filterByIP('%fooValue%', Criteria::LIKE); // WHERE IP LIKE '%fooValue%'
     * $query->filterByIP(['foo', 'bar']); // WHERE IP IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $iP The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIP($iP = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iP)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_IP, $iP, $comparison);

        return $this;
    }

    /**
     * Filter the query on the TOKEN column
     *
     * @param mixed $token The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToken($token = null, ?string $comparison = null)
    {

        $this->addUsingAlias(LoginSessionTableMap::COL_TOKEN, $token, $comparison);

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

        $this->addUsingAlias(LoginSessionTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LoginSessionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LoginSessionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(LoginSessionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LoginSessionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LoginSessionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LoginSessionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginSessionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginAccount object
     *
     * @param \AUTH\Models\LoginAccount|ObjectCollection $loginAccount The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccountSession($loginAccount, ?string $comparison = null)
    {
        if ($loginAccount instanceof \AUTH\Models\LoginAccount) {
            return $this
                ->addUsingAlias(LoginSessionTableMap::COL_ID_ACCOUNT, $loginAccount->getIdAccount(), $comparison);
        } elseif ($loginAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LoginSessionTableMap::COL_ID_ACCOUNT, $loginAccount->toKeyValue('PrimaryKey', 'IdAccount'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAccountSession() only accepts arguments of type \AUTH\Models\LoginAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AccountSession relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAccountSession(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AccountSession');

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
            $this->addJoinObject($join, 'AccountSession');
        }

        return $this;
    }

    /**
     * Use the AccountSession relation LoginAccount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginAccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountSessionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccountSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AccountSession', '\AUTH\Models\LoginAccountQuery');
    }

    /**
     * Use the AccountSession relation LoginAccount object
     *
     * @param callable(\AUTH\Models\LoginAccountQuery):\AUTH\Models\LoginAccountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAccountSessionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAccountSessionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the AccountSession relation to the LoginAccount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \AUTH\Models\LoginAccountQuery The inner query object of the EXISTS statement
     */
    public function useAccountSessionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \AUTH\Models\LoginAccountQuery */
        $q = $this->useExistsQuery('AccountSession', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the AccountSession relation to the LoginAccount table for a NOT EXISTS query.
     *
     * @see useAccountSessionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginAccountQuery The inner query object of the NOT EXISTS statement
     */
    public function useAccountSessionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginAccountQuery */
        $q = $this->useExistsQuery('AccountSession', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the AccountSession relation to the LoginAccount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \AUTH\Models\LoginAccountQuery The inner query object of the IN statement
     */
    public function useInAccountSessionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \AUTH\Models\LoginAccountQuery */
        $q = $this->useInQuery('AccountSession', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the AccountSession relation to the LoginAccount table for a NOT IN query.
     *
     * @see useAccountSessionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginAccountQuery The inner query object of the NOT IN statement
     */
    public function useNotInAccountSessionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginAccountQuery */
        $q = $this->useInQuery('AccountSession', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLoginSession $loginSession Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($loginSession = null)
    {
        if ($loginSession) {
            $this->addUsingAlias(LoginSessionTableMap::COL_ID, $loginSession->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the AUTH_SESSIONS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginSessionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginSessionTableMap::clearInstancePool();
            LoginSessionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginSessionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginSessionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginSessionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginSessionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
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
        $this->addUsingAlias(LoginSessionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(LoginSessionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(LoginSessionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(LoginSessionTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(LoginSessionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(LoginSessionTableMap::COL_CREATED_AT);

        return $this;
    }

}
