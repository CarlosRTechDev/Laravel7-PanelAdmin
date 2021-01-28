@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Editar usuario</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            {{-- @method: directiva de laravel para actualizar datos directamente con el metodo update --}}
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Escribe tu email">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Contraseña <span class="small">(Opcional)</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                </div>
                <div class="form-group col-md-6">
                    <label>Confirmar Contraseña <span class="small">(Opcional)</span></label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme Contraseña">
                </div>
            </div>
                
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Rol</label>
                    <select name="userRol" class="form-control">
                        <option selected disabled>Elige un rol para el usuario...</option>
                        @foreach ($roles as $role)
                            @if($role->name == str_replace(array('["', '"]'), '', $user->tieneRol()))
                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @else
                                <option value="{{ $role->id }}">{{ $role->name }}</option>    
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Foto de perfil</label>
                    <input type="file" name="imagen" class="form-control">
                    @if($user->imagen != "")
                        <img src="{{ asset('imagenes/'.$user->imagen) }}" alt="{{ $user->imagen }}" height="35px" width="35px">
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </form>
    </div>

@endsection