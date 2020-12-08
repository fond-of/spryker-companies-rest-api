<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\Dependency\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
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
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Dependency\CompaniesRestApiToCompanyClientInterface
     */
    protected $companyClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface
     */
    protected $companiesMapper;

    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface
     */
    protected $companiesRestApiClient;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Dependency\CompaniesRestApiToCompanyClientInterface $companyClient
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface $companiesMapper
     * @param \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface $companiesRestApiClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        CompaniesRestApiToCompanyClientInterface $companyClient,
        CompaniesMapperInterface $companiesMapper,
        CompaniesRestApiClientInterface $companiesRestApiClient
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restApiError = $restApiError;
        $this->companyClient = $companyClient;
        $this->companiesMapper = $companiesMapper;
        $this->companiesRestApiClient = $companiesRestApiClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCompanyByUuid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addCompanyUuidMissingError($restResponse);
        }

        $restCompaniesRequestTransfer = (new RestCompaniesRequestTransfer())
            ->setUuid($restRequest->getResource()->getId())
            ->setNaturalIdentifier($restRequest->getRestUser()->getNaturalIdentifier());

        $restCompaniesPermissionResponseTransfer = $this->companiesRestApiClient->checkPermission($restCompaniesRequestTransfer);

        if (!$restCompaniesPermissionResponseTransfer->getHasPermission()) {
            return $this->restApiError->addCompanyNoPermissionError($restResponse);
        }

        $companyTransfer = (new CompanyTransfer())
            ->setUuid($restRequest->getResource()->getId());

        $companyResponseTransfer = $this->companyClient
            ->findCompanyByUuid($companyTransfer);

        if (!$companyResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->addCompanyNotFoundError($restResponse);
        }

        $restCompanyAttributesTransfer = $this->companiesMapper
            ->mapCompanyTransferToRestCompanyResponseAttributesTransfer(
                $companyResponseTransfer->getCompanyTransfer(),
                new RestCompaniesResponseAttributesTransfer()
            );

        return $this->createResponse($restCompanyAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse(
        RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $restCompaniesResponseAttributesTransfer->getUuid(),
            $restCompaniesResponseAttributesTransfer
        );

        return $this->restResourceBuilder->createRestResponse()
            ->addResource($restResource);
    }
}
