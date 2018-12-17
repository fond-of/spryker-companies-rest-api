<?php

namespace FondOfSpryker\Shared\CompaniesRestApi;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class CompaniesRestApiConfig extends AbstractBundleConfig
{
    public const RESPONSE_CODE_COMPANY_DATA_INVALID = '900';
    public const RESPONSE_CODE_COMPANY_FAILED_TO_SAVE = '901';
    public const RESPONSE_CODE_COMPANY_NOT_FOUND = '902';

    public const RESPONSE_DETAILS_COMPANY_DATA_INVALID = 'Company data is invalid.';
    public const RESPONSE_DETAILS_COMPANY_FAILED_TO_SAVE = 'Failed to save company.';
    public const RESPONSE_DETAILS_COMPANY_NOT_FOUND = 'Company not found.';
}
