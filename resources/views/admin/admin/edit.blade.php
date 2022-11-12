@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.admins.edit', $admin))

@section('content')
    <form role="form" method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"
                       class="form-control" id="name"
                       placeholder="Name" value="{{ $admin->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"
                       class="form-control" id="email"
                       placeholder="Email" value="{{ $admin->email }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password"
                       class="form-control" id="password"
                       placeholder="Password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password confirm</label>
                <input type="password" name="password_confirmation"
                       class="form-control" id="password_confirmation"
                       placeholder="Password confirm">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-sm">Save</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
