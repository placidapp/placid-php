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

    public function toArrayUrl()
    {
        return null;
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

    protected function buildImageUrl($image)
    {
        if (is_array($image)) {
            $imageSrc = $image["imageSrc"];

            $imageUrl = $image["imageUrl"];
            if ($imageSrc == "link") {
                $imageUrl = '$PIC$' . $imageUrl;
            }

            return $imageUrl;
        }
        return null;
    }
}
