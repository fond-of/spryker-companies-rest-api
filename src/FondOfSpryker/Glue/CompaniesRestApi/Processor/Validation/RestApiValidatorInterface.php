<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $customerResponseTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function validateCompanyResponseTransfer(
        CompanyResponseTransfer $customerResponseTransfer,
        RestRequestInterface $restRequest,
        RestResponseInterface $restResponse
    ): RestResponseInterface;
}
