<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 31/01/2019
 * Time: 23:16
 */

namespace Tests\Feature;


use App\Repository;
use Illuminate\Http\Response;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testCanSeeRepositoryDetails()
    {
        $repository = Repository::inRandomOrder()->first();

        $response = $this->get('/repositorio/'.$repository->id);

        $response->assertStatus(200);

        $response->assertSeeText($repository->full_name);
        $response->assertSeeText($repository->onwer_name);
        $response->assertSeeText($repository->stars);
        $response->assertSeeText($repository->language);
        $response->assertSeeText($repository->description);
    }

    public function testCanSearchRepositories()
    {
        $langs = ['Javascript', 'PHP', 'Python', 'Ruby', 'Java'];

        $token = csrf_token();

        $response = $this->post('/', ['languages' => $langs, '_token' => $token]);

        $response->assertStatus(Response::HTTP_FOUND);

        $response = $this->get('/');

        foreach($langs as $lang){

            $response->assertSeeText($lang);
        }

        $repositories = Repository::whereIn('query', $langs)->get();

        $this->assertCount(5, $repositories);
    }
}
