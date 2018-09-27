<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReader;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriter;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapper;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidator;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface
     */
    public function createCompaniesReader(): CompaniesReaderInterface
    {
        return new CompaniesReader(
            $this->getResourceBuilder(),
            $this->createCompaniesResourceMapper(),
            $this->getCompanyClient(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface
     */
    public function createCompaniesWriter(): CompaniesWriterInterface
    {
        return new CompaniesWriter(
            $this->getResourceBuilder(),
            $this->createCompaniesResourceMapper(),
            $this->getCompanyClient(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface
     */
    public function getCompanyClient(): CompaniesRestApiToCompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface
     */
    public function createCompaniesResourceMapper(): CompaniesResourceMapperInterface
    {
        return new CompaniesResourceMapper($this->getResourceBuilder());
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    public function createRestApiValidator(): RestApiValidatorInterface
    {
        return new RestApiValidator($this->createRestApiError());
    }
}
