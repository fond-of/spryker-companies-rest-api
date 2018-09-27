<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Generated\Shared\Transfer\RestCompaniesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompaniesWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompany(RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCompany(RestRequestInterface $restRequest, RestCompaniesAttributesTransfer $restCompaniesAttributesTransfer): RestResponseInterface;
}
