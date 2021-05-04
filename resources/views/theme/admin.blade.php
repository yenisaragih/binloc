@extends('layouts.default')
<!-- Section tampilan admin username-->
@section('nav-bar')
<ul class="navbar-nav float-right">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="ml-2 d-none d-lg-inline-block">
                <span>Hello, </span> 
                <span class="text-dark">{{ Auth::user()->name }}</span> 
                <i data-feather="chevron-down"class="svg-icon"></i>
            </span>
        </a>

        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault()
                    document.getElementById('logout-form').sumbit()"><i data-feather="power"
                    class="svg-icon mr-2 ml-1"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf  
            </form>
        </div>
        
    </li>
</ul>
@endsection

<!-- Section tampilan button upload csv -->
@section('upload-csv')
<div class="col-12 col-md-2 ml-auto">
    <div class="customize-input ">
        <!-- Custom width modal -->
        <button type="button" class="btn btn-rounded btn btn-rounded btn-primary" data-toggle="modal"
        data-target="#myModal">Upload New Bin Loc</button>
        
        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="mt-4" method="POST" action='/admin/upload' enctype='multipart/form-data'>
                    @csrf    
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Import Bin Loc</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file">
                                    <label class="custom-file-label" for="file">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" name="submit" value="Import">
                        </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> 
</div>
@endsection


@section('content')
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
                ajax: "{{ route('admin') }}",
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
