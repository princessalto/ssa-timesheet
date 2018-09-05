@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")

        <section class="content">
			@include("Pluma::partials.flash")
			<div class="box box-primary">
                <div class="box-header with-border">
                	<h3 class="box-title">Roles</h3>
	                {{-- <div class="box-tool pull-right">
	                	<a href="{{ route('roles.create') }}" class="btn-delete btn btn-default">Create</a>
						<a href="{{ route('roles.trash') }}" class="btn btn-link pull-xs-right"><i class="fa fa-trash">&nbsp;</i>Trashed ({{ $trashed->count() > 0 ? $trashed->count() : '0' }})</a>
	                </div> --}}
                </div>

                <div class="box-body">
					<div class="table-responsive">
						<table id="role-list" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Code</th>
									<th>Description</th>
									<td></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								@foreach ( $resources as $resource )
									<tr class="tline">
										<td class="mailbox-name"><a href="{{ action('\Pluma\Controllers\RoleController@show', $resource->id) }}">{{ $resource->name }}</a></td>
										<td class="mailbox-name">{{ $resource->slug }}</td>
										<td class="mailbox-name">{{ $resource->description }}</td>
										<td width="10" class="mailbox-name reveal-btn">@include("Pluma::roles.destroy", compact('resource'))</td>
										<td width="10" class="mailbox-name reveal-btn"><a class="delete-btn" data-toggle="tooltip" data-placement="top" title="edit"href="{{ action('\Pluma\Controllers\RoleController@edit', $resource->id) }}"><i class="fa fa-edit"></i></a></td>
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
            $("#role-list").DataTable() ({
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
