<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesReader implements CompaniesReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface
     */
    protected $companiesResourceMapper;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface
     */
    protected $companyClient;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesResourceMapperInterface $companiesResourceMapper
     * @param \FondOfSpryker\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompanyClientInterface $companyClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesResourceMapperInterface $companiesResourceMapper,
        CompaniesRestApiToCompanyClientInterface $companyClient
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesResourceMapper = $companiesResourceMapper;
        $this->companyClient = $companyClient;
    }

    /**
     * @param string $uuidQuote
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function readByIdentifier(string $uuidQuote, RestRequestInterface $restRequest): RestResponseInterface
    {

        return null;
    }
}
