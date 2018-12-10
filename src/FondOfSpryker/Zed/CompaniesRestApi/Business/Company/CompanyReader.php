<?php

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use FondOfSpryker\Shared\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesErrorTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Symfony\Component\HttpFoundation\Response;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface
     */
    protected $companiesRestApiRepository;

    /**
     * @param \FondOfSpryker\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface $companiesRestApiRepository
     */
    public function __construct(CompaniesRestApiRepositoryInterface $companiesRestApiRepository)
    {
        $this->companiesRestApiRepository = $companiesRestApiRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function findCompanyByExternalReference(
        RestCompaniesRequestAttributesTransfer $restCompaniesRequestAttributesTransfer
    ): RestCompaniesResponseTransfer {
        $companyTransfer = $this->companiesRestApiRepository->findCompanyByExternalReference(
            $restCompaniesRequestAttributesTransfer->getExternalReference()
        );

        if ($companyTransfer !== null) {
            return $this->createCompanyResponseTransfer($companyTransfer);
        }

        return $this->createCompanyFailedToLoadErrorResponseTransfer();
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected function createCompanyResponseTransfer(CompanyTransfer $companyTransfer): RestCompaniesResponseTransfer
    {
        $restCompaniesResponseAttributesTransfer = new RestCompaniesResponseAttributesTransfer();

        $restCompaniesResponseAttributesTransfer->fromArray(
            $companyTransfer->toArray(),
            true
        );

        $restCompaniesResponseTransfer = new RestCompaniesResponseTransfer();

        $restCompaniesResponseTransfer->setIsSuccess(true)
            ->setRestCompaniesResponseAttributes($restCompaniesResponseAttributesTransfer);

        return $restCompaniesResponseTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected function createCompanyFailedToLoadErrorResponseTransfer(): RestCompaniesResponseTransfer
    {
        $restCompaniesErrorTransfer = new RestCompaniesErrorTransfer();

        $restCompaniesErrorTransfer->setStatus(Response::HTTP_NOT_FOUND)
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_NOT_FOUND)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_COMPANY_NOT_FOUND);

        $restCompaniesResponseTransfer = new RestCompaniesResponseTransfer();

        $restCompaniesResponseTransfer->setIsSuccess(false)
            ->addError($restCompaniesErrorTransfer);

        return $restCompaniesResponseTransfer;
    }
}
