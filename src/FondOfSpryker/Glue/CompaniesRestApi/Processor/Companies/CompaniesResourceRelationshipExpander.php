<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesResourceRelationshipExpander implements CompaniesResourceRelationshipExpanderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesMapperInterface
     */
    protected $companiesMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesMapperInterface $companiesMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesMapperInterface $companiesMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesMapper = $companiesMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array
    {
        foreach ($resources as $resource) {
            /**
             * @var \Generated\Shared\Transfer\CompanyUserTransfer|null $payload
             */
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CompanyUserTransfer)) {
                continue;
            }

            $companyTransfer = $payload->getCompany();

            if ($companyTransfer === null) {
                continue;
            }

            $restCompanyAttributesTransfer = $this->companiesMapper
                ->mapCompanyTransferToRestCompaniesResponseAttributesTransfer(
                    $companyTransfer,
                    new RestCompaniesResponseAttributesTransfer()
                );

            $companyResource = $this->restResourceBuilder->createRestResource(
                CompaniesRestApiConfig::RESOURCE_COMPANIES,
                $companyTransfer->getUuid(),
                $restCompanyAttributesTransfer
            );

            $resource->addRelationship($companyResource);
        }
        return $resources;
    }
}
