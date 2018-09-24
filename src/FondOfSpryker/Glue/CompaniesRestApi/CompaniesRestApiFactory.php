<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

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
            $this->getMultiCartClient()
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
            $this->getPersistentCartClient(),
            $this->createCompaniesReader()
        );
    }
}
