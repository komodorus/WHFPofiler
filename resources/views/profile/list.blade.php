@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="listUsers" class="table table-striped table-borderless" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th>Ativo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday->format('d/m/Y') }}</td>
                            <td>{{ $user->cpf }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" {{ $user->active ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="#" data-target="#profileEditModal" data-toggle="modal" data-user="{{ json_encode($user) }}" class="btn btn-warning text-dark">Editar <i class="fa fa-pencil ml-2" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control" name="name" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="email">{{ __('Profile Picture') }}</label>
                <input id="picture" type="file" class="form-control" name="picture">
            </div>

            <div class="form-group">
                <label for="birthday">{{ __('Date of Birth') }}</label>
                <input id="birthday" type="text" class="form-control" name="birthday" required>
            </div>

            <div class="form-group">
                <label for="cpf">{{ __('CPF') }}</label>
                <input id="cpf" type="text" class="form-control" name="cpf" required>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Update') }}
                </button>
            </div>


        </form>

      </div>
    </div>
  </div>
</div>


                    


@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#profileEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var user = button.data('user')
            var modal = $(this)
            
            $('#editForm').attr('action', base_url + '/profile/' + user.id)

            $.each(user, function(index, value){
                var el = $('[name=' + index + ']');
                if(el.length && index != 'picture'){
                    $(el[0]).val(value)                
                }
            })
        })

        $('#listUsers').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            lengthMenu: [ [5, 15, 25, -1], [5, 15, 25, "Todos"] ],
            stateSave: true
        });

        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#birthday').mask('00/00/0000');

    });

    </script>
@endsection
