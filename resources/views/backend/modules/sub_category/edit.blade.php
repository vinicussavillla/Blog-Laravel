@extends('backend.layouts.master')
@section('page_title', 'Subcategoria')
@section('page_sub_title', 'Editar')
@section('content')
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
                <h4 class="mb-0">Editar Subcategoria</h4>
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



                {!! Form::model($subCategory, ['method' =>'put','route'=>
                ['sub-category.update', $subCategory->id]]) !!}

                @include('backend.modules.sub_category.form')
                <div class="text-center content-between">
                    {!! Form::button('<i class="fa-solid fa-edit"></i>  Ok ',['type'=>'submit', 'class'=>'delete btn btn-success btn-sm mt-2' ]) !!}

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