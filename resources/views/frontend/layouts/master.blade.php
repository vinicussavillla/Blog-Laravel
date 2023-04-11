<!DOCTYPE html>
<html lang="pt-br">

<head>
  @include('frontend.includes.head')
</head>

<body>

  @include('frontend.includes.preloader')

  <!-- Header -->
  @include('frontend.includes.nav')

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  @yield('banner')
  <!-- Banner Ends Here -->

  <section class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-content">
            <div class="row">
              <div class="col-lg-8">
                <div class="sidebar-item">
                  {!! Form::open(['method'=>'get', 'route'=> 'front.search' ]) !!}
                  <div class="input-group">
                    {!! Form::search('search', null, ['class'=>'form-control', 'placeholder'=> 'Pesquisar']) !!}
                    {!! Form::button('<i class="fa-solid fa-magnifying-glass"></i>',['class'=>'btn btn-success input-group-text ', 'type'=> 'Enviar']) !!}
                  </div>
                  {!! Form::close() !!}

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="blog-posts">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
      @include('frontend.includes.sidebar', ['blog'])
    </div>
    </div>
  </section>

  <!-- Footer -->
  @include('frontend.includes.footer')

  @include('frontend.includes.scripts')

</body>

</html>