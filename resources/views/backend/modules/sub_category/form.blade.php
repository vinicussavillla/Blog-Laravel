{!! Form::label('name','Nome') !!}
{!! Form::text('name', null,['id'=>'name', 'class'=>'form-control', 'placeholder'=>
'Digite o nome da sub-categoria']) !!}
<!--  -->
{!! Form::label('slug', 'URL', ['class'=>'mt-2']) !!}
{!! Form::text('slug', null,['id'=>'slug','class'=>'form-control', 'placeholder'=>
'Digite o nome da sub-categoria Tag']) !!}
<!--  -->
{!! Form::label('category_id', 'Selecione a Categoria', ['class'=>'mt-2']) !!}
{!! Form::select('category_id', $categories, null, ['class'=>'form-select', 
'placeholder'=>'Selecione a Categoria']) !!}
<!--  -->
{!! Form::label('order_by', 'Categoria Serial', ['class'=>'mt-2']) !!}
{!! Form::number('order_by', null,['class'=>'form-control', 'placeholder'=>
'Digite o nome da categoria Serial']) !!}
<!--  -->
{!! Form::label('status', 'SubCategoria Status', ['class'=>'mt-2']) !!}
{!! Form::select('status', [1=>'Ativo', 0=>'Inativo'], null, ['class'=>
'form-select', 'placeholder'=>'Selecione o status da sub-categoria']) !!}


