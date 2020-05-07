<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 10.02.19
 * Time: 19:19
 */

namespace BotMan\Drivers\YAlisa;

use BotMan\BotMan\Drivers\Events\GenericEvent;
use BotMan\BotMan\Drivers\HttpDriver;
use BotMan\BotMan\Interfaces\UserInterface;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\YAlisa\Exceptions\YAlisaException;
use BotMan\Drivers\YAlisa\Extensions\User;
use BotMan\Drivers\YAlisa\Messages\Outgoing\OutgoingTtsMessage;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class YAlisaDriver
 *
 * @package BotMan\Drivers\YAlisa
 */
class YAlisaDriver extends HttpDriver
{
    const DRIVER_NAME = 'YAlisa';

    const EVENT_LAUNCH = 'launch';

    const TYPE_SIMPLE_UTTERANCE = 'SimpleUtterance';
    const TYPE_BUTTON_PRESSED = 'ButtonPressed';

    const VERSION = '1.0';

    /**
     * @var Collection
     */
    protected $meta;

    /**
     * @var Collection
     */
    protected $request;

    /**
     * @var Collection
     */
    protected $session;

    /**
     * @var string
     */
    protected $version;

    /**
     * @param Request $request
     */
    public function buildPayload(Request $request)
    {
        $this->payload = Collection::make(json_decode($this->getContent(), true));

        $this->meta = Collection::make($this->payload->get('meta'));
        $this->request = Collection::make($this->payload->get('request'));
        $this->session = Collection::make($this->payload->get('session'));
        $this->version = $this->payload->get('version');

        $this->config = Collection::make($this->getConfig()->get('y-alisa', []));
    }

    /**
     * @param IncomingMessage $matchingMessage
     *
     * @return UserInterface
     */
    public function getUser(IncomingMessage $matchingMessage): UserInterface
    {
        return new User($matchingMessage->getSender(), [
            'session_id' => $this->session->get('session_id'),
            'message_id' => $this->session->get('message_id'),
            'user_id' => $this->session->get('user_id'),
        ]);
    }

    /**
     * @return bool
     */
    public function matchesRequest(): bool
    {
        return $this->meta->isNotEmpty() && $this->request->isNotEmpty() && $this->session->isNotEmpty() && $this->version === static::VERSION;
    }

    /**
     * @param IncomingMessage $message
     *
     * @return Answer
     */
    public function getConversationAnswer(IncomingMessage $message): Answer
    {
        $interactive = $this->request->get('type') === static::TYPE_BUTTON_PRESSED ? true : false;

        return Answer::create($message->getText())
            ->setValue($message->getText())
            ->setMessage($message)
            ->setInteractiveReply($interactive);
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        $message = $this->request->get('command');
        $sender = $this->meta->get('client_id');
        $recipient = $this->session->get('user_id');

        $incomingMessage = new IncomingMessage($message, $sender, $recipient, $this->payload);

        return [
            $incomingMessage,
        ];
    }

    /**
     * @return bool|GenericEvent
     */
    public function hasMatchingEvent()
    {
        $command = $this->request->get('command');

        if (empty($command)) {
            $event = new GenericEvent($this->payload);
            $event->setName(static::EVENT_LAUNCH);

            return $event;
        }

        return false;
    }

    /**
     * @param Question|string $message
     * @param IncomingMessage $matchingMessage
     * @param array $additionalParameters
     *
     * @return Collection
     * @throws YAlisaException
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = []): Collection
    {
        $parameters = Collection::make($additionalParameters);

        if (!$message instanceof OutgoingTtsMessage) {
            throw new YAlisaException('Only class "' . OutgoingTtsMessage::class . '" messages are supported!');
        }

        return $parameters->merge([
            'response' => [
                'text' => $message->getText(),
                'tts' => $message->getTts(),
                'card' => $message->getCard(),
                'buttons' => $message->getButtons(),
                'end_session' => $message->getEndSession(),
            ],
            'session' => [
                'session_id' => $this->session->get('session_id'),
                'message_id' => $this->session->get('message_id'),
                'user_id' => $this->session->get('user_id'),
            ],
            'version' => static::VERSION,
        ]);
    }

    /**
     * @param mixed $payload
     *
     * @return Response
     */
    public function sendPayload($payload): Response
    {
        if (!$payload instanceof Collection) {
            $payload = Collection::make($payload);
        }

        return JsonResponse::create($payload->toArray())->send();
    }

    /**
     * @return bool
     */
    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @param IncomingMessage $matchingMessage
     */
    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
        // Do nothing.
    }
}
