<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 13:30
 */

namespace BotMan\Drivers\YAlisa\Extensions;

/**
 * Interface CardInterface
 *
 * @package BotMan\Drivers\YAlisa\Extensions
 */
interface CardInterface
{
    const TYPE_BIG_IMAGE = 'BigImage';
    const TYPE_IMAGES_LIST = 'ItemsList';

    /**
     * @return string
     */
    public function getType(): string;
}
