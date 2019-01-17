<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer;
use Mockery;
use ReflectionClass;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesResourceControllerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Controller\CompaniesResourceController
     */
    protected $companiesResourceController;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\Mockery\MockInterface
     */
    protected $restRequestMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory|\Mockery\MockInterface
     */
    protected $companiesRestApiFactoryMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface|\Mockery\MockInterface
     */
    protected $companiesReaderMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface|\Mockery\MockInterface
     */
    protected $companiesWriterMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\Mockery\MockInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesRequestAttributesTransfer|\Mockery\MockInterface
     */
    protected $restCompaniesRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = Mockery::mock(RestRequestInterface::class);
        $this->restCompaniesRequestAttributesTransferMock = Mockery::mock(RestCompaniesRequestAttributesTransfer::class);
        $this->restResponseMock = Mockery::mock(RestResponseInterface::class);
        $this->companiesRestApiFactoryMock = Mockery::mock(CompaniesRestApiFactory::class);
        $this->companiesReaderMock = Mockery::mock(CompaniesReaderInterface::class);
        $this->companiesWriterMock = Mockery::mock(CompaniesWriterInterface::class);

        $this->companiesResourceController = new CompaniesResourceController();

        $reflection = new ReflectionClass(CompaniesResourceController::class);
        $parentClass = $reflection->getParentClass();
        $property = $parentClass->getProperty('factory');
        $property->setAccessible(true);
        $property->setValue($this->companiesResourceController, $this->companiesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->companiesRestApiFactoryMock->shouldReceive('createCompaniesReader')
            ->andReturn($this->companiesReaderMock);

        $this->companiesReaderMock->shouldReceive('findCompanyByExternalReference')
            ->with($this->restRequestMock)
            ->andReturn($this->restResponseMock);

        $this->assertEquals(
            $this->restResponseMock,
            $this->companiesResourceController->getAction($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testPatchAction(): void
    {
        $this->companiesRestApiFactoryMock->shouldReceive('createCompaniesWriter')
            ->andReturn($this->companiesWriterMock);

        $this->companiesWriterMock->shouldReceive('updateCompany')
            ->with($this->restRequestMock, $this->restCompaniesRequestAttributesTransferMock)
            ->andReturn($this->restResponseMock);

        $this->assertEquals($this->restResponseMock, $this->companiesResourceController->patchAction(
            $this->restRequestMock,
            $this->restCompaniesRequestAttributesTransferMock
        ));
    }

    /**
     * @return void
     */
    public function testPostAction(): void
    {
        $this->companiesRestApiFactoryMock->shouldReceive('createCompaniesWriter')
            ->andReturn($this->companiesWriterMock);

        $this->companiesWriterMock->shouldReceive('createCompany')
            ->with($this->restRequestMock, $this->restCompaniesRequestAttributesTransferMock)
            ->andReturn($this->restResponseMock);

        $this->assertEquals($this->restResponseMock, $this->companiesResourceController->postAction(
            $this->restRequestMock,
            $this->restCompaniesRequestAttributesTransferMock
        ));
    }
}
