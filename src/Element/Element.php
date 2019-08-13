<?php

namespace Placid\Element;

use Illuminate\Contracts\Support\Arrayable;

abstract class Element implements Arrayable
{
    protected $payload;

    public function toArray()
    {
        return $this->payload;
    }

    protected function generateTextPayload($text)
    {
        return $text;
    }

    protected function generateColorPayload($hex)
    {
        return [
            'hex' => $hex
        ];
    }

    protected function generateImagePayload($type, $website_url)
    {
        return [
            'imageSrc' => $type,
            'imageUrl' => $website_url
        ];
    }
}
