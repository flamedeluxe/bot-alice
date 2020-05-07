<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 13:09
 */

namespace BotMan\Drivers\YAlisa\Extensions\sections;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class Header
 *
 * @package BotMan\Drivers\YAlisa\Extensions\sections
 */
class Header implements JsonSerializable, Arrayable
{
    /**
     * @var string
     */
    protected $text;

    /**
     * Header constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @param string $text
     *
     * @return Header
     */
    public static function create(string $text): Header
    {
        return new static($text);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Header
     */
    public function setText(string $text): Header
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text' => $this->getText(),
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
