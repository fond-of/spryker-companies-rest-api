<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesAttributesTransfer;
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
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface
     */
    protected $companiesResourceMapper;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface
     */
    protected $companyClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidator;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface $companiesResourceMapper
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface $companyClient
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesResourceMapperInterface $companiesResourceMapper,
        CompaniesRestApiToCompanyClientInterface $companyClient,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesResourceMapper = $companiesResourceMapper;
        $this->companyClient = $companyClient;
        $this->restApiError = $restApiError;
        $this->restApiValidator = $restApiValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompany(RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
    ): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $companyTransfer = (new CompanyTransfer())->fromArray($restCompaniesAttributesTransfer->toArray(), true);
        $companyResponseTransfer = $this->companyClient->createCompany($companyTransfer);

        if (!$companyResponseTransfer->getIsSuccessful()) {
            foreach ($companyResponseTransfer->getMessages() as $message) {
                return $this->restApiError->addCompanyCantCreateMessageError($restResponse, $message->getText());
            }
        }

        $restResource = $this->companiesResourceMapper->mapCompanyTransferToRestResource($companyResponseTransfer->getCompanyTransfer());

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCompany(
        RestRequestInterface $restRequest,
        RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $companyTransfer = (new CompanyTransfer())->setExternalReference($restRequest->getResource()->getId());

        $companyResponseTransfer = $this->companyClient->findCompanyByExternalReference($companyTransfer);

        $restResponse = $this->restApiValidator->validateCompanyResponseTransfer(
            $companyResponseTransfer,
            $restRequest,
            $restResponse
        );

        if (count($restResponse->getErrors()) > 0) {
            return $restResponse;
        }

        $companyResponseTransfer->getCompanyTransfer()->fromArray(
            $this->getCompanyData($restCompaniesAttributesTransfer)
        );

        $companyResponseTransfer = $this->companyClient->updateCompany($companyResponseTransfer->getCompanyTransfer());

        if (!$companyResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->addCompanyNotSavedError($restResponse);
        }

        $restResource = $this->companiesResourceMapper->mapCompanyTransferToRestResource($companyResponseTransfer->getCompanyTransfer());

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return array
     */
    protected function getCompanyData(RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): array
    {
        $companyData = $restCompaniesAttributesTransfer->modifiedToArray(true, true);

        return $this->cleanUpCompanyAttributes($companyData);
    }

    /**
     * @param array $companyAttributes
     *
     * @return array
     */
    protected function cleanUpCompanyAttributes(array $companyAttributes): array
    {
        return $companyAttributes;
    }
}
