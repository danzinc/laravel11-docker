@extends('templates.dashboard')

@section('extra-css')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.11/flatpickr.min.css" rel="stylesheet" />
@endsection

@section('title')
    Tambah Kartu Keluarga
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tambah Kartu Keluarga</h4>  
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
<!-- end page title -->
    <form method="POST" action="{{ route('kk.store') }}" id="formCreate" class="form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="no_kk" class="form-label">No Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Input no KK">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Input Nama Kepala Keluarga">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_dokumen" class="form-label">Tanggal Dokumen *</label>
                                    <input type="text" name="tanggal_dokumen" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" value="{{ date('d-m-Y') }}" id="demo-datepicker" placeholder="Tanggal Dokumen Dikeluarkan">
                                </div> 
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="Input RT">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="Input RW">
                                </div>
                            </div>  
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Input provinsi">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Input kabupaten">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Input kecamatan">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <input type="text" class="form-control" id="desa" name="desa" placeholder="Input desa">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kodepos" class="form-label">Kodepos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Input Kodepos">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_pejabat" class="form-label">Nama Pejabat</label>
                                    <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" placeholder="Input Nama Pejabat">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP Pejabat</label>
                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Input NIP Pejabat">
                                </div>
                            </div>  
                            <div class="col-lg-12">
                                <div class="hstack justify-content-end gap-2"> 
                                    <button type="submit" class="btn btn-secondary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
             
            <!-- end col -->
        </div>
    </form>
</div>
<!-- end row -->
@endsection
@section('extra-scripts')   
@endsection