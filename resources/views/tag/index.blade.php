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
                            <h4>Posts By Tag</h4>
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
                    <h2>Posts with tag «{{ $tag->title }}»:</h2>
                    <div class="all-blog-posts" style="margin-top: 20px;">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-6">
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
                                            <p>{{ $post->getPreviewContent(200) }}</p>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-lg-12">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Pagination -->
                            <div class="col-lg-12">
                                {{ $posts->links() }}
                            </div>
                            <!-- End Pagination -->
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
