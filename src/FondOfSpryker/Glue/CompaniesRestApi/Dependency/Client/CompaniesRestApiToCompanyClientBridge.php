<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\CompanyClientInterface;

class CompaniesRestApiToCompanyClientBridge implements CompaniesRestApiToCompanyClientInterface
{
    /**
     * @var \Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClient;

    /**
     * @param \Spryker\Client\Company\CompanyClientInterface $companyClient
     */
    public function __construct(CompanyClientInterface $companyClient)
    {
        $this->companyClient = $companyClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function findCompanyByExternalReference(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->companyClient->findCompanyByExternalReference($companyTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function createCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->companyClient->createCompany($companyTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function updateCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->companyClient->updateCompany($companyTransfer);
    }
}
