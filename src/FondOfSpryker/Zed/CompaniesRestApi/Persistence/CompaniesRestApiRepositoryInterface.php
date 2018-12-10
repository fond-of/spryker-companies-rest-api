<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompaniesRestApiRepositoryInterface
{
    /**
     * Specification:
     *  - Retrieve a company by externalReference
     *
     * @api
     *
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function findCompanyByExternalReference(string $externalReference): ?CompanyTransfer;
}
