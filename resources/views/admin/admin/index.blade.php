@extends('admin.layouts.layout')

@section('title', $title)

@section('breadcrumbs', \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.admins.index'))

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.admins.create') }}" class='edit btn btn-secondary btn-sm' style="margin-bottom: 20px"><i class="fas fa-plus"></i> Create</a>
        <table class="table table-bordered" id="admin-datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
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
            var table = $('#admin-datatable').DataTable({
                aaSorting: [
                    [
                        0, "desc"
                    ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.admins.list') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
