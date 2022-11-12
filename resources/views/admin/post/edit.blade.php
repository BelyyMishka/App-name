@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.posts.edit', $post))

@section('content')
    <form role="form" method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
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
                <textarea class="form-control" rows="3" placeholder="Content" name="content"
                          id="content">{{ $post->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <br>
                <select class="custom-select form-control-border" id="category_id" name="category_id">
                    @for($i = 0; $i < count($categories); $i++)
                        <option @if($post->category_id == $categories[$i]->id) selected
                                @endif value="{{ $categories[$i]->id }}">{{ $categories[$i]->title }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple="multiple" style="display: none;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">User</label>
                <select class="custom-select form-control-border" id="user_id" name="user_id">
                    @for($i = 0; $i < count($users); $i++)
                        <option @if($post->user_id == $users[$i]->id) selected
                                @endif value="{{ $users[$i]->id }}">{{ $users[$i]->name }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control dropify" id="image" data-allowed-file-extensions="jpg jpeg png" @if(!empty($post->image)) data-default-file="{{ asset("storage/{$post->image}") }}" @endif">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-sm">Save</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
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
