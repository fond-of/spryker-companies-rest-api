<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesReader implements CompaniesReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface
     */
    protected $companiesRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface $companiesRestApiClient
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesRestApiClientInterface $companiesRestApiClient,
        RestApiErrorInterface $restApiError
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesRestApiClient = $companiesRestApiClient;
        $this->restApiError = $restApiError;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCompanyByExternalReference(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addExternalReferenceMissingError($restResponse);
        }

        $restCompaniesRequestAttributesTransfer = new RestCompaniesRequestAttributesTransfer();
        $restCompaniesRequestAttributesTransfer->setExternalReference($restRequest->getResource()->getId());

        $restCompaniesResponseTransfer = $this->companiesRestApiClient
            ->findCompanyByExternalReference($restCompaniesRequestAttributesTransfer);

        if (!$restCompaniesResponseTransfer->getIsSuccess()) {
            return $this->createLoadCompanyFailedErrorResponse($restCompaniesResponseTransfer);
        }

        return $this->createCompanyLoadedResponse($restCompaniesResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesResponseTransfer $restCompaniesResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createCompanyLoadedResponse(
        RestCompaniesResponseTransfer $restCompaniesResponseTransfer
    ): RestResponseInterface {
        $restCompaniesResponseAttributesTransfer = $restCompaniesResponseTransfer->getRestCompaniesResponseAttributes();

        $restResource = $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $restCompaniesResponseAttributesTransfer->getExternalReference(),
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
    protected function createLoadCompanyFailedErrorResponse(
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
