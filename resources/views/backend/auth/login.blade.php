@extends('backend.auth.layouts.master')
@section('page_title', 'Login')
@section('content')
   {!! Form::open(['method'=>'post', 'route'=>'login']) !!}
   {!! Form::label('email', 'Email') !!}
   {!! Form::email('email', null, ['class'=>$errors->has('email') ? 'is-invalid form-control form-control-sm':
   'form-control form-control-sm']) !!}
   @error('email')
      <p class="text-danger">{{$message}}</p>
   @enderror
   {!! Form::label('password', 'Password', ['class' => 'mt-3'] ) !!}
   {!! Form::password('password', ['class'=>$errors->has('passoword') ? 'is-invalid form-control form-control-sm':'form-control form-control-sm']) !!}
   <div class="d-grid mt-4">
   {!! Form::button('Entrar', ['type'=>'submit', 'class' => 'btn btn-outline-info mt-2']) !!}
 </div>
   {!! Form::close() !!}
   <p class="mt-4"><a class="text-center" href="{{route('password.request')}}">Esqueci a senha</a></p>
   <p>Não tem cadastro ? <a href="{{route('register')}}">Cadastre-se</a></p>
@endsection