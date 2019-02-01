<?php

namespace App\Http\Controllers;

use App\Github\RequestApi;
use App\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $inputHtml = trim(view('input')->render());

        $repositories = Repository::orderByDesc('stars')->orderBy('name')->get();

        return view('home', ['inputHtml' => $inputHtml, 'repositories' => $repositories]);
    }

    public function showRepository(Repository $repository)
    {
        return view('show-repository', ['repository' => $repository]);
    }

    public function search(Request $request)
    {
        $githubApi = new RequestApi();
        $languages = array_filter($request->get('languages', []));

        foreach ($languages as $language) {
            $this->getRepositoryByLanguage($language, $githubApi);
        }

        return redirect()->route('home');

    }

    private function getRepositoryByLanguage($language, RequestApi $githubApi): ?Repository
    {
        $result = $githubApi->searchRepositories($language);
        if(!$result->exists()){
            return null;
        }

        $repository = Repository::whereQuery($language)->first();

        if(!$repository) {
            $body = $result->getBody();
            $body['query'] = $language;
            $repository = Repository::create($body);
        }

        if($repository->stars < $result->getStars()) {
            $repository->update($result->getBody());
        }

        return $repository;
    }
}
