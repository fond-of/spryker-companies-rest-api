<?php

namespace FondOfSpryker\Client\CompaniesRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

class CompaniesRestApiStubTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\Zed\CompaniesRestApiStub
     */
    protected $companiesRestApiStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestTransfer
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected $restCompaniesResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseTransferMock = $this->getMockBuilder(RestCompaniesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiStub = new CompaniesRestApiStub(
            $this->zedRequestClientMock
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->companiesRestApiStub->update(
                $this->restCompaniesRequestTransferMock
            )
        );
    }
}
