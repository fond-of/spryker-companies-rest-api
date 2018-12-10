<?php

namespace FondOfSpryker\Client\CompaniesRestApi;

use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiFactory getFactory()
 */
class CompaniesRestApiClient extends AbstractClient implements CompaniesRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function findCompanyByExternalReference(
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestCompaniesResponseTransfer {
        return $this->getFactory()->createZedCompaniesRestApiStub()
            ->findCompanyByExternalReference($restCompaniesRequestAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function create(RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestCompaniesResponseTransfer
    {
        return $this->getFactory()->createZedCompaniesRestApiStub()
            ->create($restCompaniesRequestAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer
    {
        return $this->getFactory()->createZedCompaniesRestApiStub()
            ->update($restCompaniesRequestTransfer);
    }
}
