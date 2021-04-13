<?php

namespace FondOfSpryker\Client\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

class CompaniesRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClient
     */
    protected $companiesRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiFactory
     */
    protected $companiesRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestTransfer
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface
     */
    protected $companiesRestApiStubInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected $restCompaniesResponseTransferMock;

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

        $this->companiesRestApiFactoryMock = $this->getMockBuilder(CompaniesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiStubInterfaceMock = $this->getMockBuilder(CompaniesRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseTransferMock = $this->getMockBuilder(RestCompaniesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesPermissionResponseTransferMock = $this->getMockBuilder(RestCompaniesPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiClient = new CompaniesRestApiClient();
        $this->companiesRestApiClient->setFactory($this->companiesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companiesRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedCompaniesRestApiStub')
            ->willReturn($this->companiesRestApiStubInterfaceMock);

        $this->companiesRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companiesRestApiClient->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testCheckPermission(): void
    {
        $this->companiesRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedCompaniesRestApiStub')
            ->willReturn($this->companiesRestApiStubInterfaceMock);

        $this->companiesRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('checkPermission')
            ->willReturn($this->restCompaniesPermissionResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesPermissionResponseTransfer::class,
            $this->companiesRestApiClient->checkPermission(
                $this->restCompaniesRequestTransferMock
            )
        );
    }
}
