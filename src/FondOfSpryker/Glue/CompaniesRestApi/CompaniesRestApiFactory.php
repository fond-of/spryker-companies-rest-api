<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReader;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriter;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
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
            $this->getClient(),
            $this->createRestApiError()
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
     * @return \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }
}
