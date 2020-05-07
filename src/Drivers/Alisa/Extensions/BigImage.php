<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 12:38
 */

namespace BotMan\Drivers\YAlisa\Extensions;

use BotMan\Drivers\YAlisa\Extensions\sections\Image;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class BigImage
 *
 * @package BotMan\Drivers\YAlisa\Extensions
 */
class BigImage extends Image implements JsonSerializable, Arrayable, CardInterface
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return static::TYPE_BIG_IMAGE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
                'type' => $this->getType(),
            ] + parent::toArray();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return parent::jsonSerialize();
    }
}
