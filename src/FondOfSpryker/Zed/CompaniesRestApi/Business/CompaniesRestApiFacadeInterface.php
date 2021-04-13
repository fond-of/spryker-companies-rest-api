<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

interface CompaniesRestApiFacadeInterface
{
    /**
     * Specification:
     * - Updates a company business unit
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(
        RestCompaniesRequestTransfer $restCompaniesRequestTransfer
    ): RestCompaniesResponseTransfer;

    /**
     * Specification:
     * - Map to company business unit transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapToCompany(
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer,
        CompanyTransfer $companyTransfer
    ): CompanyTransfer;

    /**
     * Specification:
     * - Check permission for a company business unit
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer
     */
    public function checkPermission(
        RestCompaniesRequestTransfer $restCompaniesRequestTransfer
    ): RestCompaniesPermissionResponseTransfer;
}
