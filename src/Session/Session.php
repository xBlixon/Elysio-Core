<?php

namespace Velsym\Session;

class Session
{
    private static ?Session $instance = NULL;
    private ?string $flashMessage = NULL;

    private function __construct()
    {
        session_start();
        $this->flashMessage =& $_SESSION['_FLASH'];
    }

    public static function getInstance(): Session
    {
        if (self::$instance == NULL)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getFlash(): ?string
    {
        $message = $this->flashMessage ?? NULL;
        unset($_SESSION['_FLASH']);
        return $message;
    }

    public function setFlash(?string $flashMessage): void
    {
        $this->flashMessage = $flashMessage;
    }

}
