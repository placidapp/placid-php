<?php

namespace Placid\Element;

class Picture extends Element
{
    protected $payload = [
        'image' => null
    ];

    public function imageFromWebsite($website_url)
    {
        $this->payload['image'] = $this->generateImagePayload(
            "website",
            $website_url
        );
        return $this;
    }

    public function imageFromUrl($website_url)
    {
        $this->payload['image'] = $this->generateImagePayload(
            "link",
            $website_url
        );
        return $this;
    }

    public function toArrayUrl()
    {
        return $this->buildImageUrl($this->payload["image"]);
    }
}
