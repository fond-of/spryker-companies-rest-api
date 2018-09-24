<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Controller;

use Generated\Shared\Transfer\RestCompaniesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

class CompaniesResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        $idCompany = $restRequest->getResource()->getId();

        return $this->getFactory()->createCompaniesReader()->readByIdentifier($idCompany, $restRequest);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest, RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): RestResponseInterface
    {
        return $this->getFactory()->createCompaniesWriter()->create($restRequest, $restCompaniesAttributesTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()->createCompaniesWriter()->delete($restRequest);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface$restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(RestRequestInterface $restRequest, RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): RestResponseInterface
    {
        return $this->getFactory()->createCompaniesWriter()->update($restRequest, $restCompaniesAttributesTransfer);
    }
}
