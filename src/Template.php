<?php

namespace Placid;

use Exception;
use Placid\Element\Browserframe;
use Placid\Element\Picture;
use Placid\Element\Rectangle;
use Placid\Element\Text;
use function GuzzleHttp\Psr7\build_query;

class Template
{
    private $apiKey;
    private $successWebhook = null;
    private $uuid;
    private $fields = [];
    private $apiUrl = "http://placid.test/api/rest";

    public function __construct($uuid, $apiKey = null)
    {
        $this->uuid = $uuid;
        $this->fields = [];
        $this->apiKey = $apiKey;
    }

    public function successWebhook($webhook_url)
    {
        $this->successWebhook = $webhook_url;
    }

    public function elementPicture($string): Picture
    {
        return $this->fields[$string] = new Picture($string);
    }

    public function elementText($string): Text
    {
        return $this->fields[$string] = new Text($string);
    }

    public function elementRectangle($string): Rectangle
    {
        return $this->fields[$string] = new Rectangle($string);
    }

    public function elementBrowserframe($string): Browserframe
    {
        return $this->fields[$string] = new Browserframe($string);
    }

    /**
     * Create Image from Template; $createImageNow decides if it gets put into the queue or processed directly
     *
     * @param bool $createImageNow
     *
     * @return GeneratedImage
     * @throws Exception
     */
    public function image($createImageNow = false): GeneratedImage
    {
        $fields = [];
        foreach ($this->fields as $key => $field) {
            $fields[$key] = $field->toArray();
        }

        $payload = [
            'create_now' => $createImageNow,
            'webhook_success' => $this->successWebhook,
            'fields' => $fields
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl($this->uuid));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $headers = array();
        $headers[] = 'User-Agent: placidapp/placid-phpV0.1';
        $headers[] = 'Authorization: Bearer ' . $this->apiKey;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);

        $json = json_decode($result, true);

        return new GeneratedImage(
            $json['id'],
            $json['image_url'],
            $json['status']
        );
    }

    /**
     * Return configured Template as placid.app URL String - to be embedded as Image directly
     *
     * @return string
     * @throws Exception
     */
    public function toPlacidUrl(): string
    {
        $arr = [];
        foreach ($this->fields as $key => $field) {
            $fieldParam = $field->toArrayUrl();
            if (is_array($fieldParam)) {
                foreach ($fieldParam as $keyType => $value) {
                    $arr[$key . "|" . $keyType] = $value;
                }
            } elseif ($fieldParam) {
                $arr[$key] = $fieldParam;
            }
        }
        return "https://placid.app/u/" . $this->uuid . "?" . build_query($arr);
    }

    private function getRequestUrl($uuid)
    {
        return "{$this->apiUrl}/{$uuid}";
    }
}
