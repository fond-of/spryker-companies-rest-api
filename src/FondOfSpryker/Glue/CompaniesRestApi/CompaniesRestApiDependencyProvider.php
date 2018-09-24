<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY = 'CLIENT_COMPANY';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addCompanyClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY] = function (Container $container) {
            return new CompaniesRestApiToCompanyClientBridge($container->getLocator()->company()->client());
        };

        return $container;
    }
}
