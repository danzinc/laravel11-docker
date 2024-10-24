@extends('templates.dashboard')
@section('title')
    Informasi KTP
@endsection
@section('extra-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Informasi KTP</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"> 
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('ktp.create') }}"
                                    class="btn btn-info add-btn bg-success border-success"><i
                                        class="ri-add-fill me-1 align-bottom"></i> Tambah</a>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <!-- Hoverable Rows -->
                        <table id="datatable" class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">Nama</th>
                                    <th scope="col">No KTP</th>
                                    <th scope="col">Alamat</th> 
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tBody> 
                            </tBody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
load_table(); 
function load_table() {
    var table = $('#datatable').DataTable({
        processing: true,
        orderable: false,
        serverSide: true,
        responsive: true,
        destroy: true,
        bDestroy: true,
        ajax: {
            "url": "{{ route('ktp.index') }}"
        },
        columns: [ 
            {
                data: 'nama',
                name: 'nama',
                orderable: true,
                searchable: true
            },
            {
                data: 'ktp_no',
                name: 'ktp_no',
                orderable: true,
                searchable: true
            },
            {
                data: 'alamat',
                name: 'alamat',
                orderable: true,
                searchable: true
            },
            {
                data: 'tempat_lahir',
                name: 'tempat_lahir',
                orderable: true,
                searchable: true
            },
            {
                data: 'tanggal_lahir',
                name: 'tanggal_lahir',
                orderable: true,
                searchable: true
            }, 
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
}
</script>

@endsection
