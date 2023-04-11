@extends('frontend.layouts.master')
@section('page_title', 'Programação 3.0')
@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Post Details</h4>
                        <h2>Single blog post</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('content')
<div class="col-lg-12">
    <div class="blog-post">
        <div class="blog-thumb">
            <img src="{{url('image/post/original/'.$post->photo)}}" alt="">
        </div>
        <div class="down-content">
            <span>{{$post->category?->name}} <sub class="text-warning">{{$post->sub_category?->name}}</sub></span>
            <a href="{{route('front.single', $post->slug) }}">
                <h4>{{$post->title}}</h4>
            </a>
            <ul class="post-info">
                <li><a href="#">{{$post->user?->name}}Admin</a></li>
                <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
                <li><a href="#">12 Comments</a></li>
            </ul>
            <div class="post-description">
                <p>
                    {!! $post->description !!}
                 </p>
            </div>

            <div class="post-options">
                <div class="row">
                    <div class="col-6">
                        <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            @foreach($post->tag as $tag)
                            <li><a href="{{route('front.tag', $tag->slug)}}">{{$tag->name}}</a>,</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#"> Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="sidebar-item comments">
        <div class="sidebar-heading">
            <h2>4 comments</h2>
        </div>
        <div class="content">
            <ul>
                <li>
                    <div class="author-thumb">
                        <img src="{{asset('frontend/assets/images/comment-author-01.jpg')}}" alt="">
                    </div>
                    <div class="right-content">
                        <h4>Charles Kate<span>May 16, 2020</span></h4>
                        <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo. Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus convallis eleifend posuere id tellus.</p>
                    </div>
                </li>
                <li class="replied">
                    <div class="author-thumb">
                        <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
                    </div>
                    <div class="right-content">
                        <h4>Thirteen Man<span>May 20, 2020</span></h4>
                        <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
                    </div>
                </li>
                <li>
                    <div class="author-thumb">
                        <img src="{{asset('frontend/assets/images/comment-author-03.jpg')}}" alt="">
                    </div>
                    <div class="right-content">
                        <h4>Belisimo Mama<span>May 16, 2020</span></h4>
                        <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis ac, molestie nibh.</p>
                    </div>
                </li>
                <li class="replied">
                    <div class="author-thumb">
                        <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
                    </div>
                    <div class="right-content">
                        <h4>Thirteen Man<span>May 22, 2020</span></h4>
                        <p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="sidebar-item submit-comment">
        <div class="sidebar-heading">
            <h2>Your comment</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route('comment.store') }}">
                        @csrf
                        <input type="hidden" value="{{$post->id}}" name="post_id">
                        <textarea name="comment" rows="6" placeholder="Digite seu comentário"></textarea>
                        <button type="submit" class="main-button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection