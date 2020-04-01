<?php

namespace FondOfSpryker\Client\CompaniesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CompaniesRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientBridge
     */
    protected $companiesRestApiToZedRequestClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferInterfaceMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientInterfaceMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferInterfaceMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = 'url';

        $this->companiesRestApiToZedRequestClientBridge = new CompaniesRestApiToZedRequestClientBridge(
            $this->zedRequestClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientInterfaceMock->expects($this->atLeastOnce())
            ->method('call')
            ->willReturn($this->transferInterfaceMock);

        $this->assertInstanceOf(
            TransferInterface::class,
            $this->companiesRestApiToZedRequestClientBridge->call(
                $this->url,
                $this->transferInterfaceMock
            )
        );
    }
}
