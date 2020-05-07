<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 13:13
 */

namespace BotMan\Drivers\YAlisa\Extensions\sections;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class Footer
 *
 * @package BotMan\Drivers\YAlisa\Extensions\sections
 */
class Footer implements JsonSerializable, Arrayable
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var Button|null
     */
    protected $button;

    /**
     * Footer constructor.
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
     * @return Footer
     */
    public static function create(string $text): Footer
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
     * @return Footer
     */
    public function setText(string $text): Footer
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Button|null
     */
    public function getButton(): ?Button
    {
        return $this->button;
    }

    /**
     * @param Button|null $button
     *
     * @return Footer
     */
    public function setButton(?Button $button): Footer
    {
        $this->button = $button;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text' => $this->getText(),
            'button' => $this->getButton(),
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
