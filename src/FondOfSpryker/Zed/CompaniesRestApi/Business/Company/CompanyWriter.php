<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\CompaniesRestApi\Business\Company;

use FondOfSpryker\Shared\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompaniesErrorTransfer;
use Generated\Shared\Transfer\RestCompaniesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseTransfer;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class CompanyWriter implements CompanyWriterInterface
{
    /**
     * @var \Spryker\Zed\Company\Business\CompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @var array
     */
    protected $companyMapperPlugins;

    /**
     * @param \Spryker\Zed\Company\Business\CompanyFacadeInterface $companyFacade
     * @param array $companyMapperPlugins
     */
    public function __construct(
        CompanyFacadeInterface $companyFacade,
        array $companyMapperPlugins
    ) {
        $this->companyFacade = $companyFacade;
        $this->companyMapperPlugins = $companyMapperPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesRequestTransfer $restCompaniesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    public function update(RestCompaniesRequestTransfer $restCompaniesRequestTransfer): RestCompaniesResponseTransfer
    {
        $filterCompanyTransfer = (new CompanyTransfer())
            ->setUuid($restCompaniesRequestTransfer->getUuid());

        $companyResponseTransfer = $this->companyFacade
            ->findCompanyByUuid($filterCompanyTransfer);

        if (!$companyResponseTransfer->getIsSuccessful()) {
            return $this->createCompanyFailedToLoadErrorResponseTransfer();
        }

        $companyTransfer = $companyResponseTransfer->getCompanyTransfer();

        foreach ($this->companyMapperPlugins as $companyMapperPlugin) {
            $companyTransfer = $companyMapperPlugin->map(
                $restCompaniesRequestTransfer->getRestCompaniesRequestAttributes(),
                $companyTransfer
            );
        }

        try {
            $companyResponseTransfer = $this->companyFacade->update($companyTransfer);
        } catch (PropelException $e) {
            return $this->createCompanyDataInvalidErrorResponse();
        }

        if (!$companyResponseTransfer->getIsSuccessful()) {
            return $this->createCompanyDataInvalidErrorResponse();
        }

        return $this->createCompanyResponseTransfer(
            $companyResponseTransfer->getCompanyTransfer()
        );
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected function createCompanyDataInvalidErrorResponse(): RestCompaniesResponseTransfer
    {
        $restCompaniesErrorTransfer = new RestCompaniesErrorTransfer();

        $restCompaniesErrorTransfer->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_DATA_INVALID)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_COMPANY_DATA_INVALID);

        $restCompaniesResponseTransfer = new RestCompaniesResponseTransfer();

        $restCompaniesResponseTransfer->setIsSuccess(false)
            ->addError($restCompaniesErrorTransfer);

        return $restCompaniesResponseTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected function createCompanyFailedToSaveErrorResponse(): RestCompaniesResponseTransfer
    {
        $restCompaniesErrorTransfer = new RestCompaniesErrorTransfer();

        $restCompaniesErrorTransfer->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_FAILED_TO_SAVE)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAILS_COMPANY_FAILED_TO_SAVE);

        $restCompaniesResponseTransfer = new RestCompaniesResponseTransfer();

        $restCompaniesResponseTransfer->setIsSuccess(false)
            ->addError($restCompaniesErrorTransfer);

        return $restCompaniesResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesResponseTransfer
     */
    protected function createCompanyResponseTransfer(
        CompanyTransfer $companyTransfer
    ): RestCompaniesResponseTransfer {
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
