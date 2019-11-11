<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;

class CompaniesMapper implements CompaniesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     * @param \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer
     */
    public function mapCompanyTransferToRestCompanyResponseAttributesTransfer(
        CompanyTransfer $companyTransfer,
        RestCompaniesResponseAttributesTransfer $restCompaniesResponseAttributesTransfer
    ): RestCompaniesResponseAttributesTransfer {
        return $restCompaniesResponseAttributesTransfer->fromArray($companyTransfer->toArray(), true);
    }
}
