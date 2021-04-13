<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClient;
use FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Dependency\CompaniesRestApiToCompanyClientInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReaderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesResourceRelationshipExpanderInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriterInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Mapper\CompaniesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory
     */
    protected $companiesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientInterfaceMock = $this->getMockBuilder(CompaniesRestApiToCompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiClientMock = $this->getMockBuilder(CompaniesRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiFactory = new class ($this->restResourceBuilderInterfaceMock, $this->companiesRestApiClientMock) extends CompaniesRestApiFactory
        {
            /**
             * @var \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClient
             */
            protected $companiesRestApiClient;

            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             * @param \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClient $companiesRestApiClient
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder, CompaniesRestApiClient $companiesRestApiClient)
            {
                $this->restResourceBuilder = $restResourceBuilder;
                $this->companiesRestApiClient = $companiesRestApiClient;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }

            /**
             * @return \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface
             */
            public function getClient(): CompaniesRestApiClientInterface
            {
                return $this->companiesRestApiClient;
            }
        };
        $this->companiesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompaniesReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompaniesReaderInterface::class,
            $this->companiesRestApiFactory->createCompaniesReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompaniesWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompaniesWriterInterface::class,
            $this->companiesRestApiFactory->createCompaniesWriter()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompaniesResourceRelationshipExpander(): void
    {
        $this->assertInstanceOf(
            CompaniesResourceRelationshipExpanderInterface::class,
            $this->companiesRestApiFactory->createCompaniesResourceRelationshipExpander()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompaniesMapper(): void
    {
        $this->assertInstanceOf(
            CompaniesMapperInterface::class,
            $this->companiesRestApiFactory->createCompaniesMapper()
        );
    }

    /**
     * @return void
     */
    public function testCreateRestApiError(): void
    {
        $this->assertInstanceOf(
            RestApiErrorInterface::class,
            $this->companiesRestApiFactory->createRestApiError()
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompaniesRestApiToCompanyClientInterface::class,
            $this->companiesRestApiFactory->getCompanyClient()
        );
    }
}
