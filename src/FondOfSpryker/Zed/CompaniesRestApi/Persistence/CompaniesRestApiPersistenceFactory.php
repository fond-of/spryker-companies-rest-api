<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

use FondOfSpryker\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompaniesRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyPropelQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::PROPEL_QUERY_COMPANY);
    }
}
