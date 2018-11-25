@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            @foreach ($users as $user)
                <div class="card my-3">
                    <div class="card-body">
                        <ul>
                            <li>Nome: {{ $user->name }}</li>
                            <li>E-mail: {{ $user->email }}</li>
                            <li>CPF: {{ $user->cpf }}</li>
                            <li>Data de Nascimento: {{ $user->birthday->format('d/m/Y') }}</li>
                            <li>Criado: {{ $user->created_at->format('d/m/Y') }}</li>
                            <li>Editado: {{ $user->updated_at->format('d/m/Y') }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
