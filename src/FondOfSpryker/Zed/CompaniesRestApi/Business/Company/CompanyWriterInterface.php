<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

interface CompanyWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(
        RestCompaniesRequestTransfer $restCompaniesRequestTransfer
    ): RestCompaniesResponseTransfer;
}
