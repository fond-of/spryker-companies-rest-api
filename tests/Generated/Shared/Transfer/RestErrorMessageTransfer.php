<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class RestErrorMessageTransfer extends AbstractTransfer
{
    public const STATUS = 'status';

    public const CODE = 'code';

    public const DETAIL = 'detail';

    /**
     * @var int|null
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $code;

    /**
     * @var string|null
     */
    protected $detail;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'status' => 'status',
        'Status' => 'status',
        'code' => 'code',
        'Code' => 'code',
        'detail' => 'detail',
        'Detail' => 'detail',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::STATUS => [
            'type' => 'int',
            'name_underscore' => 'status',
            'is_collection' => false,
            'is_transfer' => false,
            'rest_request_parameter' => 'no',
        ],
        self::CODE => [
            'type' => 'string',
            'name_underscore' => 'code',
            'is_collection' => false,
            'is_transfer' => false,
            'rest_request_parameter' => 'no',
        ],
        self::DETAIL => [
            'type' => 'string',
            'name_underscore' => 'detail',
            'is_collection' => false,
            'is_transfer' => false,
            'rest_request_parameter' => 'no',
        ],
    ];

    /**
     * @module GlueApplication
     *
     * @param int|null $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->modifiedProperties[self::STATUS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @module GlueApplication
     *
     * @return $this
     */
    public function requireStatus()
    {
        $this->assertPropertyIsSet(self::STATUS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        $this->modifiedProperties[self::CODE] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @module GlueApplication
     *
     * @return $this
     */
    public function requireCode()
    {
        $this->assertPropertyIsSet(self::CODE);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $detail
     *
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        $this->modifiedProperties[self::DETAIL] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return string|null
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @module GlueApplication
     *
     * @return $this
     */
    public function requireDetail()
    {
        $this->assertPropertyIsSet(self::DETAIL);

        return $this;
    }
}
