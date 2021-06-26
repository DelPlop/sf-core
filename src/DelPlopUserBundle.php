<?php

namespace DelPlop\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DelPlopUserBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
