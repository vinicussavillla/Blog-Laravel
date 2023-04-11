@extends('backend.auth.layouts.master')
@section('page_title', 'Redefinir Senha')
@section('content')
   {!! Form::open(['method'=>'post', 'route'=>'password.store']) !!}
   {!! Form::label('email', 'E-mail') !!}
   {!! Form::email('email', $request->email, ['class'=>$errors->has('email') ? 'is-invalid form-control form-control-sm':
      'form-control form-control-sm']) !!}
   @error('email')
      <p class="text-danger">{{$message}}</p> 
   @enderror

   <!-- Password Reset Token -->
   {!! Form::hidden('token', $request->route('token')) !!}
   
   {!! Form::label('password', 'Senha', ['class' => 'mt-3'] ) !!}
   {!! Form::password('password', ['class'=>$errors->has('passoword') ? 
      'is-invalid form-control form-control-sm': 'form-control form-control-sm']) !!}
   @error('password')
      <p class="text-danger">{{$message}}</p> 
   @enderror
   {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'mt-3'] ) !!}
   {!! Form::password('password_confirmation', ['class'=>$errors->has('password_confirmation') ? 
      'is-invalid form-control form-control-sm': 'form-control form-control-sm']) !!}
   <div class="d-grid mt-4">
        {!! Form::button('Atualizar Senha', ['type'=>'submit', 'class' => 'btn btn-outline-info mt-2']) !!}
   </div>
   {!! Form::close() !!}
   <p class="mt-4">Você já tem uma conta? <a class="text-center" href="{{route('login')}}">Entrar</a></p>
   <p>Não tem cadastro ? <a href="{{route('register')}}">Cadastra-se</a></p>
@endsection