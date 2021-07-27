<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiFacadeInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
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
        $this->companiesRestApiFacadeInterfaceMock = $this->getMockBuilder(CompaniesRestApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestTransferMock = $this->getMockBuilder(RestCompaniesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseTransferMock = $this->getMockBuilder(RestCompaniesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesPermissionResponseTransferMock = $this->getMockBuilder(RestCompaniesPermissionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class($this->companiesRestApiFacadeInterfaceMock) extends GatewayController {
            /**
             * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface
             */
            protected $companiesRestApiFacade;

            /**
             * @param \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface $companiesRestApiFacade
             */
            public function __construct(CompaniesRestApiFacadeInterface $companiesRestApiFacade)
            {
                $this->companiesRestApiFacade = $companiesRestApiFacade;
            }

            public function getFacade(): CompaniesRestApiFacadeInterface
            {
                return $this->companiesRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testUpdateAction(): void
    {
        $this->companiesRestApiFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->restCompaniesRequestTransferMock)
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesResponseTransfer::class,
            $this->gatewayController->updateAction(
                $this->restCompaniesRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testCheckPermissionAction(): void
    {
        $this->companiesRestApiFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('checkPermission')
            ->with($this->restCompaniesRequestTransferMock)
            ->willReturn($this->restCompaniesPermissionResponseTransferMock);

        $this->assertInstanceOf(
            RestCompaniesPermissionResponseTransfer::class,
            $this->gatewayController->checkPermissionAction(
                $this->restCompaniesRequestTransferMock
            )
        );
    }
}
