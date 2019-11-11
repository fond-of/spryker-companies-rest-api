<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;

class CompanyMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\Mapper\CompanyMapper
     */
    protected $companyMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var string
     */
    protected $nameCompany;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->nameCompany = "name-company";

        $this->companyMapper = new CompanyMapper();
    }

    /**
     * @return void
     */
    public function testMapToCompany(): void
    {
        $this->restCompaniesRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($this->nameCompany);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('setName')
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(
            CompanyTransfer::class,
            $this->companyMapper->mapToCompany(
                $this->restCompaniesRequestAttributesTransferMock,
                $this->companyTransferMock
            )
        );
    }
}
