<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiPersistenceFactory getFactory()
 */
class CompaniesRestApiRepository extends AbstractRepository implements CompaniesRestApiRepositoryInterface
{
    /**
     * @inheritdoc
     *
     * @api
     *
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function findCompanyByExternalReference(string $externalReference): ?CompanyTransfer
    {
        $spyCompany = $this->getFactory()
            ->getCompanyPropelQuery()
            ->filterByExternalReference($externalReference)
            ->findOne();

        if ($spyCompany === null) {
            return null;
        }

        $company = (new CompanyTransfer())->fromArray(
            $spyCompany->toArray(),
            true
        );

        return $company;
    }
}
