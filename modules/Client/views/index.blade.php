@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")

        <section class="content">
            @include("Pluma::partials.flash")
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Clients</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="client-list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $resources as $resource )
                                    <tr class="tline">
                                        <td class="mailbox-name">{{ $resource->name }}</td>
                                        <td class="mailbox-name">{{ $resource->type_name }}</td>
                                        <td>{{ $resource->description }}</td>

                                        <td width="10" class="mailbox-name reveal-btn">
                                            <form class="inline" action="{{ action('\Modules\Client\ClientController@destroy', $resource->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {!! method_field('DELETE') !!}
                                                <button type="submit" class="delete-btn" data-toggle="tooltip" data-placement="top" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </td>

                                        <td width="10" class="mailbox-name reveal-btn">
                                            <a class="delete-btn" href="{{ action('\Modules\Client\ClientController@edit', $resource->id) }}" data-toggle="tooltip" data-placement="top" title="edit">
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
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            $("#client-list").DataTable() ({
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