<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyMapper;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyMapperInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyReader;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyReaderInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriter;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface;
use FondOfSpryker\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface getRepository()
 */
class CompaniesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyReaderInterface
     */
    public function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface
     */
    public function createCompanyWriter(): CompanyWriterInterface
    {
        return new CompanyWriter(
            $this->getRepository(),
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
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompaniesRestApiToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
