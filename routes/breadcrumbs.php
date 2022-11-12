<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Admin main page
 */
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Main', route('admin.index'));
});

/**
 * Admin category pages
 */
Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Categories', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.categories.index');
    $trail->push('Create', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.edit', function (BreadcrumbTrail $trail, \App\Models\Category $category): void {
    $trail->parent('admin.categories.index');
    $trail->push('Edit', route('admin.categories.edit', $category->id));
});

/**
 * Admin tag pages
 */
Breadcrumbs::for('admin.tags.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Tags', route('admin.tags.index'));
});

Breadcrumbs::for('admin.tags.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.tags.index');
    $trail->push('Create', route('admin.tags.create'));
});

Breadcrumbs::for('admin.tags.edit', function (BreadcrumbTrail $trail, \App\Models\Tag $tag): void {
    $trail->parent('admin.tags.index');
    $trail->push('Edit', route('admin.tags.edit', $tag->id));
});

/**
 * Admin post pages
 */
Breadcrumbs::for('admin.posts.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Posts', route('admin.posts.index'));
});

Breadcrumbs::for('admin.posts.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.posts.index');
    $trail->push('Create', route('admin.posts.create'));
});

Breadcrumbs::for('admin.posts.edit', function (BreadcrumbTrail $trail, \App\Models\Post $post): void {
    $trail->parent('admin.posts.index');
    $trail->push('Edit', route('admin.posts.edit', $post->id));
});

/*
 * Admin admin pages
 */
Breadcrumbs::for('admin.admins.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Admins', route('admin.admins.index'));
});

Breadcrumbs::for('admin.admins.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.admins.index');
    $trail->push('Create', route('admin.admins.create'));
});

Breadcrumbs::for('admin.admins.edit', function (BreadcrumbTrail $trail, \App\Models\Admin $admin): void {
    $trail->parent('admin.admins.index');
    $trail->push('Edit', route('admin.admins.edit', $admin->id));
});
