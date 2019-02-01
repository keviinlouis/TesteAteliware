@extends('layout')

@section('content')
    <div class="row justify-content-md-center mb-4 mt-3">
        <div class="card col col-md-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Buscar Repositorios</h5>
                <div class="card-text">
                    <form action="{{route('search')}}" method="POST">
                        @csrf
                        <div id="inputs">
                            @include('input')
                        </div>
                        <button class="btn btn-outline-info left" onclick="event.preventDefault();addInput()"
                                id="btn-add-language">
                            Adicionar Linguagem
                        </button>
                        <button class="btn btn-primary right">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="card col col-md-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Repositórios já encontrados</h5>
                <p class="card-text">
                <ul class="list-group">
                    @forelse($repositories as $repository)
                        <li class="list-group-item d-flex justify-content-between align-items-center"
                            style="cursor: pointer"
                            onclick="window.location.href = '{{route('show-repository', $repository->id)}}'">
                            {{$repository->name}} - {{$repository->query}}
                            <span class="badge badge-primary badge-pill">{{$repository->stars}}</span>
                        </li>

                    @empty
                        Busque algumas linguagens para ver os repositorios
                    @endforelse
                </ul>

                </p>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const inputHtml = '{!! $inputHtml !!}';
        const divElement = $('#inputs');
        const addInputButton = $('#btn-add-language');

        function addInput() {
            const countElements = getInputCount();

            if (countElements >= 4) {
                addInputButton.hide()
            }

            if (countElements >= 5) {
                return
            }


            divElement.append(inputHtml)

            checkRemoveInputButton();

        }

        function removeInput(element) {
            $(element).parent().parent().remove();

            const countElements = getInputCount();

            if (countElements <= 4) {
                addInputButton.show()
            }

            checkRemoveInputButton()
        }

        function getInputCount() {
            return divElement.children().length
        }

        function checkRemoveInputButton() {
            const inputs = $('.remove-input-button');
            const countElements = getInputCount();

            if (countElements > 1) {
                inputs.each((key, item) => $(item).show())
                return
            }

            inputs.each((key, item) => $(item).hide())
        }

    </script>

@endpush
