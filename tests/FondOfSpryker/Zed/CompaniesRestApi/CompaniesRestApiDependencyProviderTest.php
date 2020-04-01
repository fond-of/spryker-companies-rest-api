<?php

namespace FondOfSpryker\Zed\CompaniesRestApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CompaniesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider
     */
    protected $companiesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
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
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesRestApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
