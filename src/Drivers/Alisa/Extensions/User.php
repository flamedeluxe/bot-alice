<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 10.02.19
 * Time: 20:02
 */

namespace BotMan\Drivers\YAlisa\Extensions;

use BotMan\BotMan\Interfaces\UserInterface;

/**
 * Class User
 *
 * @package BotMan\Drivers\YAlisa\Extensions
 */
class User implements UserInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $info;

    /**
     * User constructor.
     *
     * @param string $id
     * @param array $info
     */
    public function __construct(string $id, array $info = [])
    {
        $this->id = $id;
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getUsername(): ?string
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return null;
    }

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }
}
