<?php

namespace FondOfSpryker\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesReader;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Companies\CompaniesWriter;
use FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError;
use Mockery;
use org\bovigo\vfs\vfsStream;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Application;
use Spryker\Glue\Kernel\Plugin\Pimple;
use Spryker\Shared\Config\Config;

class CompaniesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiFactory
     */
    protected $companiesRestApiFactory;

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsStreamDirectory;

    /**
     * @var \Spryker\Glue\Kernel\Application|\Mockery\MockInterface
     */
    protected $applicationMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\Mockery\MockInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('config_default.php')),
                ],
            ],
        ]);

        $this->applicationMock = Mockery::mock(Application::class);
        $this->restResourceBuilderMock = Mockery::mock(RestResourceBuilderInterface::class);

        Config::getInstance()->init();

        Pimple::setApplication($this->applicationMock);

        $this->companiesRestApiFactory = new CompaniesRestApiFactory();
    }

    /**
     * @return void
     */
    public function testCreateRestApiError(): void
    {
        $this->assertInstanceOf(
            RestApiError::class,
            $this->companiesRestApiFactory->createRestApiError()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompaniesReader(): void
    {
        $this->applicationMock->shouldReceive('offsetGet')
            ->with('resource_builder')
            ->andReturn($this->restResourceBuilderMock);

        $this->assertInstanceOf(
            CompaniesReader::class,
            $this->companiesRestApiFactory->createCompaniesReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompaniesWriter(): void
    {
        $this->applicationMock->shouldReceive('offsetGet')
            ->with('resource_builder')
            ->andReturn($this->restResourceBuilderMock);

        $this->assertInstanceOf(
            CompaniesWriter::class,
            $this->companiesRestApiFactory->createCompaniesWriter()
        );
    }
}
