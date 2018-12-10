<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory getFactory()
 */
class CompaniesRestApiFacade extends AbstractFacade implements CompaniesRestApiFacadeInterface
{
    /**
     * Specification:
     * - Retrieves company business unit information by external reference.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function findCompanyByExternalReference(
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestCompaniesResponseTransfer {
        return $this->getFactory()->createCompanyReader()
            ->findCompanyByExternalReference($restCompaniesRequestAttributesTransfer);
    }

    /**
     * Specification:
     * - Creates a company business unit
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function create(RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestCompaniesResponseTransfer
    {
        return $this->getFactory()->createCompanyWriter()
            ->create($restCompaniesRequestAttributesTransfer);
    }

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
    public function update(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer
    {
        return $this->getFactory()->createCompanyWriter()
            ->update($restCompaniesRequestTransfer);
    }

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
    ): CompanyTransfer {
        return $this->getFactory()->createCompanyMapper()
            ->mapToCompany($restCompaniesRequestAttributesTransfer, $companyTransfer);
    }
}
