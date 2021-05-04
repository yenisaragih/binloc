<table class="table table-striped table-bordered display no-wrap"
    style="width:100%">
    <thead class="bg-warning text-white">
        <tr>
            <th>Part Number</th>
            <th>Description</th>
            <th>Stock On Hand S79</th>
            <th>Stock Code S79</th>
            <th>IP Pre Stoking S79</th>
            <th>Stock On Hand S38</th>
            <th>Stock Code S38</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->part_number }}</td>
            <td>{{ $row->description }}</td>
            <td>{{ $row->stock_oh_s79 }}</td>
            <td>{{ $row->stock_code_s79 }}</td>
            <td>{{ $row->ip_prestocking }}</td>
            <td>{{ $row->stock_oh_s38 }}</td>
            <td>{{ $row->stock_code_s38 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

 
