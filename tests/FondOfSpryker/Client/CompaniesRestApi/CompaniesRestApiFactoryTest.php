<?php

namespace FondOfSpryker\Client\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class CompaniesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiFactory
     */
    protected $companiesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected $companiesRestApiToZedRequestClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiToZedRequestClientInterfaceMock = $this->getMockBuilder(CompaniesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiFactory = new CompaniesRestApiFactory();
        $this->companiesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompaniesRestApiStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->companiesRestApiToZedRequestClientInterfaceMock);

        $this->assertInstanceOf(
            CompaniesRestApiStubInterface::class,
            $this->companiesRestApiFactory->createZedCompaniesRestApiStub()
        );
    }
}
