<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

interface CompaniesRestApiRepositoryInterface
{
    /**
     * @param string $companyUuid
     * @param string $naturalIdentifier
     *
     * @return bool
     */
    public function hasCompanyCustomer(string $companyUuid, string $naturalIdentifier): bool;
}
