<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

class CompaniesRestApiConfig
{
    public const RESOURCE_COMPANIES = 'companies';

    public const CONTROLLER_COMPANIES = 'companies-resource';

    public const ACTION_COMPANIES_GET = 'get';
    public const ACTION_COMPANIES_POST = 'post';
    public const ACTION_COMPANIES_DELETE = 'delete';
    public const ACTION_COMPANIES_PATCH = 'patch';

    public const RESPONSE_CODE_COMPANY_NOT_FOUND = '101';
    public const RESPONSE_CODE_FAILED_CREATING_COMPANY = '102';
    public const RESPONSE_CODE_FAILED_UPDATING_COMPANY = '103';
    public const RESPONSE_CODE_FAILED_DELETING_COMPANY = '104';
    public const RESPONSE_CODE_MISSING_REQUIRED_PARAMETER = '108';

    public const EXCEPTION_MESSAGE_COMPANY_ID_MISSING = 'Company identifier is required.';
    public const EXCEPTION_MESSAGE_FAILED_CREATING_COMPANY = 'Could not create company.';
    public const EXCEPTION_MESSAGE_FAILED_UPDATING_COMPANY = 'Could not update company.';
    public const EXCEPTION_MESSAGE_FAILED_DELETING_COMPANY = 'Could not delete company.';
    public const EXCEPTION_MESSAGE_COMPANY_NOT_FOUND = 'Company with id \'%s\' not found.';
}
