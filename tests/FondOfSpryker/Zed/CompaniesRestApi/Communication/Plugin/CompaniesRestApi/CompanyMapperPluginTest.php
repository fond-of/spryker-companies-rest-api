<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Communication\Plugin\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacade;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;

class CompanyMapperPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Communication\Plugin\CompaniesRestApi\CompanyMapperPlugin
     */
    protected $companyMapperPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacade
     */
    protected $companiesRestApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesRestApiFacadeMock = $this->getMockBuilder(CompaniesRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyMapperPlugin = new CompanyMapperPlugin();
        $this->companyMapperPlugin->setFacade($this->companiesRestApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->companiesRestApiFacadeMock->expects($this->atLeastOnce())
            ->method('mapToCompany')
            ->willReturn($this->companyTransferMock);

        $this->assertInstanceOf(
            CompanyTransfer::class,
            $this->companyMapperPlugin->map(
                $this->restCompaniesRequestAttributesTransferMock,
                $this->companyTransferMock
            )
        );
    }
}
