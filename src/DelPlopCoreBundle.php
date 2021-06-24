<?php

namespace DelPlop\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DelPlopCoreBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
