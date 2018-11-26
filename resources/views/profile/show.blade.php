@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card border-0">
                    <div class="card-img-top profile-picture" style="background-image: url('{{ $user->picture }}')">

                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nome</b><br> {{ $user->name }}</li>
                            <li class="list-group-item"><b>E-mail:</b><br> {{ $user->email }}</li>
                            <li class="list-group-item"><b>Data de Nascimento:</b><br> {{ $user->birthday->format('d/m/Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
