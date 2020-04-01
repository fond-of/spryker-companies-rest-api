<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Controller;

use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory getFactory()
 */
class CompaniesResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createCompaniesReader()
            ->findCompanyByUuid($restRequest);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(
        RestRequestInterface $restRequest,
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createCompaniesWriter()
            ->updateCompany($restRequest, $restCompaniesRequestAttributesTransfer);
    }
}
