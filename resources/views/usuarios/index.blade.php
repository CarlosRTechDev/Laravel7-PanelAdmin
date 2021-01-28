@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Lista de usuarios 
        <a href="usuarios/create">
            <button type="button" class="btn btn-success float-right">Agregar usuario</button>
        </a> 
    </h2>
    {{-- Si existe el nombre a buscar se mostrará el h6 --}}
    @if($search)
    <h6>
        <div class="alert alert-primary" role="alert">
            Los resultados para tu busqueda '{{ $search }}' son:
        </div>
    </h6>
    @endif

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Imagen</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            {{-- $users viene del controlador --}}
        @foreach ($users as $user)  
        {{-- @include('usuarios.modal-delete') --}}
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>
                <img src="{{ asset('imagenes/'.$user->imagen) }}" alt="{{ $user->imagen }}" height="35px" width="35px">
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach ($user->roles as $role)
                    {{ $role->name }}
                @endforeach
            </td>
            <td>
                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                    <a href="{{ route('usuarios.show', $user->id) }}"><button type="button" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></button></a>
                    <a href="{{ route('usuarios.edit', $user->id) }}"><button type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    {{-- <button type="button" class="btn btn-danger btn-sm" data-target="#modalEliminar-{{ $user->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i></button> --}}
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    
    {{-- paginador --}}
    <div class="row">
        <div class="mx-auto">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection