<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory
     */
    protected $companiesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientInterfaceMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiFactory = new CompaniesRestApiFactory();
        $this->companiesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompaniesMapper(): void
    {
        $this->assertInstanceOf(
            CompaniesMapperInterface::class,
            $this->companiesRestApiFactory->createCompaniesMapper()
        );
    }

    /**
     * @return void
     */
    public function testCreateRestApiError(): void
    {
        $this->assertInstanceOf(
            RestApiErrorInterface::class,
            $this->companiesRestApiFactory->createRestApiError()
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyClientInterface::class,
            $this->companiesRestApiFactory->getCompanyClient()
        );
    }
}
