<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 13.02.19
 * Time: 12:38
 */

namespace BotMan\Drivers\YAlisa\Extensions;

use BotMan\Drivers\YAlisa\Extensions\sections\Footer;
use BotMan\Drivers\YAlisa\Extensions\sections\Header;
use BotMan\Drivers\YAlisa\Extensions\sections\Image;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * Class ItemsList
 *
 * @package BotMan\Drivers\YAlisa\Extensions
 */
class ItemsList implements JsonSerializable, Arrayable, CardInterface
{
    /**
     * @var Header|null
     */
    protected $header;

    /**
     * @var array|Image[]
     */
    protected $items;

    /**
     * @var Footer|null
     */
    protected $footer;

    /**
     * ItemsList constructor.
     *
     * @param Image[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param Image[] $items
     *
     * @return ItemsList
     */
    public static function create(array $items): ItemsList
    {
        return new static($items);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return static::TYPE_IMAGES_LIST;
    }

    /**
     * @return Header|null
     */
    public function getHeader(): ?Header
    {
        return $this->header;
    }

    /**
     * @param Header|null $header
     *
     * @return ItemsList
     */
    public function setHeader(?Header $header): ItemsList
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return array|Image[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array|Image[] $items
     *
     * @return ItemsList
     */
    public function setItems(array $items): ItemsList
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return Footer|null
     */
    public function getFooter(): ?Footer
    {
        return $this->footer;
    }

    /**
     * @param Footer|null $footer
     *
     * @return ItemsList
     */
    public function setFooter(?Footer $footer): ItemsList
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->getType(),
            'header' => $this->getHeader(),
            'items' => $this->getItems(),
            'footer' => $this->getFooter(),
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
