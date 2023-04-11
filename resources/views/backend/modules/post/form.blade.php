<!-- Titulo  -->
{!! Form::label('title','Titulo') !!}
{!! Form::text('title', null,['id'=>'title', 'class'=>'form-control', 'placeholder'=>
'Digite o titulo da publicação']) !!}

<!-- Slug  -->
{!! Form::label('slug', 'URL', ['class'=>'mt-2']) !!}
{!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>
'Digite o nome do publicação']) !!}

<!-- Status-->
{!! Form::label('status', 'Status da publicação', ['class'=>'mt-2']) !!}
{!! Form::select('status', [1=>'Ativa', 0=>'Inativa'], null, ['class'=>
'form-select', 'placeholder'=>'Selecione o status da publicação!']) !!}

<!-- Select All -->
<div class="row">
    <div class="col-md-6">
        <!-- Categorias -->
        {!! Form::label('category_id', 'Selecione a Categoria', ['class'=>'mt-2']) !!}
        {!! Form::select('category_id', $categories, null, ['id'=>'category_id', 'class'=>'form-select',
        'placeholder'=>'Selecione a categoria']) !!}
    </div>
    <div class="col-md-6">
        <!-- SubCategorias -->
        {!! Form::label('sub_category_id', 'Selecione a Subcategoria', ['class'=>'mt-2']) !!}
        <select name="sub_category_id" class="form-select {{ $errors->has('sub_category_id') ? 'is-invalid' : null}}" id="sub_category_id">
            '<option selected="selected">Selecione a subcategoria </option>'
        </select>
        @error('sub_category_id')
          <p class="text-danger">{{$message}}</p>
       @enderror
    </div>

</div>
<!-- Descrição -->
{!! Form::label('description', 'Descrição', ['class'=>'mt-2']) !!}
{!! Form::textarea('description', null, ['id'=>'description', 'class'=>'form-control',
'placeholder'=>'Descrição']) !!}

<!-- BEGIN Select Tag  -->
{!! Form::label('tag_id', 'Selecione as Tag', ['class'=>'mt-2']) !!}
<br />
<div class="row">
    @foreach ($tags as $tag )
    <div class="col-md-3">
        {!! Form::checkbox('tag_ids[]', $tag->id, in_array($tag->id, $selected_tags)  ) !!} <span>{{$tag->name}}</span>
    </div>
    @endforeach 
</div>
<!-- Select Tag END-->

<!-- Foto  -->
{!! Form::label('photo', 'Selecione a Foto', ['class'=>'mt-2']) !!}
{!! Form::file('photo', ['class'=>'form-control php']) !!}

<!-- Busca foto -->
@if(Route::currentRouteName() == 'post.edit')
<div class="my-3">
    <img class="img-thumbnail post_image" data-src="{{url('image/post/original/'.$post->photo)}}" src="{{url('image/post/thumbnail/'.$post->photo)}}" alt="{{$post->title}}">
</div>
@endif

@push('css')

<style>
    .ck.ck-editor__main>.ck-editor__editable {
        min-height: 250px;
    }
</style>

@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    /* Busca Subcategoria (select)   */
    const get_sub_categories = (category_id) => {
        let route_name = '{{Route::currentRouteName()}}'
        let sub_categories_element = $('#sub_category_id')
        sub_categories_element.empty()
        axios.get(window.location.origin + '/dashboard/get-subcategory/' + category_id).then(res => {
            sub_categories = res.data

            sub_categories.map((sub_category, index) => {
                let selected = ''
                if (route_name == 'post.edit') {
                    let sub_category_id = "{{$post->sub_category_id ?? null}}"
                    if ('' == sub_category.id) {
                        let selected = 'selected'
                    }
                }
                return sub_categories_element.append(`<option ${selected} value="${sub_category.id}">${sub_category.name}</li>`)
            })
        })
    }
    /* Busca descrição */
    ClassicEditor 
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });


    /* Busca categoria */
    $('#category_id').on('change', function() {
        let category_id = $('#category_id').val()
        get_sub_categories(category_id)
    });
    /* Busca titulo */
    $('#title').on('input', function() {
        let name = $(this).val()
        let slug = name.replaceAll(' ', '-')
        $('#slug').val(slug.toLowerCase());
    })
</script>
<!-- Busca subcategoria -->
@if(Route::currentRouteName() == 'post.edit')
<script>
    get_sub_categories('{{$post->category_id}}')
</script>
@endif

@endpush