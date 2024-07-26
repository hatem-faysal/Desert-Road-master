<div class="panel">
    <div class="panel-body">
        <form action="" class="bravo-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60px">#</th>
                            <th width="60"> Name</th>
                            <th width="130px"> Price</th>
                            <th width="100px"> Package</th>
                            <th width="100px"> Date</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($travelLocations??[] as $key =>$travelLocation)
                        <tr class="publish">
                            <td class="title">{{ ++$key }}</td>
                            <td class="title">{{ $travelLocation->name }}</td>
                            <td>{{ $travelLocation->price }}</td>
                            <td>{{ $travelLocation->Tour->title??'' }}</td>
                            <td>{{ isset($travelLocation->created_at)?$travelLocation->created_at->toFormattedDateString('Y-m-d'):'' }}<td>
                                <a href="{{ route('multiroom.admin.destroy',$travelLocation->id) }}"
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