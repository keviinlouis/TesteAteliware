<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 31/01/2019
 * Time: 21:25
 */

namespace App\Github;


use GuzzleHttp\Client;

class RequestApi
{
    const BASE_URL = 'https://api.github.com/search/repositories';
    const SORT = 'stargazers_count';
    const ORDER = 'desc';

    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function searchRepositories($search)
    {
        $response = $this->client->get(self::BASE_URL, ['query' => $this->buildQuery($search)]);

        $data = json_decode($response->getBody()->getContents());

        return new RepositoryResource(reset($data->items));
    }

    private function buildQuery($search): array
    {
        $query = [
             'q' => $search,
             'sort' => self::SORT,
             'order' => self::ORDER
        ];

        return $query;
    }
}
