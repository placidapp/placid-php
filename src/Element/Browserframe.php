<?php

namespace Placid\Element;

class Browserframe extends Element
{
    protected $payload = [
        'url' => null, // - text field
        'image' => null // - image field
    ];

    public function url($text)
    {
        $this->payload['url'] = $this->generateTextPayload($text);
        return $this;
    }

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
        $fields = [];
        $url = $this->payload["url"];
        if ($url) {
            $fields["url"] = $this->payload["url"];
        }
        $image = $this->payload["image"];
        if ($image) {
            $fields["image"] = $this->buildImageUrl($image);
        }
        return $fields;
    }
}
