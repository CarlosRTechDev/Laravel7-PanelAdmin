@extends('layouts.app')

@section('content')

{{-- metodo PATCH sirve cuando se actualizan datos en laravel --}}
{!! Form::open(['action' => ['NotasController@update', $nota->id], 'method' => 'PATCH']) !!}
{{ Form::token() }}
<div class="card text-center mx-auto" style="width: 250px;">
    <div class="card-header">
      <input type="text" name="tituloN" class="form-control" value="{{ $nota->titulo }}">
    </div>
    <div class="card-body">
      <textarea name="textoN" class="form-control" rows="6" id="" >{{ $nota->texto }}</textarea>
    </div>
    <div class="card-footer text-muted small">
        {{ $nota->update_at }}

        <a href="{{ URL::action('NotasController@index') }}">
            <button type="submit" class="btn btn-danger btn-sm float-right">
                <i class="far fa-window-close"></i>
            </button>
        </a>
        <a href="{{ URL::action('NotasController@edit', $nota->id) }}">
            <button type="submit" class="btn btn-primary btn-sm float-right mr-1">
                <i class="far fa-save"></i>
            </button>
        </a>
    </div>
</div>
{!! Form::close() !!}

@endsection