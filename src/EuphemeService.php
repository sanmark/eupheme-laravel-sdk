<?php

namespace Sanmark\EuphemeLaravelSdk;


use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Sanmark\EuphemeLaravelSdk\Models\Comment;

class EuphemeService
{
    private $instance;

    public function __construct($instance)
    {
        if (is_null($instance)) {
            $instance = config('eupheme-laravel-sdk.default');
        }
        $this->instance = $instance;
    }

    public function getComments($extRef)
    {
        try {
            $url = $this->getEuphemeUrl("ref/{$extRef}");

            $requestResult = $this->getRequestResult('GET', $url);

            $data = array_map([$this, 'transcode'], $requestResult);

            return $data;
        } catch (GuzzleException $e) {
            return null;
        }

    }

    private function getEuphemeUrl($string)
    {
        $baseUrl = config("eupheme-laravel-sdk.instances.{$this->instance}.base_url");
        return rtrim($baseUrl, '/') . '/api/' . trim($string, '/');
    }

    private function getRequestResult($method, $url, $formData = [])
    {
        $client = new \GuzzleHttp\Client();
        $options = $this->getOptions($formData);
        $res = $client->request($method, $url, $options);

        $data = json_decode($res->getBody());
        return $data->payload;
    }

    private function getOptions($formData=[])
    {
        $options = [];
        $options['headers']['x-lk-sanmark-eupheme-app-key'] = config("eupheme-laravel-sdk.instances.{$this->instance}.app_key");
        $options['headers']['x-lk-sanmark-eupheme-app-secret-hash'] = config("eupheme-laravel-sdk.instances.{$this->instance}.app_hash");
        $options['form_params'] = $formData;
        return $options;
    }

    public function transcode($comment)
    {
        $model = new Comment();
        $model->id = $comment->id;
        $model->text = $comment->text;
        $model->parentID = $comment->parentID;
        $model->extRef = $comment->extRef;
        $model->userID = $comment->userID;
        $model -> status = $comment->status;
        $model->createdAt = Carbon::parse($comment->createdAt->date);
        $model->updatedAt = Carbon::parse($comment->updatedAt->date);
        $model->children = array_map([$this, 'transcode'], $comment->children);
        return $model;
    }

    public function saveComment($data)
    {
        $url = $this->getEuphemeUrl('/comments');

        $comment =  $this->getRequestResult('POST', $url, $data);

        return $this->transcode($comment);
    }

}