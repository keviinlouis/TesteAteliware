@extends('layout')

@section('content')
    <div class="row justify-content-md-center mb-4 mt-3">
        <div class="card col col-md-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{route('home')}}" class="btn btn-outline-primary right">Voltar</a>
                    {{$repository->full_name}}
                </h5>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="card col col-md-5" style="width: 18rem;">
            <div class="card-body">
                <img src="{{$repository->avatar_url}}" class="card-img-top" alt="..." style="height: 50px;width: 50px; margin-left: 5px">
                {{$repository->owner_name}}
                <br>
                <br>
                {{$repository->description ?? 'Sem descrição'}}
                <br>
                <br>
                <b>Stars:</b> {{$repository->stars}}
                <br>
                <br>
                <b>Language:</b> {{$repository->language ?? 'Sem Linguagem'}}
            </div>
        </div>
    </div>
@endsection
