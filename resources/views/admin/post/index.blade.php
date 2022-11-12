@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.posts.index'))

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.posts.create') }}" class='edit btn btn-secondary btn-sm' style="margin-bottom: 20px"><i class="fas fa-plus"></i> Create</a>
        <table class="table table-bordered" id="post-datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>User</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('js-scripts')
    <script>
        $(function () {
            var table = $('#post-datatable').DataTable({
                aaSorting: [
                    [
                        0, "desc"
                    ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.posts.list') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'tags',
                        name: 'tags'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
