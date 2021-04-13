<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyPermissionInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface;
use FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapperInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

class CompaniesRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacade
     */
    protected $companiesRestApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory
     */
    protected $companiesRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestTransfer
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriterInterface
     */
    protected $companyWriterInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected $restCompaniesResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapperInterface
     */
    protected $companyMapperInterfaceMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyPermissionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyPermissionInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesPermissionResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesRestApiBusinessFactoryMock = $this->getMockBuilder(CompaniesRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyWriterInterfaceMock = $this->getMockBuilder(CompanyWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseTransferMock = $this->getMockBuilder(RestCompaniesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyMapperInterfaceMock = $this->getMockBuilder(CompanyMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyPermissionInterfaceMock = $this->getMockBuilder(CompanyPermissionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesPermissionResponseTransferMock = $this->getMockBuilder(RestCompaniesPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiFacade = new CompaniesRestApiFacade();
        $this->companiesRestApiFacade->setFactory($this->companiesRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCheckPermission(): void
    {
        $this->companiesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyPermission')
            ->willReturn($this->companyPermissionInterfaceMock);

        $this->companyPermissionInterfaceMock->expects($this->atLeastOnce())
            ->method('checkPermission')
            ->with($this->restCompaniesRequestTransferMock)
            ->willReturn($this->restCompaniesPermissionResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesPermissionResponseTransfer::class,
            $this->companiesRestApiFacade->checkPermission(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companiesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyWriter')
            ->willReturn($this->companyWriterInterfaceMock);

        $this->companyWriterInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companiesRestApiFacade->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testMapToCompany(): void
    {
        $this->companiesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyMapper')
            ->willReturn($this->companyMapperInterfaceMock);

        $this->companyMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapToCompany')
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(
            CompanyTransfer::class,
            $this->companiesRestApiFacade->mapToCompany(
                $this->restCompaniesRequestAttributesTransferMock,
                $this->companyTransferMock
            )
        );
    }
}
