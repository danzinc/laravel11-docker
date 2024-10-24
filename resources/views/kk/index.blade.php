@extends('templates.dashboard')
@section('title')
    Informasi KK
@endsection
@section('extra-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">nformasi KK</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"> 
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('kk.create') }}"
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
                                    <th scope="col">Nama Kepala Keluarga</th>
                                    <th scope="col">No Kartu Keluarga</th> 
                                    <th scope="col">Nama Pejabat</th>
                                    <th scope="col">Tanggal Dokumen</th>
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
            "url": "{{ route('kk.index') }}"
        },
        columns: [ 
            {
                data: 'nama_kepala_keluarga',
                name: 'nama_kepala_keluarga',
                orderable: true,
                searchable: true
            },
            {
                data: 'no_kk',
                name: 'no_kk',
                orderable: true,
                searchable: true
            },
            
            {
                data: 'nama_pejabat',
                name: 'nama_pejabat',
                orderable: true,
                searchable: true
            },
            {
                data: 'tanggal_dokumen',
                name: 'tanggal_dokumen',
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
