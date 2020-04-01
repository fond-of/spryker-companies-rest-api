<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompaniesWriterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCompany(
        RestRequestInterface $restRequest,
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestResponseInterface;
}
