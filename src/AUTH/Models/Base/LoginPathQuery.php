<?php

namespace AUTH\Models\Base;

use \Exception;
use \PDO;
use AUTH\Models\LoginPath as ChildLoginPath;
use AUTH\Models\LoginPathQuery as ChildLoginPathQuery;
use AUTH\Models\Map\LoginPathTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `AUTH_PATHS` table.
 *
 * Customer provider paths to redirect
 *
 * @method     ChildLoginPathQuery orderByIdPath($order = Criteria::ASC) Order by the ID_PATH column
 * @method     ChildLoginPathQuery orderByIdSocial($order = Criteria::ASC) Order by the ID_PROVIDER column
 * @method     ChildLoginPathQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildLoginPathQuery orderByPath($order = Criteria::ASC) Order by the PATH column
 *
 * @method     ChildLoginPathQuery groupByIdPath() Group by the ID_PATH column
 * @method     ChildLoginPathQuery groupByIdSocial() Group by the ID_PROVIDER column
 * @method     ChildLoginPathQuery groupByType() Group by the TYPE column
 * @method     ChildLoginPathQuery groupByPath() Group by the PATH column
 *
 * @method     ChildLoginPathQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginPathQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginPathQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginPathQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoginPathQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoginPathQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoginPathQuery leftJoinProviderPath($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProviderPath relation
 * @method     ChildLoginPathQuery rightJoinProviderPath($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProviderPath relation
 * @method     ChildLoginPathQuery innerJoinProviderPath($relationAlias = null) Adds a INNER JOIN clause to the query using the ProviderPath relation
 *
 * @method     ChildLoginPathQuery joinWithProviderPath($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProviderPath relation
 *
 * @method     ChildLoginPathQuery leftJoinWithProviderPath() Adds a LEFT JOIN clause and with to the query using the ProviderPath relation
 * @method     ChildLoginPathQuery rightJoinWithProviderPath() Adds a RIGHT JOIN clause and with to the query using the ProviderPath relation
 * @method     ChildLoginPathQuery innerJoinWithProviderPath() Adds a INNER JOIN clause and with to the query using the ProviderPath relation
 *
 * @method     \AUTH\Models\LoginProviderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginPath|null findOne(?ConnectionInterface $con = null) Return the first ChildLoginPath matching the query
 * @method     ChildLoginPath findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLoginPath matching the query, or a new ChildLoginPath object populated from the query conditions when no match is found
 *
 * @method     ChildLoginPath|null findOneByIdPath(int $ID_PATH) Return the first ChildLoginPath filtered by the ID_PATH column
 * @method     ChildLoginPath|null findOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginPath filtered by the ID_PROVIDER column
 * @method     ChildLoginPath|null findOneByType(int $TYPE) Return the first ChildLoginPath filtered by the TYPE column
 * @method     ChildLoginPath|null findOneByPath(string $PATH) Return the first ChildLoginPath filtered by the PATH column
 *
 * @method     ChildLoginPath requirePk($key, ?ConnectionInterface $con = null) Return the ChildLoginPath by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginPath requireOne(?ConnectionInterface $con = null) Return the first ChildLoginPath matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginPath requireOneByIdPath(int $ID_PATH) Return the first ChildLoginPath filtered by the ID_PATH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginPath requireOneByIdSocial(int $ID_PROVIDER) Return the first ChildLoginPath filtered by the ID_PROVIDER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginPath requireOneByType(int $TYPE) Return the first ChildLoginPath filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginPath requireOneByPath(string $PATH) Return the first ChildLoginPath filtered by the PATH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginPath[]|Collection find(?ConnectionInterface $con = null) Return ChildLoginPath objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLoginPath> find(?ConnectionInterface $con = null) Return ChildLoginPath objects based on current ModelCriteria
 *
 * @method     ChildLoginPath[]|Collection findByIdPath(int|array<int> $ID_PATH) Return ChildLoginPath objects filtered by the ID_PATH column
 * @psalm-method Collection&\Traversable<ChildLoginPath> findByIdPath(int|array<int> $ID_PATH) Return ChildLoginPath objects filtered by the ID_PATH column
 * @method     ChildLoginPath[]|Collection findByIdSocial(int|array<int> $ID_PROVIDER) Return ChildLoginPath objects filtered by the ID_PROVIDER column
 * @psalm-method Collection&\Traversable<ChildLoginPath> findByIdSocial(int|array<int> $ID_PROVIDER) Return ChildLoginPath objects filtered by the ID_PROVIDER column
 * @method     ChildLoginPath[]|Collection findByType(int|array<int> $TYPE) Return ChildLoginPath objects filtered by the TYPE column
 * @psalm-method Collection&\Traversable<ChildLoginPath> findByType(int|array<int> $TYPE) Return ChildLoginPath objects filtered by the TYPE column
 * @method     ChildLoginPath[]|Collection findByPath(string|array<string> $PATH) Return ChildLoginPath objects filtered by the PATH column
 * @psalm-method Collection&\Traversable<ChildLoginPath> findByPath(string|array<string> $PATH) Return ChildLoginPath objects filtered by the PATH column
 *
 * @method     ChildLoginPath[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLoginPath> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LoginPathQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AUTH\Models\Base\LoginPathQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'AUTH', $modelName = '\\AUTH\\Models\\LoginPath', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginPathQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginPathQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLoginPathQuery) {
            return $criteria;
        }
        $query = new ChildLoginPathQuery();
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
     * @return ChildLoginPath|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginPathTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoginPathTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoginPath A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_PATH, ID_PROVIDER, TYPE, PATH FROM AUTH_PATHS WHERE ID_PATH = :p0';
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
            /** @var ChildLoginPath $obj */
            $obj = new ChildLoginPath();
            $obj->hydrate($row);
            LoginPathTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoginPath|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ID_PATH column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPath(1234); // WHERE ID_PATH = 1234
     * $query->filterByIdPath(array(12, 34)); // WHERE ID_PATH IN (12, 34)
     * $query->filterByIdPath(array('min' => 12)); // WHERE ID_PATH > 12
     * </code>
     *
     * @param mixed $idPath The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdPath($idPath = null, ?string $comparison = null)
    {
        if (is_array($idPath)) {
            $useMinMax = false;
            if (isset($idPath['min'])) {
                $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $idPath['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPath['max'])) {
                $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $idPath['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $idPath, $comparison);

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
     * @see       filterByProviderPath()
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
                $this->addUsingAlias(LoginPathTableMap::COL_ID_PROVIDER, $idSocial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSocial['max'])) {
                $this->addUsingAlias(LoginPathTableMap::COL_ID_PROVIDER, $idSocial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginPathTableMap::COL_ID_PROVIDER, $idSocial, $comparison);

        return $this;
    }

    /**
     * Filter the query on the TYPE column
     *
     * @param mixed $type The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType($type = null, ?string $comparison = null)
    {
        $valueSet = LoginPathTableMap::getValueSet(LoginPathTableMap::COL_TYPE);
        if (is_scalar($type)) {
            if (!in_array($type, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $type));
            }
            $type = array_search($type, $valueSet);
        } elseif (is_array($type)) {
            $convertedValues = [];
            foreach ($type as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginPathTableMap::COL_TYPE, $type, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PATH column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE PATH = 'fooValue'
     * $query->filterByPath('%fooValue%', Criteria::LIKE); // WHERE PATH LIKE '%fooValue%'
     * $query->filterByPath(['foo', 'bar']); // WHERE PATH IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $path The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPath($path = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($path)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LoginPathTableMap::COL_PATH, $path, $comparison);

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
    public function filterByProviderPath($loginProvider, ?string $comparison = null)
    {
        if ($loginProvider instanceof \AUTH\Models\LoginProvider) {
            return $this
                ->addUsingAlias(LoginPathTableMap::COL_ID_PROVIDER, $loginProvider->getIdProvider(), $comparison);
        } elseif ($loginProvider instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LoginPathTableMap::COL_ID_PROVIDER, $loginProvider->toKeyValue('PrimaryKey', 'IdProvider'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProviderPath() only accepts arguments of type \AUTH\Models\LoginProvider or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProviderPath relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProviderPath(?string $relationAlias = null, ?string $joinType = 'INNER JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProviderPath');

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
            $this->addJoinObject($join, 'ProviderPath');
        }

        return $this;
    }

    /**
     * Use the ProviderPath relation LoginProvider object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AUTH\Models\LoginProviderQuery A secondary query class using the current class as primary query
     */
    public function useProviderPathQuery($relationAlias = null, $joinType = 'INNER JOIN')
    {
        return $this
            ->joinProviderPath($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProviderPath', '\AUTH\Models\LoginProviderQuery');
    }

    /**
     * Use the ProviderPath relation LoginProvider object
     *
     * @param callable(\AUTH\Models\LoginProviderQuery):\AUTH\Models\LoginProviderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProviderPathQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = 'INNER JOIN'
    ) {
        $relatedQuery = $this->useProviderPathQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProviderPath relation to the LoginProvider table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the EXISTS statement
     */
    public function useProviderPathExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useExistsQuery('ProviderPath', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProviderPath relation to the LoginProvider table for a NOT EXISTS query.
     *
     * @see useProviderPathExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the NOT EXISTS statement
     */
    public function useProviderPathNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useExistsQuery('ProviderPath', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProviderPath relation to the LoginProvider table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the IN statement
     */
    public function useInProviderPathQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useInQuery('ProviderPath', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProviderPath relation to the LoginProvider table for a NOT IN query.
     *
     * @see useProviderPathInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \AUTH\Models\LoginProviderQuery The inner query object of the NOT IN statement
     */
    public function useNotInProviderPathQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \AUTH\Models\LoginProviderQuery */
        $q = $this->useInQuery('ProviderPath', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLoginPath $loginPath Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($loginPath = null)
    {
        if ($loginPath) {
            $this->addUsingAlias(LoginPathTableMap::COL_ID_PATH, $loginPath->getIdPath(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the AUTH_PATHS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginPathTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginPathTableMap::clearInstancePool();
            LoginPathTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginPathTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginPathTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginPathTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginPathTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
