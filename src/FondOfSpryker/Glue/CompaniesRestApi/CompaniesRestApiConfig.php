<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

class CompaniesRestApiConfig
{
    public const RESOURCE_COMPANIES = 'companies';

    public const CONTROLLER_COMPANIES = 'companies-resource';

    public const ACTION_COMPANIES_GET = 'get';
    public const ACTION_COMPANIES_POST = 'post';
    public const ACTION_COMPANIES_PATCH = 'patch';

    public const RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING = '400';
    public const RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING = 'External reference is missing.';

    public const RESPONSE_CODE_COMPANY_NOT_FOUND = '401';
    public const RESPONSE_DETAILS_COMPANY_NOT_FOUND = 'Company not found.';

    public const RESPONSE_CODE_COMPANY_FAILED_TO_CREATE = '402';

    public const RESPONSE_CODE_COMPANY_FAILED_TO_SAVE = '403';
    public const RESPONSE_DETAILS_COMPANY_FAILED_TO_SAVE = 'Failed to save company.';
}
