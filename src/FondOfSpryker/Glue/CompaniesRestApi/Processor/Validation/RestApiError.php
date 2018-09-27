<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation;

use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addExternalReferenceMissingError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_COMPANY_NOT_FOUND);
        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param string $errorMessage
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyCantCreateMessageError(
        RestResponseInterface $restResponse,
        string $errorMessage
    ): RestResponseInterface {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_FAILED_TO_CREATE)
            ->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setDetail($errorMessage);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyNotSavedError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_FAILED_TO_SAVE)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_COMPANY_FAILED_TO_SAVE);
        return $restResponse->addError($restErrorTransfer);
    }
}
