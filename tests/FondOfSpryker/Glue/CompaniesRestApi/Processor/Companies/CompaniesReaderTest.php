<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCompaniesErrorTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Mockery;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesReaderTest extends Unit
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
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface
     */
    protected $companiesReader;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\Mockery\MockInterface
     */
    protected $restResponseMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\Mockery\MockInterface
     */
    protected $restRequestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|\Mockery\MockInterface
     */
    protected $restResourceMock;

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
    protected $id = '312321-312321321-312321312';

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = Mockery::mock(RestResourceBuilderInterface::class);
        $this->restResourceMock = Mockery::mock(RestResourceInterface::class);
        $this->companiesRestApiClientMock = Mockery::mock(CompaniesRestApiClientInterface::class);
        $this->restApiErrorMock = Mockery::mock(RestApiErrorInterface::class);
        $this->restRequestMock = Mockery::mock(RestRequestInterface::class);
        $this->restResponseMock = Mockery::mock(RestResponseInterface::class);
        $this->restCompaniesResponseTransferMock = Mockery::mock(RestCompaniesResponseTransfer::class);
        $this->restCompaniesResponseAttributesTransferMock = Mockery::mock(RestCompaniesResponseAttributesTransfer::class);
        $this->restCompaniesErrorTransferList[] = Mockery::mock(RestCompaniesErrorTransfer::class);

        $this->id = '312321-312321321-312321312';

        $this->companiesReader = new CompaniesReader(
            $this->restResourceBuilderMock,
            $this->companiesRestApiClientMock,
            $this->restApiErrorMock
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyByExternalReference()
    {
        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->andReturn($this->restResponseMock);

        $this->restRequestMock->shouldReceive('getResource')
            ->andReturn($this->restResourceMock);

        $this->restResourceMock->shouldReceive('getId')
            ->andReturn($this->id);

        $this->restApiErrorMock->shouldReceive('addExternalReferenceMissingError')
            ->with($this->restResponseMock)
            ->never();

        $this->companiesRestApiClientMock->shouldReceive('findCompanyByExternalReference')
            ->withAnyArgs()
            ->andReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getIsSuccess')
            ->andReturn(true);

        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->never();

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

        $this->assertEquals(
            $this->restResponseMock,
            $this->companiesReader->findCompanyByExternalReference($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyByExternalReferenceWithoutId()
    {
        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->andReturn($this->restResponseMock);

        $this->restRequestMock->shouldReceive('getResource')
            ->andReturn($this->restResourceMock);

        $this->restResourceMock->shouldReceive('getId')
            ->andReturn(null);

        $this->restApiErrorMock->shouldReceive('addExternalReferenceMissingError')
            ->with($this->restResponseMock)
            ->andReturn($this->restResponseMock);

        $this->companiesRestApiClientMock->shouldReceive('findCompanyByExternalReference')
            ->withAnyArgs()
            ->never();

        $this->restCompaniesResponseTransferMock->shouldReceive('getIsSuccess')
            ->never();

        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->never();

        $this->restCompaniesResponseTransferMock->shouldReceive('getErrors')
            ->never();

        $this->restResponseMock->shouldReceive('addError')
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getCode')
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getStatus')
            ->never();

        $this->restCompaniesErrorTransferList[0]->shouldReceive('getDetail')
            ->never();

        $this->restCompaniesResponseTransferMock->shouldReceive('getRestCompaniesResponseAttributes')
            ->never();

        $this->restCompaniesResponseAttributesTransferMock->shouldReceive('getExternalReference')
            ->never();

        $this->restResourceBuilderMock->shouldReceive('createRestResource')
            ->with(
                CompaniesRestApiConfig::RESOURCE_COMPANIES,
                $this->id,
                $this->restCompaniesResponseAttributesTransferMock
            )->never();

        $this->restResponseMock->shouldReceive('addResource')
            ->with($this->restResourceMock)
            ->never();

        $this->assertEquals(
            $this->restResponseMock,
            $this->companiesReader->findCompanyByExternalReference($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyByExternalReferenceWithError()
    {
        $code = 0;
        $status = 402;
        $detail = 'Test error detail';

        $this->restResourceBuilderMock->shouldReceive('createRestResponse')
            ->andReturn($this->restResponseMock);

        $this->restRequestMock->shouldReceive('getResource')
            ->andReturn($this->restResourceMock);

        $this->restResourceMock->shouldReceive('getId')
            ->andReturn($this->id);

        $this->restApiErrorMock->shouldReceive('addExternalReferenceMissingError')
            ->with($this->restResponseMock)
            ->never();

        $this->companiesRestApiClientMock->shouldReceive('findCompanyByExternalReference')
            ->withAnyArgs()
            ->andReturn($this->restCompaniesResponseTransferMock);

        $this->restCompaniesResponseTransferMock->shouldReceive('getIsSuccess')
            ->andReturn(false);

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
            ->never();

        $this->restCompaniesResponseAttributesTransferMock->shouldReceive('getExternalReference')
            ->never();

        $this->restResourceBuilderMock->shouldReceive('createRestResource')
            ->with(
                CompaniesRestApiConfig::RESOURCE_COMPANIES,
                $this->id,
                $this->restCompaniesResponseAttributesTransferMock
            )->never();

        $this->restResponseMock->shouldReceive('addResource')
            ->with($this->restResourceMock)
            ->never();

        $this->assertEquals(
            $this->restResponseMock,
            $this->companiesReader->findCompanyByExternalReference($this->restRequestMock)
        );
    }
}
