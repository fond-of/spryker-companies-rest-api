<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriter;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapper;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapperInterface;
use FondOfSpryker\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompaniesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface
     */
    public function createCompanyWriter(): CompanyWriterInterface
    {
        return new CompanyWriter(
            $this->getCompanyFacade(),
            $this->getCompanyMapperPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Dependency\Plugin\CompanyMapperPluginInterface[]
     */
    protected function getCompanyMapperPlugins(): array
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::PLUGINS_COMPANY_MAPPER);
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }

    /**
     * @return \Spryker\Zed\Company\Business\CompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::FACADE_COMPANY);
    }
}
