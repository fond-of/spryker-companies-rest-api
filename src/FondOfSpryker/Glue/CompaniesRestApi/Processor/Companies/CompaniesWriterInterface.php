<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompaniesWriterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function create(RestRequestInterface $restRequest, RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateItemQuantity(
        RestRequestInterface $restRequest,
        RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
    ): RestResponseInterface;
}
