@extends('backend.layouts.master')
@section('page_title', 'Publicar')
@section('page_sub_title', 'Adicionar uma publicão +')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">

        <a href="{{ route('post.index')}}">
            <button class="btn btn-primary btn-sm mt-2">
                <i class="fa-solid fa-arrow-left fa-xl"></i>
                 Voltar
            </button>
        </a>
        <br>
        <br>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Criar uma publicação</h4>
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

                {!! Form::open(['method'=>'post', 'route'=>'post.store', 'files'=>true]) !!}
                @include('backend.modules.post.form')
                <div class="text-center content-between">
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