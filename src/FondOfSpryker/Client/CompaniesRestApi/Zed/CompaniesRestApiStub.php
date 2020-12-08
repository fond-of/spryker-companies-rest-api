<?php

declare(strict_types = 1);

namespace FondOfSpryker\Client\CompaniesRestApi\Zed;

use FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;

class CompaniesRestApiStub implements CompaniesRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompaniesRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\RestCompaniesResponseTransfer $restCompaniesResponseTransfer */
        $restCompaniesResponseTransfer = $this->zedRequestClient->call(
            '/companies-rest-api/gateway/update',
            $restCompaniesRequestTransfer
        );

        return $restCompaniesResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer
     */
    public function checkPermission(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesPermissionResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\RestCompaniesPermissionResponseTransfer $restCompaniesPermissionResponseTransfer */
        $restCompaniesPermissionResponseTransfer = $this->zedRequestClient->call(
            '/companies-rest-api/gateway/checkPermission',
            $restCompaniesRequestTransfer
        );

        return $restCompaniesPermissionResponseTransfer;
    }
}
