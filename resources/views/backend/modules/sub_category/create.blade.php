@extends('backend.layouts.master')
@section('page_title', 'SubCategoria')
@section('page_sub_title', 'Criar +')
@section('content')
<style>
.titulo{
    text-align: center;
}
</style>
<div class="row justify-content-center">
    <div class="col-md-6">

        <a href="{{ route('sub-category.index')}}">
            <button class="btn btn-primary btn-sm mt-2">
                <i class="fa-solid fa-arrow-left fa-xl"></i> Voltar
            </button>
        </a>
        <br>
        <br>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 titulo">Criar Subcategoria</h4>
            </div>
            <div class="card-body">

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open(['method'=>'post', 'route'=>'sub-category.store']) !!}
                @include('backend.modules.sub_category.form')
                <div class="text-center content-between">
<!--                     {!! Form::button('Criar', ['type'=>'submit','class'=>'btn btn-success mt-2']) !!}
 -->
                    {!! Form::button('<i class="fa-solid fa-check"></i>  ADICIONAR',['type'=>'submit', 'class'=>'delete btn btn-success btn-sm mt-2' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $('#name').on('input', function() {
        let name = $(this).val()
        let slug = name.replaceAll(' ', '-')
        $('#slug').val(slug.toLowerCase());
    })
</script>
@endpush

@endsection