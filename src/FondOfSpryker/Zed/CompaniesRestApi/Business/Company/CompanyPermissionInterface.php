<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;

interface CompanyPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer
     */
    public function checkPermission(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesPermissionResponseTransfer;
}
