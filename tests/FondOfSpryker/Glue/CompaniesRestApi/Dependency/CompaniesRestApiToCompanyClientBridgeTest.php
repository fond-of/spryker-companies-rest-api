<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Dependency;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\CompanyClientInterface;

class CompaniesRestApiToCompanyClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Dependency\CompaniesRestApiToCompanyClientBridge
     */
    protected $companiesRestApiToCompanyClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyClientInterfaceMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiToCompanyClientBridge = new CompaniesRestApiToCompanyClientBridge(
            $this->companyClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyByUuid(): void
    {
        $this->companyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyResponseTransferMock);

        $this->assertInstanceOf(
            CompanyResponseTransfer::class,
            $this->companiesRestApiToCompanyClientBridge->findCompanyByUuid(
                $this->companyTransferMock
            )
        );
    }
}
