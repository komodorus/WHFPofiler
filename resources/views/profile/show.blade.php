@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0">
                <img class="card-img-top img-fluid rounded-circle w-50 mx-auto my-3" src="https://via.placeholder.com/350x350" alt="Card image cap">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Nome</b><br> {{ $user->name }}</li>
                        <li class="list-group-item"><b>E-mail:</b><br> {{ $user->email }}</li>
                        <li class="list-group-item"><b>CPF:</b><br> {{ $user->cpf }}</li>
                        <li class="list-group-item"><b>Data de Nascimento:</b><br> {{ $user->birthday->format('d/m/Y') }}</li>
                        <li class="list-group-item"><b>Criado:</b><br> {{ $user->created_at->format('d/m/Y') }}</li>
                        <li class="list-group-item"><b>Editado:</b><br> {{ $user->updated_at->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
