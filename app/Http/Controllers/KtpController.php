<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ktp;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
class KtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        
        if ($request->ajax()) {
            $model = Ktp::query();
            return DataTables::of($model)
                // ->addIndexColumn()
               ->addColumn('tanggal_lahir', function ($row) {
                $tanggal_lahir = Carbon::parse($row->tanggal_lahir)->format('d-m-Y'); 
                return $tanggal_lahir;
               })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                        <a href="' . route('ktp.show', [$row->id]) . '"  class="text-primary d-inline-block" title="View details"> <i class="ri-eye-fill fs-16"></i></a>
                    </li>
                     <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                        <a href="' . route('ktp.destroy', [$row->id]) . '" class="text-danger d-inline-block" data-confirm-delete="true" title="View details"> <i class="ri-delete-bin-5-fill fs-16"></i></a>
                    </li>
                </ul>'; 
                 
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('ktp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ktp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $data = request()->all();
        $validator = Validator::make($data, [
            'ktp_no' => 'required|string|max:191|unique:ktps',
            'nama' => 'required|string|max:191',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kodepos' => 'required|string|max:10',
            'desa' => 'required|string|max:150',
            'kecamatan' => 'required|string|max:150',
            'kabupaten' => 'required|string|max:150',
            'provinsi' => 'required|string|max:150',
            'golongan_darah' => 'required|string|max:191', 
            'jenis_kelamin' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:10',
            'pendidikan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:50',
            'jenis_pendidikan' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:150',
            'no_passport' => 'nullable|string|max:150',
            'no_kitap' => 'nullable|string|max:150',
            'nama_ayah' => 'required|string|max:150',
            'nama_ibu' => 'required|string|max:150',
        ]); 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try { 
            DB::transaction(function () use ($request) {
                $tanggal_lahir = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->format('Y-m-d'); 
                $new_data = ktp::create([
                    'ktp_no' => $request->ktp_no,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kodepos' => $request->kodepos,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'golongan_darah' => $request->golongan_darah,
                    'foto' => '',
                    'foto_ttd' => '',
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'agama' => $request->agama,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'jenis_pendidikan' => $request->jenis_pendidikan,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'no_passport' => $request->no_passport,
                    'no_kitap' => $request->no_kitap,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                ]); 
                 
            });
            alert()->success( 'Berhasil Menambahkan Data');
            return redirect()->route('ktp.index')->with('success', 'User and Profile created successfully!');
            
        } catch (QueryException $e) { 
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage());
            
        } catch (Exception $e) { 
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ktp = Ktp::findOrFail($id); 
        $ktp->tanggal_lahir = Carbon::parse($ktp->tanggal_lahir); 
        return view('ktp.edit', compact('ktp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $ktp = Ktp::findOrFail($id); 
        $ktp->tanggal_lahir = Carbon::parse($ktp->tanggal_lahir); 
        return view('ktp.edit', compact('ktp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $data = $request->all(); 
        $validator = Validator::make($data, [
            'ktp_no' => 'required|string|max:191|unique:ktps,ktp_no,' . $id, 
            'nama' => 'required|string|max:191',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kodepos' => 'required|string|max:10',
            'desa' => 'required|string|max:150',
            'kecamatan' => 'required|string|max:150',
            'kabupaten' => 'required|string|max:150',
            'provinsi' => 'required|string|max:150',
            'golongan_darah' => 'required|string|max:191',
            'jenis_kelamin' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:10',
            'pendidikan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:50',
            'jenis_pendidikan' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:150',
            'no_passport' => 'nullable|string|max:150',
            'no_kitap' => 'nullable|string|max:150',
            'nama_ayah' => 'required|string|max:150',
            'nama_ibu' => 'required|string|max:150',
        ]);
 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            
            $existing_data = Ktp::findOrFail($id);
 
            DB::transaction(function () use ($request, $existing_data) { 
                $tanggal_lahir = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->format('Y-m-d'); 
                $existing_data->update([
                    'ktp_no' => $request->ktp_no,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kodepos' => $request->kodepos,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'golongan_darah' => $request->golongan_darah,
                    'foto' => '', // To Do: File Upload
                    'foto_ttd' => '', // To Do: File Upload
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'agama' => $request->agama,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'jenis_pendidikan' => $request->jenis_pendidikan,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'no_passport' => $request->no_passport,
                    'no_kitap' => $request->no_kitap,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                ]);
            });
            alert()->success( 'Berhasil Memperbarui Data');
            return redirect()->route('ktp.index')->with('success', 'Data berhasil diperbarui!');

        } catch (QueryException $e) {
            
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage());

        } catch (Exception $e) {
            
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            
            $delete_ktp = Ktp::findOrFail($id);
            $delete_ktp->delete();
            alert()->success( 'Berhasil Menghapus Data');
            return redirect()->route('ktp.index')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException $e) {
                
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage());

        } catch (Exception $e) {
            
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
