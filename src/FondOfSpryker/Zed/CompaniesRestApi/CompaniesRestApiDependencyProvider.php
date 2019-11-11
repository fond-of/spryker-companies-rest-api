<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CompaniesRestApi;

use FondOfSpryker\Zed\CompaniesRestApi\Communication\Plugin\CompaniesRestApi\CompanyMapperPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompaniesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY = 'FACADE_COMPANY';
    public const PLUGINS_COMPANY_MAPPER = 'PLUGINS_COMPANY_MAPPER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyFacade($container);
        $container = $this->addCompanyMapperPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = static function (Container $container) {
            return $container->getLocator()->company()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyMapperPlugins(Container $container): Container
    {
        $container[static::PLUGINS_COMPANY_MAPPER] = function () {
            return $this->getCompanyMapperPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesRestApi\Dependency\Plugin\CompanyMapperPluginInterface[]
     */
    protected function getCompanyMapperPlugins(): array
    {
        return [
            new CompanyMapperPlugin(),
        ];
    }
}
