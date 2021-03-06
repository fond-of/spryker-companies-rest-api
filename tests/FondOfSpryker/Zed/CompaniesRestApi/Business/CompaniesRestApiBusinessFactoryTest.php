<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapperInterface;
use FondOfSpryker\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompaniesRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory
     */
    protected $companiesRestApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Company\Business\CompanyFacadeInterface
     */
    protected $companyFacadeInterfaceMock;

    /**
     * @var array
     */
    protected $companyMapperPlugins;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeInterfaceMock = $this->getMockBuilder(CompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyMapperPlugins = [];

        $this->companiesRestApiBusinessFactory = new CompaniesRestApiBusinessFactory();
        $this->companiesRestApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnOnConsecutiveCalls(
                [CompaniesRestApiDependencyProvider::FACADE_COMPANY],
                [CompaniesRestApiDependencyProvider::PLUGINS_COMPANY_MAPPER]
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyFacadeInterfaceMock,
                $this->companyMapperPlugins
            );

        $this->assertInstanceOf(
            CompanyWriterInterface::class,
            $this->companiesRestApiBusinessFactory->createCompanyWriter()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyMapper(): void
    {
        $this->assertInstanceOf(
            CompanyMapperInterface::class,
            $this->companiesRestApiBusinessFactory->createCompanyMapper()
        );
    }
}
