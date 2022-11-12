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
                            <h4>Edit Name</h4>
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
                                        <h2>Change Name</h2>
                                    </div>
                                    <div class="content">
                                        @include('sections.messages')
                                        <form role="form" method="POST" action="{{ route('profile.changeName') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name"
                                                           class="form-control" id="name"
                                                           placeholder="Name" value="{{ $user->name }}">
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
