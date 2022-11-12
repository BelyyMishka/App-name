@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.categories.edit', $category))

@section('content')
    <form role="form" method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control" id="title"
                       placeholder="Title" value="{{ $category->title }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-sm">Update</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
