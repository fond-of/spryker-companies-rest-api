<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function findCompanyByExternalReferenceAction(RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer): RestCompaniesResponseTransfer
    {
        return $this->getFacade()->findCompanyByExternalReference($restCompaniesRequestAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function createAction(RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer): RestCompaniesResponseTransfer
    {
        return $this->getFacade()->create($restCompaniesRequestAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function updateAction(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer
    {
        return $this->getFacade()->update($restCompaniesRequestTransfer);
    }
}
