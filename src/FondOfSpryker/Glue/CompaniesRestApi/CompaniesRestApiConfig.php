<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_COMPANIES = 'companies';

    public const CONTROLLER_COMPANIES = 'companies-resource';

    public const ACTION_COMPANIES_GET = 'get';
    public const ACTION_COMPANIES_POST = 'post';
    public const ACTION_COMPANIES_PATCH = 'patch';

    public const RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING = '800';
    public const RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING = 'External reference is missing.';
}
