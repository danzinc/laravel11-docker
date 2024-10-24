@extends('templates.dashboard')

@section('extra-css')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.11/flatpickr.min.css" rel="stylesheet" />
@endsection

@section('title')
    Tambah KTP
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tambah KTP</h4>  
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
    <form method="POST" action="{{ route('kkitem.store.post',$id) }}" id="formCreate" class="form" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="ktp_id" class="form-label">No KTP</label>
                                    <select class="form-control" id="ktp_id" name="ktp_id"  > 
                                        <option value="">Pilih KTP</option>
                                        @foreach ($ktp as $ktp_item ) 
                                            <option value="{{ $ktp_item->id }}">{{ $ktp_item->ktp_no }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status_hubungan" class="form-label">Status Hubungan Keluarga</label>
                                    <input type="text" class="form-control" id="status_hubungan" name="status_hubungan" placeholder="Input status hubungan">
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