<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;

class CompaniesCompanyUsersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Plugin\CompaniesCompanyUsersResourceRelationshipPlugin
     */
    protected $companiesCompanyUsersResourceRelationshipPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesCompanyUsersResourceRelationshipPlugin = new CompaniesCompanyUsersResourceRelationshipPlugin();
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
