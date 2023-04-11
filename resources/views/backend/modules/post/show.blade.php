@extends('backend.layouts.master')
@section('page_title', 'Publicações')
@section('page_sub_title', 'Detalhes')
@section('content')
<div class="row justify-content-center">
    <a href="{{ route('post.index')}}">
        <button class="btn btn-primary btn-sm mt-2">
            <i class="fa-solid fa-arrow-left fa-xl"></i> Voltar
        </button>
    </a>
    <br> <br>
    <br>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Publicações - Detalhes </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{$post->id}}</td>
                        </tr>

                        <tr>
                            <th>Titulo</th>
                            <td>{{$post->title}}</td>
                        </tr>

                        <tr>
                            <th>Tag(link)</th>
                            <td>{{$post->slug}}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{$post->status == 1 ? 'Ativo': 'Inativo'}}</td>
                        </tr>

                        <tr>
                            <th>Está Aprovado ? </th>
                            <td>{{$post->is_approved == 1 ? 'Aprovado': 'Não aprovado'}}</td>
                        </tr>

                        <tr>
                            <th>Descrição</th>
                            <td>{!!$post->description!!}</td>
                        </tr>

                        <tr>
                            <th>Admin Comentário</th>
                            <td>{{$post->admin_comment}}</td>
                        </tr>

                        <tr>
                            <th>Criado</th>
                            <td>{{$post->created_at->translatedFormat('l, d \d\e F, Y (h:m) ')}}</td>
                        </tr>

                        <tr>
                            <th>Editado</th>
                            <td>{{$post->created_at != $post->updated_at ? 
                            $post->updated_at->translatedFormat('l, d \d\e F, Y (h:m) ') : 'Não editado'}}</td>
                        </tr>

                        <tr>
                            <th>Deletado por</th>
                            <td>{{$post->deleted_at != $post->deleted_at ? 
                            $post->deleted_at->translatedFormat('l, d \d\e F, Y (h:m) ') : 'Não deletado'}}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <td>
                                <img class="img-thumbnail post_image" data-src="{{url('image/post/original/'.$post->photo)}}" src="{{url('image/post/thumbnail/'.$post->photo)}}" alt="{{$post->title}}">
                            </td>
                        </tr>
                        <tr> 
                        <th>Tags</th>
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
                    </tr>
                    </tbody>
                   
                </table>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Categorias Detalhes</h4>
                <table class="table table-striped table-bordered table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>{{$post->category?->id}}</th>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th> <a href="{{route('category.show', $post->category_id)}}">{{$post->category?->name}}</a></th>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <th>{{$post->category?->slug}}</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>{{$post->category?->status == 1 ? 'Ativado' : 'Inativo'}}</th>
                        </tr>
                        <tr>
                            <th>Data de Criação</th>
                            <th>{{$post->category?->created_at->translatedFormat('d/m/Y h:m')}}</th>
                        </tr>
                        <tr>
                            <th>Data de Edição</th>
                            <th>{{$post->category?->created_at != $post->category?->updated_at ? $post->category?->updated_at->translatedFormat('d/m/Y h:m') : 'Não editado'}}</th>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('category.show', $post->category)}}"><button class="btn-success btn-sm btn">Detalhes</button></a>

            
            </div>
        </div>
        <div class="card my-4">
            <div class="card-header">
                <h4 class="mb-0">Subcategorias Detalhes</h4>
                <table class="table table-striped table-bordered table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>{{$post->sub_category?->id}}</th>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th> <a href="{{route('sub-category.show', $post->sub_category_id)}}">{{$post->sub_category?->name}}</a></th>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <th>{{$post->sub_category?->slug}}</th>
                        </tr>
                       
                        <tr>
                            <th>Status</th>
                            <th>{{$post->sub_category?->status == 1 ? 'Ativado' : 'Inativo'}}</th>
                        </tr>
                        <tr>
                            <th>Data de Criação</th>
                            <th>{{$post->sub_category?->created_at->translatedFormat('d/m/Y h:m')}}</th>
                        </tr>
                        <tr>
                            <th>Data de Edição</th>
                            <th>{{$post->sub_category?->created_at != $post->sub_category?->updated_at ? $post->sub_category?->updated_at->translatedFormat('d/m/Y h:m') : 'Não editado'}}</th>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('sub-category.show', $post->sub_category->id)}}"><button class="btn-success btn-sm btn">Detalhes</button></a>
            
            </div>
        </div>
        <div class="card my-4">
            <div class="card-header">
                <h4 class="mb-0">Usuário Detalhes</h4>
                <table class="table table-striped table-bordered table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>{{$post->user?->id}}</th>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th>{{$post->user?->email}}</th>
                        </tr>
                   
                        <tr>
                            <th>E-mail</th>
                            <th>{{$post->user?->email}}</th>
                        </tr>
                        
                        <tr>
                            <th>Data de Criação</th>
                            <th>{{$post->user?->created_at->translatedFormat('d/m/Y h:m')}}</th>
                        </tr>
                        <tr>
                            <th>Data de Edição</th>
                            <th>{{$post->user?->created_at != $post->user?->updated_at ? $post->user?->updated_at->translatedFormat('d/m/Y h:m') : 'Não editado'}}</th>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('sub-category.show', $post->sub_category->id)}}"><button class="btn-success btn-sm btn">Detalhes</button></a>

            
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