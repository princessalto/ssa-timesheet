<div class="col-md-6 col-xs-12">
    <form action="">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th></th>
                    <th>Type Name</th>
                    <th>Description</th>
                </tr>

                @foreach ( $resources as $resource )
                <tr class="tline">
                    <td style="max-width: 50px; padding-left: 16px;"><input id='check-{{ $resource->id }}' type="checkbox" name='types[]' value="{{ $resource->id }}" />
                        <label class="cbox" for="check-{{ $resource->id }}"></label></td>
                        {{-- {{ url("admin/clients/$resouce->id/edit") }} --}}
                    <td class="mailbox-name" style="min-width: 250px;">
                    {{ $resource->name }}</td>
                    <td>{{ $resource->description }}</td>

                    <td width="80">
                        <div class="reveal-btn">
                            <form class="inline" action="{{ action('\Modules\Type\TypeController@destroy', $resource->id) }}" method="POST">
                                {{ csrf_field() }}
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="primary-btn delete-btn"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                            <a class="delete-btn" href="{{ action('\Modules\Type\TypeController@edit', $resource->id) }}">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
</div>