<?php

declare(strict_types = 1);

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
    public function addCompanyUuidMissingError(RestResponseInterface $restResponse): RestResponseInterface
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
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAIL_COMPANY_NOT_FOUND);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyNoPermissionError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_NO_PERMISSION)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAIL_NO_PERMISSION);

        return $restResponse->addError($restErrorTransfer);
    }
}
