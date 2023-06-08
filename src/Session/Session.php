<?php

namespace Elysio\Session;

class Session
{
    private ?string $flashMessage = NULL;

    public function __construct()
    {
        session_start();
        $this->flashMessage =& $_SESSION['_FLASH'];
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
