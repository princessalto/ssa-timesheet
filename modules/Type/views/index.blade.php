@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")

        <section class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    @include("Pluma::partials.flash")
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Type</h3>
                        </div>

                        <form class="" action="{{ action('\Modules\Type\TypeController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Type Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Type Name" value="{{ old('name') }}">
                                        @include("Pluma::errors.span", ['field' => 'name'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                        @include("Pluma::errors.span", ['field' => 'description'])
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <form action="{{ route('types.destroy-many') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">List of Types</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="type-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type Name</th>
                                                <th>Description</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $resources as $resource )
                                            <tr class="tline">
                                                <td class="mailbox-name">{{ $resource->name }}</td>
                                                <td>{{ $resource->description }}</td>

                                                <td width="10" class="mailbox-name reveal-btn">
                                                    <form class="inline" action="{{ action('\Modules\Type\TypeController@destroy', $resource->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {!! method_field('DELETE') !!}
                                                        <button type="submit" class="primary-btn delete-btn" data-toggle="tooltip" data-placement="top" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                                <td width="10" class="mailbox-name reveal-btn">
                                                    <a class="delete-btn" href="{{ action('\Modules\Type\TypeController@edit', $resource->id) }}" data-toggle="tooltip" data-placement="top" title="edit">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@stop

@push('js')
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            $("#type-list").DataTable() ({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endpush