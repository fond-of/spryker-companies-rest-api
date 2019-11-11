<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCompaniesErrorTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesWriterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriter
     */
    protected $companiesWriter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface
     */
    protected $companiesRestApiClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface
     */
    protected $companiesReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected $restCompaniesResponseTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer
     */
    protected $restCompaniesResponseAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesErrorTransfer
     */
    protected $restCompaniesErrorTransferMock;

    /**
     * @var array
     */
    protected $restCompaniesErrorTransferMocks;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $detail;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiClientInterfaceMock = $this->getMockBuilder(CompaniesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesReaderInterfaceMock = $this->getMockBuilder(CompaniesReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesRequestAttributesTransferMock = $this->getMockBuilder(RestCompaniesRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 1;

        $this->restCompaniesResponseTransferMock = $this->getMockBuilder(RestCompaniesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->restCompaniesResponseAttributesTransferMock = $this->getMockBuilder(RestCompaniesResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->code = 'code';

        $this->statusCode = 404;

        $this->detail = 'detail';

        $this->restCompaniesErrorTransferMock = $this->getMockBuilder(RestCompaniesErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesErrorTransferMocks = [
            $this->restCompaniesErrorTransferMock,
        ];

        $this->companiesWriter = new CompaniesWriter(
            $this->restResourceBuilderInterfaceMock,
            $this->companiesRestApiClientInterfaceMock,
            $this->restApiErrorInterfaceMock,
            $this->companiesReaderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompany(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companiesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->restCompaniesResponseTransferMock->expects($this->atLeastOnce())
            ->method('getRestCompaniesResponseAttributes')
            ->willReturn($this->restCompaniesResponseAttributesTransferMock);

        $this->restCompaniesResponseAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companiesWriter->updateCompany(
                $this->restRequestInterfaceMock,
                $this->restCompaniesRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyCompanyUuidMissing(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companiesWriter->updateCompany(
                $this->restRequestInterfaceMock,
                $this->restCompaniesRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanySaveCompanyFailed(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companiesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(false);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restCompaniesResponseTransferMock->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn($this->restCompaniesErrorTransferMocks);

        $this->restCompaniesErrorTransferMock->expects($this->atLeastOnce())
            ->method('getCode')
            ->willReturn($this->code);

        $this->restCompaniesErrorTransferMock->expects($this->atLeastOnce())
            ->method('getStatus')
            ->willReturn($this->statusCode);

        $this->restCompaniesErrorTransferMock->expects($this->atLeastOnce())
            ->method('getDetail')
            ->willReturn($this->detail);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companiesWriter->updateCompany(
                $this->restRequestInterfaceMock,
                $this->restCompaniesRequestAttributesTransferMock
            )
        );
    }
}
