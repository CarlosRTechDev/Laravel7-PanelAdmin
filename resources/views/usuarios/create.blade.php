@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <h2>Crear nuevo usuario</h2>
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
    {{-- enctype="multipart/form-data" sirve para subir archivos como imagenes, pdf, etc--}}
    <form action="/usuarios" method="POST" enctype="multipart/form-data">
        {{-- esto es un token: @csrf, el formulario lo necesita--}}
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Escribe tu email">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
            <div class="form-group col-md-6">
                <label>Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme Contraseña">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-6">
                <label>Rol</label>
                <select name="userRol" class="form-control">
                    <option selected disabled>Elige un rol para el usuario...</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>    
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Foto de perfil</label>
                <input type="file" name="imagen" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        </div>
    </form>
</div>

@endsection