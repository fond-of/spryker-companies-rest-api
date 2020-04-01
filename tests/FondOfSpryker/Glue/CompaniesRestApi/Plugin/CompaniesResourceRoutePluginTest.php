<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompaniesResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Plugin\CompaniesResourceRoutePlugin
     */
    protected $companiesResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesResourceRoutePlugin = new CompaniesResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addGet')
            ->willReturn($this->resourceRouteCollectionInterfaceMock);

        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addPatch')
            ->willReturn($this->resourceRouteCollectionInterfaceMock);

        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->companiesResourceRoutePlugin->configure(
                $this->resourceRouteCollectionInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $this->companiesResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            CompaniesRestApiConfig::CONTROLLER_COMPANIES,
            $this->companiesResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestCompaniesRequestAttributesTransfer::class,
            $this->companiesResourceRoutePlugin->getResourceAttributesClassName()
        );
    }
}
