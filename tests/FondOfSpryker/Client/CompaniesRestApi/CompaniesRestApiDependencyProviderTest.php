<?php

namespace FondOfSpryker\Client\CompaniesRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class CompaniesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiDependencyProvider
     */
    protected $companiesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiDependencyProvider = new CompaniesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesRestApiDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
