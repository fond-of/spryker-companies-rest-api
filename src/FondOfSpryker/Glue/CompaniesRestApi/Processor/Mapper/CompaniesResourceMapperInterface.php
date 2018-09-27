<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

interface CompaniesResourceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapCompanyAttributesToCompanyTransfer(RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): CompanyTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function mapCompanyTransferToRestResource(CompanyTransfer $companyTransfer): RestResourceInterface;
}
