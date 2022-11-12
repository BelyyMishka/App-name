@extends('layouts.layout')

@section('title', $title)

@section('content')
    <!-- Page Content -->
    <!-- Carousel Starts Here -->
    @include('sections.carousel')
    <!-- Carousel Ends Here -->

    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ asset("storage/{$post->image}") }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <span>{{ $post->category->title }}</span>
                                            <a href="{{ route('posts.show', $post->slug) }}"><h4>{{ $post->title }}</h4></a>
                                            <ul class="post-info">
                                                <li>{{ $post->user->name }}</li>
                                                <li>{{ $post->getDate() }}</li>
                                                <li>{{ views($post)->remember(3600)->count() }} Views</li>
                                            </ul>
                                            <p>{{ $post->getPreviewContent() }}</p>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="post-tags">
                                                            @if($post->tags->count() != 0)
                                                                <li><i class="fa fa-tags"></i></li>
                                                            @endif

                                                            @foreach($post->getTags() as $tagId => $tagTitle)
                                                                @if($tagId === array_key_last($post->getTags()))
                                                                    <li>{{ $tagTitle }}</li>
                                                                @else
                                                                    <li>{{ $tagTitle }},</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="post-share">
                                                            <li><i class="fa fa-share-alt"></i></li>
                                                            <li><a href="#">Facebook</a>,</li>
                                                            <li><a href="#"> Twitter</a>,</li>
                                                            <li><a href="#"> Instagram</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12">
                                <div class="main-button">
                                    <a href="{{ route('posts.index') }}">View All Posts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('sections.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
