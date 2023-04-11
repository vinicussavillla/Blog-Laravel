{!! Form::label('name','Nome') !!}
{!! Form::text('name', null,['id'=>'name', 'class'=>'form-control', 'placeholder'=>
'Digite o nome da categoria']) !!}
<!--  -->
{!! Form::label('slug', 'URL', ['class'=>'mt-2']) !!}
{!! Form::text('slug', null,['id'=>'slug','class'=>'form-control', 'placeholder'=>
'Digite o nome da categoria Tag']) !!}
<!--  -->
{!! Form::label('order_by', 'Categoria Serial', ['class'=>'mt-2']) !!}
{!! Form::number('order_by', null,['class'=>'form-control', 'placeholder'=>
'Digite o nome da categoria Serial']) !!}
<!--  -->
{!! Form::label('status', 'Categoria Status', ['class'=>'mt-2']) !!}
{!! Form::select('status', [1=>'Ativo', 0=>'Inativo'], null, ['class'=>
'form-select', 'placeholder'=>'Selecione o status da categoria']) !!}


