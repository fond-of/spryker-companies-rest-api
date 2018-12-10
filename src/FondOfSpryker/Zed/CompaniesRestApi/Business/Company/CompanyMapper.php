<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;

class CompanyMapper implements CompanyMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapToCompany(
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer,
        CompanyTransfer $companyTransfer
    ): CompanyTransfer {
        if ($restCompaniesRequestAttributesTransfer->getExternalReference() !== null) {
            $companyTransfer->setExternalReference(
                $restCompaniesRequestAttributesTransfer->getExternalReference()
            );
        }

        if ($restCompaniesRequestAttributesTransfer->getName() !== null) {
            $companyTransfer->setName($restCompaniesRequestAttributesTransfer->getName());
        }

        return $companyTransfer;
    }
}
