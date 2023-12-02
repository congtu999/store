<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Total</th>
        <th>Pay Method</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($orders))
        @foreach($orders as $key => $value)
            <tr>
                <td>
                    {{$value->id}}
                </td>
                <td>
                    <p class="text-muted mb-0">{{$value->date}}</p>
                </td>
                <td>Senior</td>
                <td>
                    <p class="text-muted mb-0">{{$value->phone}}</p>
                </td>
                <td>
                    <p class="text-muted mb-0">{{$value->address}}</p>
                </td>
                <td>
                    <p class="text-muted mb-0">${{number_format($value->total_price)}}</p>
                </td>
                <td>
                    <p class="text-muted mb-0">${{$value->pay_method}}</p>
                </td>
                <td>
                    <span class="badge badge-success rounded-pill d-inline">{{$value->status}}</span>
                </td>
                <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                        Cancel
                    </button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>





