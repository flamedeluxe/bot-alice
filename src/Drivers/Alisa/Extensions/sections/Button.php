<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 13:00
 */

namespace BotMan\Drivers\YAlisa\Extensions\sections;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class Button
 *
 * @package BotMan\Drivers\YAlisa\Extensions\sections
 */
class Button implements JsonSerializable, Arrayable
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var null|string
     */
    protected $url;

    /**
     * @var null|string
     */
    protected $payload;

    /**
     * Button constructor.
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
     * @return Button
     */
    public static function create(string $text): Button
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
     * @return Button
     */
    public function setText(string $text): Button
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     *
     * @return Button
     */
    public function setUrl(?string $url): Button
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }

    /**
     * @param null|string $payload
     *
     * @return Button
     */
    public function setPayload(?string $payload): Button
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text' => $this->getText(),
            'url' => $this->getUrl(),
            'payload' => $this->getPayload(),
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
