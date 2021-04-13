<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesCompanyUsersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Plugin\CompaniesCompanyUsersResourceRelationshipPlugin
     */
    protected $companiesCompanyUsersResourceRelationshipPlugin;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesRestApiFactoryMock = $this->getMockBuilder(CompaniesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyUsersResourceRelationshipPlugin = new CompaniesCompanyUsersResourceRelationshipPlugin();
        $this->companiesCompanyUsersResourceRelationshipPlugin->setFactory($this->companiesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->companiesCompanyUsersResourceRelationshipPlugin->addResourceRelationships(
            [],
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        $this->assertSame(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $this->companiesCompanyUsersResourceRelationshipPlugin->getRelationshipResourceType()
        );
    }
}
