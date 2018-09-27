<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestApiValidator implements RestApiValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $apiErrors;

    /**
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface $apiErrors
     */
    public function __construct(RestApiErrorInterface $apiErrors)
    {
        $this->apiErrors = $apiErrors;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function validateCompanyResponseTransfer(
        CompanyResponseTransfer $companyResponseTransfer,
        RestRequestInterface $restRequest,
        RestResponseInterface $restResponse
    ): RestResponseInterface {
        $companyTransfer = $companyResponseTransfer->getCompanyTransfer();

        if ($companyTransfer === null) {
            return $this->apiErrors->addCompanyNotFoundError($restResponse);
        }

        return $restResponse;
    }
}
