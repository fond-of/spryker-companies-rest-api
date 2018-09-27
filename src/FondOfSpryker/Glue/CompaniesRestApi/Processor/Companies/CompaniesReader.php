<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiValidatorInterface;
use Generated\Shared\Transfer\CompanyTransfer;
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

        $customersResource = $this->companiesResourceMapper
            ->mapCompanyTransferToRestResource($companyResponseTransfer->getCompanyTransfer());

        $restResponse->addResource($customersResource);

        return $restResponse;
    }
}
