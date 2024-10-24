<?php

namespace App\Http\Controllers;

use App\Models\Kartu_keluarga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $model = Kartu_keluarga::query();
            return DataTables::of($model)
                // ->addIndexColumn()
               
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                        <a href="' . route('kk.show', [$row->id]) . '"  class="text-primary d-inline-block" title="View details"> <i class="ri-eye-fill fs-16"></i></a>
                    </li>
                     <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                        <a href="' . route('kk.destroy', [$row->id]) . '" class="text-danger d-inline-block" data-confirm-delete="true" title="View details"> <i class="ri-delete-bin-5-fill fs-16"></i></a>
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
        return view('kk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = request()->all();
        $validator = Validator::make($data, [
            'no_kk' => 'required|string|max:191|unique:kartu_keluargas',
            'nama_kepala_keluarga' => 'required|string|max:191', 
            'tanggal_dokumen' => 'required|date', 
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kodepos' => 'required|string|max:10',
            'desa' => 'required|string|max:150',
            'kecamatan' => 'required|string|max:150',
            'kabupaten' => 'required|string|max:150',
            'provinsi' => 'required|string|max:150', 
            'nama_pejabat' => 'required|string|max:150',
            'nip' => 'required|string|max:150',
        ]); 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try { 
            DB::transaction(function () use ($request,&$new_data) {
                $tanggal_dokumen = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal_dokumen)->format('Y-m-d'); 
                $new_data = kartu_keluarga::create([
                    'no_kk' => $request->no_kk, 
                    'nama_kepala_keluarga' => $request->nama_kepala_keluarga, 
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kodepos' => $request->kodepos,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi, 
                    'tanggal_dokumen' => $tanggal_dokumen, 
                    'nama_pejabat' => $request->nama_pejabat,
                    'nip' => $request->nip,
                ]); 
                
                 
            });
            alert()->success( 'Berhasil Menambahkan Data');
            return redirect()->route('kk.edit',$new_data->id)->with('success', 'User and Profile created successfully!');
            
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
    public function show(Request $request,string $id)
    {
        //
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $kk = Kartu_keluarga::findOrFail($id); 
        $kk->tanggal_dokumen = Carbon::parse($kk->tanggal_dokumen); 
        return view('kk.edit', compact('kk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $kk = Kartu_keluarga::findOrFail($id); 
        $kk->tanggal_dokumen = Carbon::parse($kk->tanggal_dokumen); 
        return view('kk.edit', compact('kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $data = $request->all(); 
        $validator = Validator::make($data, [
            'no_kk' => 'required|string|max:191|unique:kartu_keluargas,no_kk,' . $id, 
            'tanggal_dokumen' => 'required|date', 
            'nama_kepala_keluarga' => 'required|string|max:191', 
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kodepos' => 'required|string|max:10',
            'desa' => 'required|string|max:150',
            'kecamatan' => 'required|string|max:150',
            'kabupaten' => 'required|string|max:150',
            'provinsi' => 'required|string|max:150', 
            'nama_pejabat' => 'required|string|max:150',
            'nip' => 'required|string|max:150',
        ]);
 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            
            $existing_data = Kartu_keluarga::findOrFail($id);
 
            DB::transaction(function () use ($request, $existing_data) { 
                $tanggal_dokumen = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal_dokumen)->format('Y-m-d'); 
                $existing_data->update([
                    'no_kk' => $request->no_kk, 
                    'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kodepos' => $request->kodepos,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi, 
                    'tanggal_dokumen' => $tanggal_dokumen, 
                    'nama_pejabat' => $request->nama_pejabat,
                    'nip' => $request->nip,
                ]);
            });
            alert()->success( 'Berhasil Memperbarui Data');
            return redirect()->route('kk.edit',$existing_data->id)->with('success', 'Data berhasil diperbarui!');

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
    public function destroy($id)
    {
        //
        try { 
            $delete_kk = Kartu_keluarga::findOrFail($id);
            $delete_kk->delete();
            alert()->success( 'Berhasil Menghapus Data');
            return redirect()->route('kk.index')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException $e) { 
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage()); 
        } catch (Exception $e) { 
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
