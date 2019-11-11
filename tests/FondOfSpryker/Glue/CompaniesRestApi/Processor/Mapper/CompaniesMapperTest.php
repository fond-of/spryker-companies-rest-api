<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;

class CompaniesMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapper
     */
    protected $companiesMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer
     */
    protected $restCompaniesResponseAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseAttributesTransferMock = $this->getMockBuilder(RestCompaniesResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesMapper = new CompaniesMapper();
    }

    /**
     * @return void
     */
    public function testMapCompanyTransferToRestCompanyResponseAttributesTransfer(): void
    {
        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->restCompaniesResponseAttributesTransferMock->expects($this->atLeastOnce())
            ->method('fromArray')
            ->willReturn($this->restCompaniesResponseAttributesTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseAttributesTransfer::class,
            $this->companiesMapper->mapCompanyTransferToRestCompanyResponseAttributesTransfer(
                $this->companyTransferMock,
                $this->restCompaniesResponseAttributesTransferMock
            )
        );
    }
}
