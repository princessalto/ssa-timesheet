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
                            <h3 class="box-title">Add Department</h3>
                        </div>

                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="" action="{{ action('\Modules\Department\DepartmentController@update', $resource->id) }}" method="POST">
                            {!! method_field('PUT') !!}
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Department Name" value="{{ null !== old('name') ? old('name') : $resource->name }}">
                                        @include("Pluma::errors.span", ['field' => 'name'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" rows="5">{{ $resource->description }}</textarea>
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
            </div>
        </section>
    </div>

@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush