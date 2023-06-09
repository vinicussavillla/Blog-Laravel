@extends('backend.layouts.master')
@section('page_title', 'Publicações')
@section('page_sub_title', 'Lista')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-0">Lista de Publicações</h4>
                    <a href="{{route('post.create')}}">
                        <button class="btn btn-success btn-sm">
                            <i class="fa-solid fa-plus"></i>
                            CRIAR
                        </button>

                    </a>
                </div>

            </div>

            <div class="card-body">
                <!--    @if(session('msg'))
                <div class="alert alert-{{session('cls')}}">
                    {{ session('msg') }}
                </div>
                @endif -->
                <table class="table table-striped table-bordered table-hover post-table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th class="align-middle">
                                <p>Title</p>
                                <hr />
                                <p>URL</p>
                            </th>
                            <th>
                                <p>Categoria</p>
                                <hr />
                                <p>SubCategoria</p>
                            </th>
                            <th>
                                <p>Status</p>
                                <hr />
                                <p>Está Aprovado</p>
                            </th>
                            <th>Foto</th>
                            <th>Tags</th>

                            <th>
                                <p>Criado em </p>
                                <hr />
                                <p>Atualizado em </p>
                                <hr />
                                <p>Criado por </p>
                            </th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1 @endphp
                        @foreach ($posts as $post )
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>
                                <p>{{$post->title}}</p>
                                <hr />
                                <p>{{$post->slug}}</p>
                            </td>
                            <td>
                                <p><a href="{{route('category.show', $post->category_id)}}">{{$post->category?->name}}</a></p>
                                <hr />
                                <p><a href="{{route('sub-category.show', $post->sub_category_id) }}">{{$post->sub_category?->name}}</a></p>
                            </td>
                            <td>
                                <p>{{$post->status == 1 ? 'Publicado' : 'Não publicado'}}</p>
                                <hr />
                                <p>{{$post->is_approved == 1 ? 'Aprovado' : 'Não aprovado'}}</p>
                            </td>
                            <td>
                                <img class="img-thumbnail post_image" data-src="{{url('image/post/original/'.$post->photo)}}" src="{{url('image/post/thumbnail/'.$post->photo)}}" alt="{{$post->title}}">
                            </td>

                            <td>
                                @php
                                $classes = ['btn-success', 'btn-info', 'btn-danger', 'btn-warning', 'btn-dark']
                                @endphp
                                @foreach ($post->tag as $tag)
                                <a href="{{route('tag.show', $tag->id)}}">
                                    <button class="btn btn-sm {{ $classes[random_int(0,4)] }} mb-1">
                                        {{$tag->name}}
                                    </button>
                                </a>
                                @endforeach
                            </td>
                            <td>
                                <p>{{$post->created_at->translatedFormat('d/m/Y h:m')}}</p>
                                <hr />
                                <p>{{$post->created_at != $post->updated_at ? 
                                 $post->updated_at->translatedFormat('l, d \d\e F, Y (h:m) '): 'Não editado'}}
                                </p>
                                <hr />
                                <p>{{$post->user?->name}}
                            </td>

                            <td>

                                <div class="d-flex justify-content-center">

                                    <a href="{{ route('post.show', $post->id)}}">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('post.edit', $post->id)}}">
                                        <button class="btn btn-warning btn-sm mx-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                    </a>
                                    {!! Form::open(['method' =>'delete','id'=>'form_'.$post->id
                                    ,'route'=> ['post.destroy', $post->id]]) !!}

                                    {!! Form::button('<i class="fa-solid fa-trash"></i>',
                                    ['type'=>'button', 'data-id'=> $post->id , 'class'=>'delete btn btn-danger btn-sm']) !!}

                                    {!! Form::close('') !!}

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $posts->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button id="image_show_button" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show">
        Launch static backdrop modal
    </button>
    <!-- Modal -->
    <div class="modal fade" id="image_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-thumbnail" alt="Display Image" id="display_image" />
                </div>
            </div>
        </div>
    </div>
    @if(session('msg'))
    @php
    $cls = session('cls') =='danger' ? 'error' : session('cls')
    @endphp
    @push('js')
    <script>
        Swal.fire({
            position: 'top-end',
            icon: '{{$cls}}',
            toast: true,
            title: '{{ session("msg") }}',
            showConfirmButton: false,
            timer: 3000
        })
    </script>

    @endpush

    @endif


    @push('js')
    <script>
        $('.post_image').on('click', function() {
            let img = $(this).attr('data-src');
            $('#display_image').attr('src', img);
            $('#image_show_button').trigger('click');
        })

        $('.delete').on('click', function() {
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Tem certeza que deseja Excluir?',
                text: "Você não será capaz de reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Não'

            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#form_${id}`).submit()
                }
            })

        });

        /*   $('#name').on('input', function() {
              let name = $(this).val()
              let slug = name.replaceAll(' ', '-')
              $('#slug').val(slug.toLowerCase());
          }) */
    </script>
    @endpush




    @endsection