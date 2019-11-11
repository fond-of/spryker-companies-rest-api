<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi;

use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReader;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesResourceRelationshipExpander;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesResourceRelationshipExpanderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriter;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapper;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface getClient()
 */
class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface
     */
    public function createCompaniesReader(): CompaniesReaderInterface
    {
        return new CompaniesReader(
            $this->getResourceBuilder(),
            $this->createRestApiError(),
            $this->getCompanyClient(),
            $this->createCompaniesMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface
     */
    public function createCompaniesWriter(): CompaniesWriterInterface
    {
        return new CompaniesWriter(
            $this->getResourceBuilder(),
            $this->getClient(),
            $this->createRestApiError(),
            $this->createCompaniesReader()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface
     */
    public function createCompaniesMapper(): CompaniesMapperInterface
    {
        return new CompaniesMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesResourceRelationshipExpanderInterface
     */
    public function createCompaniesResourceRelationshipExpander(): CompaniesResourceRelationshipExpanderInterface
    {
        return new CompaniesResourceRelationshipExpander($this->getResourceBuilder(), $this->createCompaniesMapper());
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Company\CompanyClientInterface
     */
    public function getCompanyClient(): CompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::CLIENT_COMPANY);
    }
}
