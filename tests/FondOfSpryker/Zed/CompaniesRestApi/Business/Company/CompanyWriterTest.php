<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Dependency\Plugin\CompanyMapperPluginInterface;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;

class CompanyWriterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyWriter
     */
    protected $companyWriter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Company\Business\CompanyFacadeInterface
     */
    protected $companyFacadeInterfaceMock;

    /**
     * @var array
     */
    protected $companyMapperPlugins;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestTransfer
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyResponseTransfer
     */
    protected $companyResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesRestApi\Dependency\Plugin\CompanyMapperPluginInterface
     */
    protected $companyMapperPluginInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyFacadeInterfaceMock = $this->getMockBuilder(CompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyMapperPluginInterfaceMock = $this->getMockBuilder(CompanyMapperPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyMapperPlugins = [
            $this->companyMapperPluginInterfaceMock,
        ];

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyWriter = new CompanyWriter(
            $this->companyFacadeInterfaceMock,
            $this->companyMapperPlugins
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->companyFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getRestCompaniesRequestAttributes')
            ->willReturn($this->restCompaniesRequestAttributesTransferMock);

        $this->companyMapperPluginInterfaceMock->expects($this->atLeastOnce())
            ->method('map')
            ->willReturn($this->companyTransferMock);

        $this->companyFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companyWriter->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyFailedToLoadError(): void
    {
        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->companyFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companyWriter->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyDataInvalidError(): void
    {
        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->companyFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getRestCompaniesRequestAttributes')
            ->willReturn($this->restCompaniesRequestAttributesTransferMock);

        $this->companyMapperPluginInterfaceMock->expects($this->atLeastOnce())
            ->method('map')
            ->willReturn($this->companyTransferMock);

        $this->companyFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companyWriter->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }
}
