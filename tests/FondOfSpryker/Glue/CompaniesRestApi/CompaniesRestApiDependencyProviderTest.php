<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiDependencyProvider
     */
    protected $companiesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
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
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesRestApiDependencyProvider->provideDependencies($this->containerMock)
        );
    }
}
