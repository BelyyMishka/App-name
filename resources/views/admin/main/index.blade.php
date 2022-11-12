@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.index'))

@section('content')
    <div class="card-body">
        <div class="row">

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total posts</span>
                        <span class="info-box-number">{{ $postsCount }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total users</span>
                        <span class="info-box-number">{{ $usersCount }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total categories</span>
                        <span class="info-box-number">{{ $categoriesCount }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="far fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total tags</span>
                        <span class="info-box-number">{{ $tagsCount }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
