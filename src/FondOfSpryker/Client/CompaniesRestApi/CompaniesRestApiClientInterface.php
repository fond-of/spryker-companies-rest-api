<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\CompaniesRestApi;

use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

interface CompaniesRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer
     */
    public function checkPermission(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesPermissionResponseTransfer;
}
