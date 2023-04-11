{!! Form::label('name','Nome') !!}
{!! Form::text('name', null,['id'=>'name', 'class'=>'form-control', 'placeholder'=>
'Digite o nome da Tag']) !!}
<!--  -->
{!! Form::label('slug', 'URL', ['class'=>'mt-2']) !!}
{!! Form::text('slug', null,['id'=>'slug','class'=>'form-control', 'placeholder'=>
'Digite o nome da Tag Tag']) !!}
<!--  -->
{!! Form::label('order_by', 'Tag Serial', ['class'=>'mt-2']) !!}
{!! Form::number('order_by', null,['class'=>'form-control', 'placeholder'=>
'Digite o nome da Tag Serial']) !!}
<!--  -->
{!! Form::label('status', 'Tag Status', ['class'=>'mt-2']) !!}
{!! Form::select('status', [1=>'Ativo', 0=>'Inativo'], null, ['class'=>
'form-select', 'placeholder'=>'Selecione o status da Tag']) !!}


