@extends('templates.dashboard')

@section('extra-css')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.11/flatpickr.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
@endsection

@section('title')
    Edit Kartu Keluarga
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Kartu Keluarga</h4>  
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form update -->
    <form method="POST" action="{{ route('kk.update', $kk->id) }}" id="formUpdate" class="form" novalidate enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_kepala_keluarga" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Input nama kepala keluarga" value="{{ old('nama_kepala_keluarga', $kk->nama_kepala_keluarga) }}">
                                </div>  
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="no_kk" class="form-label">No KTP</label>
                                    <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Input no KTP" value="{{ old('no_kk', $kk->no_kk) }}">
                                </div>
                            </div> 

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_dokumen" class="form-label">Tanggal Dokumen *</label>
                                    <input type="text" name="tanggal_dokumen" class="form-control" 
                                        value="{{ old('tanggal_dokumen', $kk->tanggal_dokumen ? $kk->tanggal_dokumen->format('d-m-Y') : '') }}" 
                                        placeholder="Tanggal Lahir">
                                </div> 
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="Input RT" value="{{ old('rt', $kk->rt) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="Input RW" value="{{ old('rw', $kk->rw) }}">
                                </div>
                            </div>  
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Input provinsi" value="{{ old('provinsi', $kk->provinsi) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Input kabupaten" value="{{ old('kabupaten', $kk->kabupaten) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Input kecamatan" value="{{ old('kecamatan', $kk->kecamatan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <input type="text" class="form-control" id="desa" name="desa" placeholder="Input desa" value="{{ old('desa', $kk->desa) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kodepos" class="form-label">Kodepos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Input Kodepos" value="{{ old('kodepos', $kk->kodepos) }}">
                                </div>
                            </div>  
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_pejabat" class="form-label">Nama Pejabat</label>
                                    <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" placeholder="Input Nama Pejabat" value="{{ old('nama_pejabat', $kk->nama_pejabat) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP Pejabat</label>
                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Input NIP Pejabat" value="{{ old('nip', $kk->nip) }}">
                                </div>
                            </div> 

                            <!-- Continue for other fields like rw, kodepos, provinsi, kecamatan, etc. -->
                            
                            <div class="col-lg-12">
                                <div class="hstack justify-content-end gap-2"> 
                                    <button type="submit" class="btn btn-secondary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
 
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"> 
                    <div class="col-sm-auto">
                        <div>
                            <a href="{{ route('kkitem.create.get', $kk->id) }}"
                                class="btn btn-info add-btn bg-success border-success"><i
                                    class="ri-add-fill me-1 align-bottom"></i> Tambah KTP</a>
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <!-- Hoverable Rows -->
                    <table id="datatable" class="table table-hover table-nowrap mb-0">
                        <thead>
                            <tr> 
                                <th scope="col">NIK</th> 
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Hubungan Keluarga</th> 
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Pendidikan</th>
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
  
    var table = $('table#datatable').DataTable({
        processing: true,
        orderable: false,
        serverSide: true,
        responsive: true,
        destroy: true,
        bDestroy: true,
        ajax: {
            "url": "{{ route('kkitem.item',$kk->id) }}"
        },
        columns: [ 
            {
                data: 'ktp_no',
                name: 'ktp_no',
                orderable: true,
                searchable: true
            },
            {
                data: 'nama',
                name: 'nama',
                orderable: true,
                searchable: true
            },
            
            {
                data: 'status_hubungan',
                name: 'status_hubungan',
                orderable: true,
                searchable: true
            },
            {
                data: 'jenis_kelamin',
                name: 'jenis_kelamin',
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
                data: 'agama',
                name: 'agama',
                orderable: true,
                searchable: true
            },
            {
                data: 'pendidikan',
                name: 'pendidikan',
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
