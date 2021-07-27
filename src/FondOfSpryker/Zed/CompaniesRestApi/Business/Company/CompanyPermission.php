<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;

class CompanyPermission implements CompanyPermissionInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface
     */
    protected $companyRepository;

    /**
     * @param \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface $companyRepository
     */
    public function __construct(CompaniesRestApiRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer
     */
    public function checkPermission(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesPermissionResponseTransfer
    {
        $hasCompanyCustomer = $this->companyRepository->hasCompanyCustomer(
            $restCompaniesRequestTransfer->getUuid(),
            $restCompaniesRequestTransfer->getNaturalIdentifier()
        );

        return (new RestCompaniesPermissionResponseTransfer())->setHasPermission($hasCompanyCustomer);
    }
}
