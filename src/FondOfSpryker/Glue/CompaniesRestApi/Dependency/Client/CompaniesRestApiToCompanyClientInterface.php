<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

interface CompaniesRestApiToCompanyClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function createCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer;
}
