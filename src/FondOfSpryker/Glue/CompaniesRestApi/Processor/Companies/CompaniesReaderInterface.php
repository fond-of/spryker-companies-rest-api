<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompaniesReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCompanyByUuid(RestRequestInterface $restRequest): RestResponseInterface;
}
