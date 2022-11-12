@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.categories.create'))

@section('content')
    <form role="form" method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control" id="title"
                       placeholder="Title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-sm">Save</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
