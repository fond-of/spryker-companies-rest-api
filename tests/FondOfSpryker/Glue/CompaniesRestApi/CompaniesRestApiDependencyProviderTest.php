<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use Mockery;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Glue\Kernel\Container|\Mockery\MockInterface|null
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiDependencyProvider
     */
    protected $companiesRestApiDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = Mockery::mock(Container::class);

        $this->companiesRestApiDependencyProvider = new CompaniesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->containerMock->shouldReceive('offsetSet')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_COMPANY, Mockery::type('callable'));

        $this->companiesRestApiDependencyProvider->provideDependencies($this->containerMock);
    }
}
