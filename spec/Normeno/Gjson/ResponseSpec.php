<?php

namespace spec\Normeno\Gjson;

use Normeno\Gjson\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }
}
