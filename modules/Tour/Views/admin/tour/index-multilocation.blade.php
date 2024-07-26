<div class="panel">
    <div class="panel-body">
        <form action="" class="bravo-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60px">#</th>
                            <th width="60"> Tour</th>
                            <th width="130px"> Location</th>
                            <th width="100px"> Address</th>
                            <th width="100px"> Map Lat</th>
                            <th width="100px"> Map Lng</th>
                            <th width="100px"> Map Zoom</th>
                            <th width="100px"> Date</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($travelLocations as $key =>$travelLocation)
                        <tr class="publish">
                            <td class="title">{{ ++$key }}</td>
                            <td class="title">{{ $travelLocation->Tour->title??'' }}</td>
                            <td>{{ $travelLocation->Location->name??'' }}</td>
                            <td>{{ $travelLocation->address??'' }}</td>
                            <td>{{ $travelLocation->map_lat??'' }}</td>
                            <td>{{ $travelLocation->map_lng??'' }}</td>
                            <td>{{ $travelLocation->map_zoom??'' }}</td>
                            <td>{{ isset($travelLocation->created_at)?$travelLocation->created_at->toFormattedDateString('Y-m-d'):'' }}<td>
                                <a href="{{ route('multilocation.admin.destroy',$travelLocation->id) }}"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>