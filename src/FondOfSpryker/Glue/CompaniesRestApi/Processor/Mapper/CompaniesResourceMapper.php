<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper;

use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

class CompaniesResourceMapper implements CompaniesResourceMapperInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder)
    {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapCompanyAttributesToCompanyTransfer(
        RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
    ): CompanyTransfer {
        return (new CompanyTransfer())->fromArray($restCompaniesAttributesTransfer->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function mapCompanyTransferToRestResource(CompanyTransfer $companyTransfer): RestResourceInterface
    {
        $restCompaniesResponseAttributesTransfer = (new RestCompaniesResponseAttributesTransfer())
            ->fromArray($companyTransfer->toArray(), true);

        return $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $companyTransfer->getExternalReference(),
            $restCompaniesResponseAttributesTransfer
        );
    }
}
