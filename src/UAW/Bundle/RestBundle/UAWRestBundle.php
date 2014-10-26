<?php

namespace UAW\Bundle\RestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UAWRestBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
