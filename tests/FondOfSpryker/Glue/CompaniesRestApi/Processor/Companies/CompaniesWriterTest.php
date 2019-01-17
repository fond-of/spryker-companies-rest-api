<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCompaniesErrorTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Mockery;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesWriterTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\Mockery\MockInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface|\Mockery\MockInterface
     */
    protected $companiesRestApiClientMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface|\Mockery\MockInterface
     */
    protected $restApiErrorMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Business\Company\CompanyReaderInterface|\Mockery\MockInterface
     */
    protected $companiesReaderMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface
     */
    protected $companiesWriter;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\Mockery\MockInterface
     */
    protected $restRequestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\Mockery\MockInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer|\Mockery\MockInterface
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesResponseTransfer|\Mockery\MockInterface
     */
    protected $restCompaniesResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer|\Mockery\MockInterface
     */
    protected $restCompaniesResponseAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesErrorTransfer[]|\Mockery\MockInterface[]
     */
    protected $restCompaniesErrorTransferList = [];

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|\Mockery\MockInterface
     */
    protected $restResourceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = Mockery::mock(RestResourceBuilderInterface::class);
        $this->companiesRestApiClientMock = Mockery::mock(CompaniesRestApiClientInterface::class);
        $this->restApiErrorMock = Mockery::mock(RestApiErrorInterface::class);
        $this->companiesReaderMock = Mockery::mock(CompaniesReaderInterface::class);

        $this->restRequestMock = Mockery::mock(RestRequestInterface::class);
        $this->restResponseMock = Mockery::mock(RestResponseInterface::class);
        $this->restResourceMock = Mockery::mock(RestResourceInterface::class);

        $this->restCompaniesRequestAttributesTransferMock = Mockery::mock(RestCompaniesRequestAttributesTransfer::class);
        $this->restCompaniesResponseTransferMock = Mockery::mock(RestCompaniesResponseTransfer::class);
        $this->restCompaniesResponseAttributesTransferMock = Mockery::mock(RestCompaniesResponseAttributesTransfer::class);
        $this->restCompaniesErrorTransferList[] = Mockery::mock(RestCompaniesErrorTransfer::class);

        $this->id = '312321-312321321-312321312';

        $this->companiesWriter = new CompaniesWriter(
            $this->restResourceBuilderMock,
            $this->companiesRestApiClientMock,
            $this->restApiErrorMock,
            $this->companiesReaderMock
        );
    }

    /**
     * @return void
     */
    public function testCreateCompany(): void
    {
        $this->companiesRestApiClientMock->shouldReceive('create')
            ->with($this->restCompaniesRequestAttributesTransferMock)
            ->andReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getIsSuccess')
            ->andReturn(true);

        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->andReturn($this->restResponseMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getErrors')
            ->never();

        $this->restResponseMock->shouldReceive('addError')
            ->withAnyArgs()
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getCode')
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getStatus')
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getDetail')
            ->never();

        $this->restCompaniesResponseTransferMock->shouldReceive('getRestCompaniesResponseAttributes')
            ->andReturn($this->restCompaniesResponseAttributesTransferMock);

        $this->restCompaniesResponseAttributesTransferMock->shouldReceive('getExternalReference')
            ->andReturn($this->id);

        $this->restResourceBuilderMock->shouldReceive('createRestResource')
            ->with(
                CompaniesRestApiConfig::RESOURCE_COMPANIES,
                $this->id,
                $this->restCompaniesResponseAttributesTransferMock
            )->andReturn($this->restResourceMock);

        $this->restResponseMock->shouldReceive('addResource')
            ->with($this->restResourceMock)
            ->andReturn($this->restResponseMock);

        $this->companiesWriter->createCompany(
            $this->restRequestMock,
            $this->restCompaniesRequestAttributesTransferMock
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyWithErrors(): void
    {
        $code = 0;
        $status = 402;
        $detail = 'Test error detail';

        $this->companiesRestApiClientMock->shouldReceive('create')
            ->with($this->restCompaniesRequestAttributesTransferMock)
            ->andReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getIsSuccess')
            ->andReturn(true);

        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->andReturn($this->restResponseMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getErrors')
            ->andReturn($this->restCompaniesErrorTransferList);

        $this->restResponseMock->shouldReceive('addError')
            ->withAnyArgs();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getCode')
            ->andReturn($code);

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getStatus')
            ->andReturn($status);

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getDetail')
            ->andReturn($detail);

        $this->restCompaniesResponseTransferMock->shouldReceive('getRestCompaniesResponseAttributes')
            ->andReturn($this->restCompaniesResponseAttributesTransferMock);

        $this->restCompaniesResponseAttributesTransferMock->shouldReceive('getExternalReference')
            ->andReturn($this->id);

        $this->restResourceBuilderMock->shouldReceive('createRestResource')
            ->with(
                CompaniesRestApiConfig::RESOURCE_COMPANIES,
                $this->id,
                $this->restCompaniesResponseAttributesTransferMock
            )->andReturn($this->restResourceMock);

        $this->restResponseMock->shouldReceive('addResource')
            ->with($this->restResourceMock)
            ->andReturn($this->restResponseMock);

        $this->companiesWriter->createCompany(
            $this->restRequestMock,
            $this->restCompaniesRequestAttributesTransferMock
        );
    }
}
