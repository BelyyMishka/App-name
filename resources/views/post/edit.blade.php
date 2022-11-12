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
                            <h4>Edit Post</h4>
                            <h2>Read Our Blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Banner Ends Here -->

    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="sidebar-item contact-form">
                                    <div class="sidebar-heading">
                                        <h2>Change Post</h2>
                                    </div>
                                    <div class="content">
                                        @include('sections.messages')
                                        <form role="form" method="POST" action="{{ route('posts.update', $post->slug) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title"
                                                           class="form-control" id="title"
                                                           placeholder="Title" value="{{ $post->title }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="content">Content</label>
                                                    <textarea class="form-control" rows="3" placeholder="Content"
                                                              name="content"
                                                              id="content">{{ $post->content }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="category_id">Category</label>
                                                    <br>
                                                    <select class="custom-select form-control-border" id="category_id"
                                                            name="category_id">
                                                        @for($i = 0; $i < count($categories); $i++)
                                                            <option @if($categories[$i]->id == $post->category_id) selected
                                                                    @endif value="{{ $categories[$i]->id }}">{{ $categories[$i]->title }}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tags">Tags</label>
                                                    <select name="tags[]" id="tags" class="form-control"
                                                            multiple="multiple" style="display: none;">
                                                        @foreach($tags as $tag)
                                                            <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>{{ $tag->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" name="image" class="form-control dropify" id="image" data-allowed-file-extensions="jpg jpeg png" @if(!empty($post->image)) data-default-file="{{ asset("storage/{$post->image}") }}" @endif">
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit"
                                                            class="btn btn-secondary btn-sm create-post-btn">Save
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-scripts')
    <script>
        $(function () {
            $("#tags").bsMultiSelect();
        });
    </script>

    <script>
        $(function () {
            $('input.dropify').dropify();
        });
    </script>

    <script>
        $(function () {
            $('.custom-select').select2();
        });
    </script>
@endpush
