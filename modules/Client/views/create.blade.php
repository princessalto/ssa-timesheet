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
                            <h3 class="box-title">Add Client</h3>
                        </div>

                        <form class="" action="{{ action('\Modules\Client\ClientController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Client Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Client Name" value="{{ old('name') }}">
                                        @include("Pluma::errors.span", ['field' => 'name'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
                                    <div class="col-sm-10">
                                        <select name="type_id" id="type_id" class="form-control">
                                            @foreach ( $types as $id => $type )
                                            <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected="selected"' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @include("Pluma::errors.span", ['field' => 'type_id'])
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
            </div>
        </section>
    </div>

@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush