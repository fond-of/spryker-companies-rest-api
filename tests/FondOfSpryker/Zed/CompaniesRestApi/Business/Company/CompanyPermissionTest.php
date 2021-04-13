<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;

class CompanyPermissionTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyPermission
     */
    protected $companyPermission;

    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiRepositoryInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $naturalIdentifier;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companiesRestApiRepositoryInterfaceMock = $this->getMockBuilder(CompaniesRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->naturalIdentifier = 'natural-identifier';

        $this->companyPermission = new CompanyPermission($this->companiesRestApiRepositoryInterfaceMock);
    }

    /**
     * @return void
     */
    public function testCheckPermission(): void
    {
        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restCompaniesRequestTransferMock->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($this->naturalIdentifier);

        $this->companiesRestApiRepositoryInterfaceMock->expects($this->atLeastOnce())
            ->method('hasCompanyCustomer')
            ->with($this->uuid, $this->naturalIdentifier)
            ->willReturn(true);

        $this->assertInstanceOf(
            RestCompaniesPermissionResponseTransfer::class,
            $this->companyPermission->checkPermission(
                $this->restCompaniesRequestTransferMock
            )
        );
    }
}
