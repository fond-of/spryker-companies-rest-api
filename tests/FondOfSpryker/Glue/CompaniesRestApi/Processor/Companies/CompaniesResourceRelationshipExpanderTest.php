<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompaniesResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesResourceRelationshipExpander
     */
    protected $companiesResourceRelationshipExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface
     */
    protected $companiesMapperInterfaceMock;

    /**
     * @var array
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesResponseAttributesTransfer
     */
    protected $restCompaniesResponseAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesMapperInterfaceMock = $this->getMockBuilder(CompaniesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [
            $this->restResourceInterfaceMock,
        ];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesResponseAttributesTransferMock = $this->getMockBuilder(RestCompaniesResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->companiesResourceRelationshipExpander = new CompaniesResourceRelationshipExpander(
            $this->restResourceBuilderInterfaceMock,
            $this->companiesMapperInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companiesMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapCompanyTransferToRestCompanyResponseAttributesTransfer')
            ->willReturn($this->restCompaniesResponseAttributesTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('addRelationship')
            ->willReturn($this->restResourceInterfaceMock);

        $this->assertIsArray(
            $this->companiesResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsPayloadNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn(null);

        $this->assertIsArray(
            $this->companiesResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsCompanyTransferNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn(null);

        $this->assertIsArray(
            $this->companiesResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }
}
