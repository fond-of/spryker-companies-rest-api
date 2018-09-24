<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompaniesReaderInterface
{
    /**
     * @param string $uuidQuote
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function readByIdentifier(string $uuidQuote, RestRequestInterface $restRequest): RestResponseInterface;
}
