<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface getRepository()
 */
class CompaniesRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function createCompanyQuery(): SpyCompanyQuery
    {
        return SpyCompanyQuery::create();
    }
}
