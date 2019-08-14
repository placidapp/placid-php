<?php

namespace Placid\Element;

class Text extends Element
{
    protected $payload = [
        'text' => null,
        'color' => null
    ];

    public function text($text)
    {
        $this->payload['text'] = $this->generateTextPayload($text);
        return $this;
    }

    public function color($hexcode)
    {
        $this->payload['color'] = $this->generateColorPayload($hexcode);
        return $this;
    }

    public function toArrayUrl()
    {
        return $this->payload["text"] ?: null;
    }
}
