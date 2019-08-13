<?php

namespace Placid;

class GeneratedImage
{
    private $imageUrl;
    private $id;
    private $status;

    public function __construct($id, $imageUrl, $status)
    {
        $this->id = $id;
        $this->imageUrl = $imageUrl;
        $this->status = $status;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
