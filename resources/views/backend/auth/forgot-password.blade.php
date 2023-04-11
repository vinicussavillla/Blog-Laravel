@extends('backend.auth.layouts.master')
@section('page_title', 'Redefinir Senha')
@section('content')
   {!! Form::open(['method'=>'post', 'route'=>'password.email']) !!}
   {!! Form::label('email', 'Email') !!}
   {!! Form::email('email', null, ['class'=>$errors->has('email') ? 'is-invalid form-control form-control-sm':
      'form-control form-control-sm']) !!}
   @error('email')
      <p class="text-danger">{{$message}}</p> 
   @enderror
   <div class="d-grid mt-4">
        {!! Form::button('Redefinir Senha', ['type'=>'submit', 'class' => 'btn btn-outline-info mt-2']) !!}
   </div>
   {!! Form::close() !!}
   <p class="mt-4">Você já tem uma conta? <a class="text-center" href="{{route('login')}}">Entrar</a></p>
   <p>Não tem cadastro ? <a href="{{route('register')}}">Cadastra-se</a></p>
@endsection