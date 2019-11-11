<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Plugin;

use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompaniesResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection
            ->addGet('get')
            ->addPatch('patch');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return CompaniesRestApiConfig::RESOURCE_COMPANIES;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompaniesRestApiConfig::CONTROLLER_COMPANIES;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompaniesRequestAttributesTransfer::class;
    }
}
