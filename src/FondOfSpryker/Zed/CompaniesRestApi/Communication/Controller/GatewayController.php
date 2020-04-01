<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CompaniesRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function updateAction(
        RestCompaniesRequestTransfer $restCompaniesRequestTransfer
    ): RestCompaniesResponseTransfer {
        return $this->getFacade()
            ->update($restCompaniesRequestTransfer);
    }
}
