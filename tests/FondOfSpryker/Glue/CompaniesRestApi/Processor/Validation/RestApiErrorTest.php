<?php

namespace FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class RestApiErrorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesRestApi\Processor\Validation\RestApiError
     */
    protected $restApiError;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiError = new RestApiError();
    }

    /**
     * @return void
     */
    public function testAddCompanyUuidMissingError(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->addCompanyUuidMissingError(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddCompanyNotFoundError(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->addCompanyNotFoundError(
                $this->restResponseInterfaceMock
            )
        );
    }
}
