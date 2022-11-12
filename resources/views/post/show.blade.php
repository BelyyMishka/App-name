@extends('layouts.layout')

@section('title', $title)

@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post Details</h4>
                            <h2>Read Our Blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ asset("storage/{$post->image}") }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ $post->category->title }}</span>
                                        <h4>{{ $post->title }}</h4>
                                        <div style="display: inline-block;">

                                            @can('update', $post)
                                                <a href="{{ route('posts.edit', $post->slug) }}"
                                                   style="color: #F48840;"><i class="fa-solid fa-pencil"></i></a>
                                            @endcan

                                            @can('delete', $post)
                                                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                                                      class="float-left">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="delete btn btn-link btn-sm"
                                                            onclick="return confirm('Delete post?');"
                                                            style="color: #F48840;"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                            @endcan

                                        </div>
                                        <ul class="post-info">
                                            <li>{{ $post->user->name }}</li>
                                            <li>{{ $post->getDate() }}</li>
                                            <li>{{ views($post)->remember(3600)->count() }} Views</li>
                                        </ul>
                                        <p>{{ $post->content }}</p>
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
