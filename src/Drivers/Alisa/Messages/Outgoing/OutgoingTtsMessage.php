<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 12.02.19
 * Time: 17:07
 */

namespace BotMan\Drivers\YAlisa\Messages\Outgoing;

use BotMan\Drivers\YAlisa\Extensions\CardInterface;

/**
 * Class OutgoingTtsMessage
 *
 * @package BotMan\Drivers\YAlisa\Messages\Outgoing
 */
class OutgoingTtsMessage
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $tts;

    /**
     * @var CardInterface|null
     */
    protected $card;

    /**
     * @var array
     */
    protected $buttons = [];

    /**
     * @var bool
     */
    protected $endSession = false;

    /**
     * OutgoingTtsMessage constructor.
     *
     * @param string $text
     * @param string $tts
     */
    public function __construct(string $text, string $tts)
    {
        $this->text = $text;
        $this->tts = $tts;
    }

    /**
     * @param string $text
     * @param string|null $tts
     *
     * @return static
     */
    public static function create(string $text, string $tts)
    {
        return new static($text, $tts);
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
     * @return OutgoingTtsMessage
     */
    public function setText(string $text): OutgoingTtsMessage
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getTts(): string
    {
        return $this->tts;
    }

    /**
     * @param string $tts
     *
     * @return OutgoingTtsMessage
     */
    public function setTts(string $tts): OutgoingTtsMessage
    {
        $this->tts = $tts;

        return $this;
    }

    /**
     * @return CardInterface|null
     */
    public function getCard(): ?CardInterface
    {
        return $this->card;
    }

    /**
     * @param CardInterface|null $card
     *
     * @return OutgoingTtsMessage
     */
    public function setCard(?CardInterface $card): OutgoingTtsMessage
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return array
     */
    public function getButtons(): array
    {
        return $this->buttons;
    }

    /**
     * @param array $buttons
     *
     * @return OutgoingTtsMessage
     */
    public function setButtons(array $buttons): OutgoingTtsMessage
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEndSession(): bool
    {
        return $this->endSession;
    }

    /**
     * @param bool $endSession
     *
     * @return OutgoingTtsMessage
     */
    public function setEndSession(bool $endSession): OutgoingTtsMessage
    {
        $this->endSession = $endSession;

        return $this;
    }
}
