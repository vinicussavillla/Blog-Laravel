@extends('backend.layouts.master')
@section('page_title', 'Categoria')
@section('page_sub_title', 'Lista')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-0">Categoria Lista</h4>
                     <a href="{{route('category.create')}}">
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
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Nome</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Serial</th>
                            <th>Criado</th>
                            <th>Editado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1 @endphp
                        @foreach ($categories as $category )
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->status == 1 ? 'Ativo': 'Inativo'}}</td>
                            <td>{{$category->order_by}}</td>
                            <td>{{$category->created_at->translatedFormat('d/m/Y  h:m')}}</td>
                            <td>{{$category->created_at != $category->updated_at ? 
                            $category->updated_at->translatedFormat('l, d \d\e F, Y (h:m) '): 'Não editado'}}</td>
                            <td>

                                <div class="d-flex justify-content-center">

                                    <a href="{{ route('category.show', $category->id)}}">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('category.edit', $category->id)}}">
                                        <button class="btn btn-warning btn-sm mx-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                    </a>
                                    {!! Form::open(['method' =>'delete','id'=>'form_'.$category->id
                                    ,'route'=> ['category.destroy', $category->id]]) !!}

                                    {!! Form::button('<i class="fa-solid fa-trash"></i>',
                                    ['type'=>'button', 'data-id'=> $category->id , 'class'=>'delete btn btn-danger btn-sm']) !!}

                                    {!! Form::close('') !!}

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if(session('msg'))
   @php 
   $cls = session('cls') =='danger' ? 'error' :  session('cls')
   @endphp
@push('js')
<script>
    Swal.fire({
        position: 'top-end',
        icon:  '{{$cls}}',
        toast: true,
        title: '{{ session("msg")}}',
        showConfirmButton: false,
        timer: 3000
    })
</script>

@endpush

@endif


@push('js')
<script>
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