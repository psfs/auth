<?php

namespace AUTH\Models\Base;

use \Exception;
use \PDO;
use AUTH\Models\LoginAccountPassword as ChildLoginAccountPassword;
use AUTH\Models\LoginAccountPasswordQuery as ChildLoginAccountPasswordQuery;
use AUTH\Models\Map\LoginAccountPasswordTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'AUTH_ACCOUNT_PASSWORDS' table.
 *
 * Table with an history for account passwords
 *
 * @method     ChildLoginAccountPasswordQuery orderByIdPassword($order = Criteria::ASC) Order by the ID_PASSWORD column
 * @method     ChildLoginAccountPasswordQuery orderByIdAccount($order = Criteria::ASC) Order by the ID_ACCOUNT column
 * @method     ChildLoginAccountPasswordQuery orderByValue($order = Criteria::ASC) Order by the VALUE column
 * @method     ChildLoginAccountPasswordQuery orderByExpirationDate($order = Criteria::ASC) Order by the EXPIRATION_DATE column
 * @method     ChildLoginAccountPasswordQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLoginAccountPasswordQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLoginAccountPasswordQuery groupByIdPassword() Group by the ID_PASSWORD column
 * @method     ChildLoginAccountPasswordQuery groupByIdAccount() Group by the ID_ACCOUNT column
 * @method     ChildLoginAccountPasswordQuery groupByValue() Group by the VALUE column
 * @method     ChildLoginAccountPasswordQuery groupByExpirationDate() Group by the EXPIRATION_DATE column
 * @method     ChildLoginAccountPasswordQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLoginAccountPasswordQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLoginAccountPasswordQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginAccountPasswordQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginAccountPasswordQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginAccountPasswordQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoginAccountPasswordQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoginAccountPasswordQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoginAccountPasswordQuery leftJoinAccountPasswords($relationAlias = null) Adds a LEFT JOIN clause to the query using the AccountPasswords relation
 * @method     ChildLoginAccountPasswordQuery rightJoinAccountPasswords($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AccountPasswords relation
 * @method     ChildLoginAccountPasswordQuery innerJoinAccountPasswords($relationAlias = null) Adds a INNER JOIN clause to the query using the AccountPasswords relation
 *
 * @method     ChildLoginAccountPasswordQuery joinWithAccountPasswords($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AccountPasswords relation
 *
 * @method     ChildLoginAccountPasswordQuery leftJoinWithAccountPasswords() Adds a LEFT JOIN clause and with to the query using the AccountPasswords relation
 * @method     ChildLoginAccountPasswordQuery rightJoinWithAccountPasswords() Adds a RIGHT JOIN clause and with to the query using the AccountPasswords relation
 * @method     ChildLoginAccountPasswordQuery innerJoinWithAccountPasswords() Adds a INNER JOIN clause and with to the query using the AccountPasswords relation
 *
 * @method     \AUTH\Models\LoginAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginAccountPassword|null findOne(ConnectionInterface $con = null) Return the first ChildLoginAccountPassword matching the query
 * @method     ChildLoginAccountPassword findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoginAccountPassword matching the query, or a new ChildLoginAccountPassword object populated from the query conditions when no match is found
 *
 * @method     ChildLoginAccountPassword|null findOneByIdPassword(int $ID_PASSWORD) Return the first ChildLoginAccountPassword filtered by the ID_PASSWORD column
 * @method     ChildLoginAccountPassword|null findOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccountPassword filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccountPassword|null findOneByValue(string $VALUE) Return the first ChildLoginAccountPassword filtered by the VALUE column
 * @method     ChildLoginAccountPassword|null findOneByExpirationDate(string $EXPIRATION_DATE) Return the first ChildLoginAccountPassword filtered by the EXPIRATION_DATE column
 * @method     ChildLoginAccountPassword|null findOneByCreatedAt(string $created_at) Return the first ChildLoginAccountPassword filtered by the created_at column
 * @method     ChildLoginAccountPassword|null findOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccountPassword filtered by the updated_at column *

 * @method     ChildLoginAccountPassword requirePk($key, ConnectionInterface $con = null) Return the ChildLoginAccountPassword by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOne(ConnectionInterface $con = null) Return the first ChildLoginAccountPassword matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccountPassword requireOneByIdPassword(int $ID_PASSWORD) Return the first ChildLoginAccountPassword filtered by the ID_PASSWORD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOneByIdAccount(int $ID_ACCOUNT) Return the first ChildLoginAccountPassword filtered by the ID_ACCOUNT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOneByValue(string $VALUE) Return the first ChildLoginAccountPassword filtered by the VALUE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOneByExpirationDate(string $EXPIRATION_DATE) Return the first ChildLoginAccountPassword filtered by the EXPIRATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOneByCreatedAt(string $created_at) Return the first ChildLoginAccountPassword filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAccountPassword requireOneByUpdatedAt(string $updated_at) Return the first ChildLoginAccountPassword filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAccountPassword[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoginAccountPassword objects based on current ModelCriteria
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByIdPassword(int $ID_PASSWORD) Return ChildLoginAccountPassword objects filtered by the ID_PASSWORD column
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByIdAccount(int $ID_ACCOUNT) Return ChildLoginAccountPassword objects filtered by the ID_ACCOUNT column
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByValue(string $VALUE) Return ChildLoginAccountPassword objects filtered by the VALUE column
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByExpirationDate(string $EXPIRATION_DATE) Return ChildLoginAccountPassword objects filtered by the EXPIRATION_DATE column
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildLoginAccountPassword objects filtered by the created_at column
 * @method     ChildLoginAccountPassword[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildLoginAccountPassword objects filtered by the updated_at column
 * @method     ChildLoginAccountPassword[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoginAccountPasswordQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginAccountPasswordQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginAccountPassword', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginAccountPasswordQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginAccountPasswordQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoginAccountPasswordQuery) {
            return $criteria;
        }
        $query = new ChildLoginAccountPasswordQuery();
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
     * @return ChildLoginAccountPassword|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginAccountPasswordTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoginAccountPasswordTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoginAccountPassword A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_PASSWORD, ID_ACCOUNT, VALUE, EXPIRATION_DATE, created_at, updated_at FROM AUTH_ACCOUNT_PASSWORDS WHERE ID_PASSWORD = :p0';
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
            /** @var ChildLoginAccountPassword $obj */
            $obj = new ChildLoginAccountPassword();
            $obj->hydrate($row);
            LoginAccountPasswordTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoginAccountPassword|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID_PASSWORD column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPassword(1234); // WHERE ID_PASSWORD = 1234
     * $query->filterByIdPassword(array(12, 34)); // WHERE ID_PASSWORD IN (12, 34)
     * $query->filterByIdPassword(array('min' => 12)); // WHERE ID_PASSWORD > 12
     * </code>
     *
     * @param     mixed $idPassword The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByIdPassword($idPassword = null, $comparison = null)
    {
        if (is_array($idPassword)) {
            $useMinMax = false;
            if (isset($idPassword['min'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $idPassword['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPassword['max'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $idPassword['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $idPassword, $comparison);
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
     * @see       filterByAccountPasswords()
     *
     * @param     mixed $idAccount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByIdAccount($idAccount = null, $comparison = null)
    {
        if (is_array($idAccount)) {
            $useMinMax = false;
            if (isset($idAccount['min'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_ACCOUNT, $idAccount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAccount['max'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_ACCOUNT, $idAccount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_ACCOUNT, $idAccount, $comparison);
    }

    /**
     * Filter the query on the VALUE column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE VALUE = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE VALUE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the EXPIRATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationDate('2011-03-14'); // WHERE EXPIRATION_DATE = '2011-03-14'
     * $query->filterByExpirationDate('now'); // WHERE EXPIRATION_DATE = '2011-03-14'
     * $query->filterByExpirationDate(array('max' => 'yesterday')); // WHERE EXPIRATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $expirationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByExpirationDate($expirationDate = null, $comparison = null)
    {
        if (is_array($expirationDate)) {
            $useMinMax = false;
            if (isset($expirationDate['min'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_EXPIRATION_DATE, $expirationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationDate['max'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_EXPIRATION_DATE, $expirationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_EXPIRATION_DATE, $expirationDate, $comparison);
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
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LoginAccountPasswordTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \AUTH\Models\LoginAccount object
     *
     * @param \AUTH\Models\LoginAccount|ObjectCollection $loginAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function filterByAccountPasswords($loginAccount, $comparison = null)
    {
        if ($loginAccount instanceof \AUTH\Models\LoginAccount) {
            return $this
                ->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_ACCOUNT, $loginAccount->getIdAccount(), $comparison);
        } elseif ($loginAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_ACCOUNT, $loginAccount->toKeyValue('PrimaryKey', 'IdAccount'), $comparison);
        } else {
            throw new PropelException('filterByAccountPasswords() only accepts arguments of type \AUTH\Models\LoginAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AccountPasswords relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function joinAccountPasswords($relationAlias = null, $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AccountPasswords');

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
            $this->addJoinObject($join, 'AccountPasswords');
        }

        return $this;
    }

    /**
     * Use the AccountPasswords relation LoginAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginAccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountPasswordsQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinAccountPasswords($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AccountPasswords', '\AUTH\Models\LoginAccountQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoginAccountPassword $loginAccountPassword Object to remove from the list of results
     *
     * @return $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function prune($loginAccountPassword = null)
    {
        if ($loginAccountPassword) {
            $this->addUsingAlias(LoginAccountPasswordTableMap::COL_ID_PASSWORD, $loginAccountPassword->getIdPassword(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the AUTH_ACCOUNT_PASSWORDS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountPasswordTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginAccountPasswordTableMap::clearInstancePool();
            LoginAccountPasswordTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAccountPasswordTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginAccountPasswordTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginAccountPasswordTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginAccountPasswordTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginAccountPasswordTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginAccountPasswordTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(LoginAccountPasswordTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(LoginAccountPasswordTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildLoginAccountPasswordQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(LoginAccountPasswordTableMap::COL_CREATED_AT);
    }

} // LoginAccountPasswordQuery
