<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesWriter implements CompaniesWriterInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface $companiesRestApiClient
     */
    protected $companiesRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface
     */
    protected $companiesReader;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface $companiesRestApiClient
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface $companiesReader
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesRestApiClientInterface $companiesRestApiClient,
        RestApiErrorInterface $restApiError,
        CompaniesReaderInterface $companiesReader
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesRestApiClient = $companiesRestApiClient;
        $this->restApiError = $restApiError;
        $this->companiesReader = $companiesReader;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCompany(
        RestRequestInterface $restRequest,
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addCompanyUuidMissingError($restResponse);
        }

        $restCompaniesRequestTransfer = new RestCompaniesRequestTransfer();
        $restCompaniesRequestTransfer->setUuid($restRequest->getResource()->getId())
            ->setRestCompaniesRequestAttributes($restCompaniesRequestAttributesTransfer);

        $restCompaniesResponseTransfer = $this->companiesRestApiClient->update(
            $restCompaniesRequestTransfer
        );

        if (!$restCompaniesResponseTransfer->getIsSuccess()) {
            return $this->createSaveCompanyFailedErrorResponse($restCompaniesResponseTransfer);
        }

        return $this->createCompanySavedResponse(
            $restCompaniesResponseTransfer->getRestCompaniesResponseAttributes()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createCompanySavedResponse(
        RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $restCompaniesResponseAttributesTransfer->getUuid(),
            $restCompaniesResponseAttributesTransfer
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesResponseTransfer $restCompaniesResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createSaveCompanyFailedErrorResponse(
        RestCompaniesResponseTransfer $restCompaniesResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($restCompaniesResponseTransfer->getErrors() as $restCompaniesErrorTransfer) {
            $restResponse->addError((new RestErrorMessageTransfer())
                ->setCode($restCompaniesErrorTransfer->getCode())
                ->setStatus($restCompaniesErrorTransfer->getStatus())
                ->setDetail($restCompaniesErrorTransfer->getDetail()));
        }

        return $restResponse;
    }
}
