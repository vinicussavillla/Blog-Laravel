@extends('backend.auth.layouts.master')
@section('page_title', 'Cadastro')
@section('content')
   {!! Form::open(['method'=>'post', 'route'=>'register']) !!}
   {!! Form::label('name', 'Name') !!}
   {!! Form::text('name', null, ['class'=>$errors->has('name') ? 
      'is-invalid form-control form-control-sm': 'form-control form-control-sm']) !!}
   @error('name')
      <p class="text-danger">{{$message}}</p> 
   @enderror
   {!! Form::label('email', 'E-mail', ['class' => 'mt-3']) !!}
   {!! Form::email('email', null, ['class'=>$errors->has('email') ? 
      'is-invalid form-control form-control-sm':'form-control form-control-sm']) !!}
   @error('email')
      <p class="text-danger">{{$message}}</p> 
   @enderror
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
        {!! Form::button('Cadastrar', ['type'=>'submit', 'class' => 'btn btn-outline-info mt-2']) !!}
   </div>
   {!! Form::close() !!}
   <p class="mt-4">você tem uma conta?  <a href="{{route('login')}}"> Entrar</a></p>
@endsection