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
                            <h4>Profile</h4>
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
                                        <h2>Profile</h2>
                                    </div>
                                    <div class="content">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name <a href="{{ route('profile.changeNameForm') }}" style="color: #F48840;"><i class="fa-solid fa-pencil"></i></a></label>
                                                <input type="text" name="name"
                                                       class="form-control" id="name"
                                                       placeholder="Name" value="{{ $user->name }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email <a href="{{ route('profile.changeEmailForm') }}" style="color: #F48840;"><i class="fa-solid fa-pencil"></i></a></label>
                                                <input type="email" name="email"
                                                       class="form-control" id="email"
                                                       placeholder="Email" value="{{ $user->email }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password <a href="{{ route('profile.changePasswordForm') }}" style="color: #F48840;"><i class="fa-solid fa-pencil"></i></a></label>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
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
