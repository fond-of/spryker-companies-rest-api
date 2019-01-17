<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Mockery;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiErrorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError
     */
    protected $restApiError;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\Mockery\MockInterface
     */
    protected $restResponseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseMock = Mockery::mock(RestResponseInterface::class);

        $this->restApiError = new RestApiError();
    }

    /**
     * @return void
     */
    public function test(): void
    {
        $this->restResponseMock->shouldReceive('addError')
            ->with(Mockery::on(function ($argument) {
                $valid = $argument instanceof RestErrorMessageTransfer;
                $valid = $valid && $argument->getDetail() === CompaniesRestApiConfig::RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING;
                $valid = $valid && $argument->getCode() === CompaniesRestApiConfig::RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING;
                return $valid && $argument->getStatus() === Response::HTTP_BAD_REQUEST;
            }))
            ->andReturn($this->restResponseMock);

        $this->assertEquals(
            $this->restResponseMock,
            $this->restApiError->addExternalReferenceMissingError($this->restResponseMock)
        );
    }
}
