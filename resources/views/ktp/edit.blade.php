@extends('templates.dashboard')

@section('extra-css')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.11/flatpickr.min.css" rel="stylesheet" />
@endsection

@section('title')
    Edit KTP
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit KTP</h4>  
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
    <form method="POST" action="{{ route('ktp.update', $ktp->id) }}" id="formUpdate" class="form" novalidate enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Input nama lengkap" value="{{ old('nama', $ktp->nama) }}">
                                </div>  
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="ktp_no" class="form-label">No KTP</label>
                                    <input type="text" class="form-control" id="ktp_no" name="ktp_no" placeholder="Input no KTP" value="{{ old('ktp_no', $ktp->ktp_no) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Input tempat lahir" value="{{ old('tempat_lahir', $ktp->tempat_lahir) }}">
                                </div> 
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                                    <input type="text" name="tanggal_lahir" class="form-control" 
                                        value="{{ old('tanggal_lahir', $ktp->tanggal_lahir ? $ktp->tanggal_lahir->format('d-m-Y') : '') }}" 
                                        placeholder="Tanggal Lahir">
                                </div> 
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Input alamat" value="{{ old('alamat', $ktp->alamat) }}">
                                </div> 
                            </div>
                            <!-- Add the rest of the fields with similar value population -->

                            <!-- Example for RT -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="Input RT" value="{{ old('rt', $ktp->rt) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="Input RW" value="{{ old('rw', $ktp->rw) }}">
                                </div>
                            </div>  
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Input provinsi" value="{{ old('provinsi', $ktp->provinsi) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Input kabupaten" value="{{ old('kabupaten', $ktp->kabupaten) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Input kecamatan" value="{{ old('kecamatan', $ktp->kecamatan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <input type="text" class="form-control" id="desa" name="desa" placeholder="Input desa" value="{{ old('desa', $ktp->desa) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kodepos" class="form-label">Kodepos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Input Kodepos" value="{{ old('kodepos', $ktp->kodepos) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                    <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" placeholder="Input Golongan Darah" value="{{ old('golongan_darah', $ktp->golongan_darah) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Input Jenis Kelamin" value="{{ old('jenis_kelamin', $ktp->jenis_kelamin) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" placeholder="Input Agama" value="{{ old('agama', $ktp->agama) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Input Pendidikan" value="{{ old('pendidikan', $ktp->pendidikan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Input Pekerjaan" value="{{ old('pekerjaan', $ktp->pekerjaan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="jenis_pendidikan" class="form-label">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" id="jenis_pendidikan" name="jenis_pendidikan" placeholder="Input Jenis Pendidikan" value="{{ old('jenis_pendidikan', $ktp->jenis_pendidikan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                    <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" placeholder="Input Status Perkawinan" value="{{ old('status_perkawinan', $ktp->status_perkawinan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" placeholder="Input Kewarganegaraan" value="{{ old('kewarganegaraan', $ktp->kewarganegaraan) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="no_passport" class="form-label">No Passport</label>
                                    <input type="text" class="form-control" id="no_passport" name="no_passport" placeholder="Input No Passport" value="{{ old('no_passport', $ktp->no_passport) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="no_kitap" class="form-label">No Kitap</label>
                                    <input type="text" class="form-control" id="no_kitap" name="no_kitap" placeholder="Input No Kitap" value="{{ old('no_kitap', $ktp->no_kitap) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Input Nama Ayah" value="{{ old('nama_ayah', $ktp->nama_ayah) }}">
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Input Nama Ibu" value="{{ old('nama_ibu', $ktp->nama_ibu) }}">
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
</div>
@endsection

@section('extra-scripts')   
@endsection
