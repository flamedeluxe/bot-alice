<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 13:28
 */

namespace BotMan\Drivers\YAlisa\Extensions\sections;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class Image
 *
 * @package BotMan\Drivers\YAlisa\Extensions\sections
 */
class Image implements JsonSerializable, Arrayable
{
    /**
     * @var string
     */
    protected $imageId;

    /**
     * @var null|string
     */
    protected $title;

    /**
     * @var null|string
     */
    protected $description;

    /**
     * @var Button|null
     */
    protected $button;

    /**
     * Image constructor.
     *
     * @param string $imageId
     */
    public function __construct(string $imageId)
    {
        $this->imageId = $imageId;
    }

    /**
     * @param string $imageId
     *
     * @return static
     */
    public static function create(string $imageId)
    {
        return new static($imageId);
    }

    /**
     * @return string
     */
    public function getImageId(): string
    {
        return $this->imageId;
    }

    /**
     * @param string $imageId
     *
     * @return $this
     */
    public function setImageId(string $imageId)
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     *
     * @return $this
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return $this
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;

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
     * @return $this
     */
    public function setButton(?Button $button)
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
            'image_id' => $this->getImageId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
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
