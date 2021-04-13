<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesResourceControllerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Controller\CompaniesResourceController
     */
    protected $companiesResourceController;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesReaderInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesWriterInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companiesRestApiFactory = $this->getMockBuilder(CompaniesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesReaderInterfaceMock = $this->getMockBuilder(CompaniesReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesWriterInterfaceMock = $this->getMockBuilder(CompaniesWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesResourceController = new class ($this->companiesRestApiFactory) extends CompaniesResourceController {
            /**
             * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory
             */
            protected $companiesRestApiFactory;

            /**
             * @param \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory $companiesRestApiFactory
             */
            public function __construct(CompaniesRestApiFactory $companiesRestApiFactory)
            {
                $this->companiesRestApiFactory = $companiesRestApiFactory;
            }

            /**
             * @return \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory
             */
            public function getFactory(): CompaniesRestApiFactory
            {
                return $this->companiesRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->companiesRestApiFactory->expects($this->atLeastOnce())
            ->method('createCompaniesReader')
            ->willReturn($this->companiesReaderInterfaceMock);

        $this->companiesReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->with($this->restRequestInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companiesResourceController->getAction(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testPatchAction(): void
    {
        $this->companiesRestApiFactory->expects($this->atLeastOnce())
            ->method('createCompaniesWriter')
            ->willReturn($this->companiesWriterInterfaceMock);

        $this->companiesWriterInterfaceMock->expects($this->atLeastOnce())
            ->method('updateCompany')
            ->with($this->restRequestInterfaceMock, $this->restCompaniesRequestAttributesTransferMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companiesResourceController->patchAction(
                $this->restRequestInterfaceMock,
                $this->restCompaniesRequestAttributesTransferMock
            )
        );
    }
}
