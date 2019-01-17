<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Mockery;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompaniesResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Plugin\CompaniesResourceRoutePlugin
     */
    protected $companiesResourceRoutePlugin;

    /**
     * @var \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|\Mockery\MockInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = Mockery::mock(ResourceRouteCollectionInterface::class);

        $this->companiesResourceRoutePlugin = new CompaniesResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertEquals(
            CompaniesRestApiConfig::CONTROLLER_COMPANIES,
            $this->companiesResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertEquals(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $this->companiesResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertEquals(
            RestCompaniesRequestAttributesTransfer::class,
            $this->companiesResourceRoutePlugin->getResourceAttributesClassName()
        );
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->shouldReceive('addGet')
            ->with(CompaniesRestApiConfig::ACTION_COMPANIES_GET, true)
            ->andReturn($this->resourceRouteCollectionMock);

        $this->resourceRouteCollectionMock->shouldReceive('addPost')
            ->with(CompaniesRestApiConfig::ACTION_COMPANIES_POST, true)
            ->andReturn($this->resourceRouteCollectionMock);

        $this->resourceRouteCollectionMock->shouldReceive('addPatch')
            ->with(CompaniesRestApiConfig::ACTION_COMPANIES_PATCH, true)
            ->andReturn($this->resourceRouteCollectionMock);

        $this->resourceRouteCollectionMock->shouldReceive('addDelete')
            ->withAnyArgs()
            ->never();

        $this->assertEquals(
            $this->resourceRouteCollectionMock,
            $this->companiesResourceRoutePlugin->configure($this->resourceRouteCollectionMock)
        );
    }
}
