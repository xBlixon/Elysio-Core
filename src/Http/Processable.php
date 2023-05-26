<?php

namespace Elysio\Http;

interface Processable extends Routeable
{
    public function process(): Response;
}
