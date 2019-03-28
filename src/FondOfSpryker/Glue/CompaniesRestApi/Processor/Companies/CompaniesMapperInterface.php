<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;

interface CompaniesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     * @param \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer
     */
    public function mapCompanyTransferToRestCompaniesResponseAttributesTransfer(
        CompanyTransfer $companyTransfer,
        RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
    ): RestCompaniesResponseAttributesTransfer;
}
