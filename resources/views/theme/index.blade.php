@extends('layouts.default')

@section('nav-bar')
<ul class="navbar-nav float-right">
    <a class="nav-link" href="{{ route('login') }}" 
        aria-haspopup="true" aria-expanded="false">
            <span class="ml-2 d-none d-lg-inline-block">
            <span class="text-dark">Login Admin</span> 
        </span>
    </a>
</ul>
@endsection


@section('content')
<div class="row">
            
</div>
<div class="row"> 
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_data" class="table table-striped table-bordered display no-wrap dataTable"
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
                        <tbody></tbody>
                    </table>
                    <div class="col-lg-12" style="padding-right: 0px; padding-left: 0px">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_data').DataTable({
            processing: true,
            serverSide: true,
            paginationType: "simple",
            ajax: "{{ route('index') }}",
            columns: [
                { data: 'part_number', name: 'part_number'},
                { data: 'description', name: 'description'},
                { data: 'stock_oh_s79', name: 'stock_oh_s79'},
                { data: 'stock_code_s79', name: 'stock_code_s79'},
                { data: 'ip_prestocking',name: 'ip_prestocking'},
                { data: 'stock_oh_s38',name: 'stock_oh_s38'},
                { data: 'stock_code_s38', name: 'stock_code_s38'},
            ]
        });
    });

</script>
@endsection
