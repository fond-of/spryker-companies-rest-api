<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiPersistenceFactory getFactory()
 */
class CompaniesRestApiRepository extends AbstractRepository implements CompaniesRestApiRepositoryInterface
{
    /**
     * @param string $companyUuid
     * @param string $naturalIdentifier
     *
     * @return bool
     */
    public function hasCompanyCustomer(string $companyUuid, string $naturalIdentifier): bool
    {
        $companyStoreEntitiesCount = $this->getFactory()
            ->createCompanyQuery()
            ->filterByUuid($companyUuid)
            ->joinWithCompanyUser()
                ->useCompanyUserQuery()
                ->joinWithCustomer()
                    ->useCustomerQuery()
                    ->filterByCustomerReference($naturalIdentifier)
                    ->endUse()
                ->endUse()
            ->count();

        return $companyStoreEntitiesCount > 0;
    }
}
