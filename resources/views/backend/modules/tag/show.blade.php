@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Detalhes')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tag - Detalhes </h4>
            </div>
            <div class="card-body">
              <table class="table table-striped table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$tag->id}}</td>
                     </tr>

                     <tr>
                        <th>Nome</th>
                        <td>{{$tag->name}}</td>
                     </tr>

                     <tr>
                        <th>URL</th>
                        <td>{{$tag->slug}}</td>
                     </tr>

                     <tr>
                        <th>Status</th>
                        <td>{{$tag->status == 1 ? 'Ativo': 'Inativo'}}</td>
                     </tr>

                     <tr>
                        <th>Order By</th>
                        <td>{{$tag->order_by}}</td>
                     </tr>

                     <tr>
                        <th>Criado</th>
                        <td>{{$tag->created_at->toDayDateTimeString()}}</td>
                     </tr>

                     <tr>
                        <th>Editado</th>
                        <td>{{$tag->created_at != $tag->updated_at ? 
                            $tag->updated_at->toDayDateTimeString() : 'Não editado'}}</td>
                     </tr>
                  
                </tbody>
         
                <a href="{{ route('tag.index')}}">
                 <button class="btn btn-primary btn-sm mt-2">
                 <i class="fa-solid fa-arrow-left fa-xl"></i> Voltar                
                </button>
                </a>
                <br> <br>      
              </table>
             
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