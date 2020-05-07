<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 12.02.19
 * Time: 20:04
 */

namespace BotMan\Drivers\YAlisa\Messages\Outgoing\Actions;

use BotMan\BotMan\Interfaces\QuestionActionInterface;
use JsonSerializable;

/**
 * Class Button
 *
 * @package BotMan\Drivers\YAlisa\Messages\Outgoing\Actions
 */
class Button implements JsonSerializable, QuestionActionInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var null|string
     */
    protected $payload;

    /**
     * @var null|string
     */
    protected $url;

    /**
     * @var bool
     */
    protected $hide;

    /**
     * Button constructor.
     *
     * @param string $title
     * @param bool $hide
     */
    public function __construct(string $title, bool $hide)
    {
        $this->title = $title;
        $this->hide = $hide;
    }

    /**
     * @param string $title
     * @param bool $hide
     *
     * @return static
     */
    public static function create(string $title, bool $hide = true)
    {
        return new static($title, $hide);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Button
     */
    public function setTitle(string $title): Button
    {
        $this->title = $title;

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
     * @return bool
     */
    public function getHide(): bool
    {
        return $this->hide;
    }

    /**
     * @param bool $hide
     *
     * @return Button
     */
    public function setHide(bool $hide): Button
    {
        $this->hide = $hide;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'payload' => $this->getPayload(),
            'url' => $this->getUrl(),
            'hide' => $this->getHide(),
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
