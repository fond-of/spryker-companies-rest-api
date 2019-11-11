<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_COMPANIES = 'companies';
    public const CONTROLLER_COMPANIES = 'companies-resource';

    public const RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING = '800';
    public const RESPONSE_CODE_COMPANY_NOT_FOUND = '801';

    public const RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING = 'External reference is missing.';
    public const RESPONSE_DETAIL_COMPANY_NOT_FOUND = 'Company not found.';
}
