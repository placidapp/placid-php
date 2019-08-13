<?php

namespace Placid\Element;

class Rectangle extends Element
{
    protected $payload = [
        'backgroundColor' => null
    ];

    public function backgroundColor($hexcode)
    {
        $this->payload['backgroundColor'] = $this->generateColorPayload(
            $hexcode
        );
    }
}
