<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 31/01/2019
 * Time: 21:25
 */

namespace App\Github;


class RepositoryResource
{
    private $body;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function exists(): bool
    {
        return !!$this->data;
    }

    public function getBody()
    {
        if(!$this->exists()){
            return [];
        }

        if(!$this->body) {
            $this->body = [
                'full_name' => $this->data->full_name,
                'name' => $this->data->name,
                'owner_name' => $this->data->owner->login,
                'description' => $this->data->description,
                'avatar_url' => $this->data->owner->avatar_url,
                'language' => $this->data->language,
                'stars' => $this->data->stargazers_count,
            ];
        }

        return $this->body;
    }

    public function getLanguage()
    {
        $body = $this->getBody();

        return $body['language'];
    }

    public function getStars()
    {
        $body = $this->getBody();

        return $body['stars'];
    }
}
