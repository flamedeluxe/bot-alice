<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 12.02.19
 * Time: 21:43
 */

namespace BotMan\Drivers\YAlisa\Messages\Conversations;

use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\YAlisa\Exceptions\YAlisaException;
use BotMan\Drivers\YAlisa\Messages\Outgoing\OutgoingTtsMessage;
use Closure;

/**
 * Class Conversation
 *
 * @package BotMan\Drivers\YAlisa\Messages\Conversations
 */
abstract class Conversation extends \BotMan\BotMan\Messages\Conversations\Conversation
{
    /**
     * @param Question|string $question
     * @param array|Closure $next
     * @param array $additionalParameters
     *
     * @return $this
     */
    public function ask($question, $next, $additionalParameters = [])
    {
        parent::ask($this->transform($question), $next, $additionalParameters);

        return $this;
    }

    /**
     * @param Question|string $message
     * @param array $additionalParameters
     *
     * @return $this
     */
    public function say($message, $additionalParameters = [])
    {
        parent::say($this->transform($message), $additionalParameters);

        return $this;
    }

    /**
     * @param string|OutgoingTtsMessage $message
     *
     * @return OutgoingTtsMessage
     * @throws YAlisaException
     */
    protected function transform($message): OutgoingTtsMessage
    {
        if ($message instanceof OutgoingTtsMessage) {
            return $message;
        }

        if (is_string($message)) {
            return $this->createOutgoingTtsMessage($message, $message);
        }

        throw new YAlisaException('Class message "' . get_class($message) . '" not supported!');
    }

    /**
     * @param string $text
     * @param string $tts
     *
     * @return OutgoingTtsMessage
     */
    protected function createOutgoingTtsMessage(string $text, string $tts): OutgoingTtsMessage
    {
        return OutgoingTtsMessage::create($text, $tts);
    }
}
