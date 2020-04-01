<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\CompaniesRestApi;

use FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStub;
use FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface
     */
    public function createZedCompaniesRestApiStub(): CompaniesRestApiStubInterface
    {
        return new CompaniesRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompaniesRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
