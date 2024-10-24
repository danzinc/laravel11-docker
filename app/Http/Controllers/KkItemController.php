<?php

namespace App\Http\Controllers;


use App\Models\Kartu_keluarga_item;
use App\Models\Ktp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class KkItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$idkk)
    {
        //
        if ($request->ajax()) {
            $model = Kartu_keluarga_item::where('kartu_keluarga_id',$idkk)->get();
            return DataTables::of($model) 
                ->addColumn('ktp_no', function ($row) {
                    return $row->ktp->ktp_no;
                })
                ->addColumn('nama', function ($row) {
                    return $row->ktp->nama;
                })
                ->addColumn('jenis_kelamin', function ($row) {
                    return $row->ktp->jenis_kelamin;
                })
                ->addColumn('tanggal_lahir', function ($row) {
                    return $row->ktp->tanggal_lahir;
                })
                ->addColumn('agama', function ($row) {
                    return $row->ktp->agama;
                })
                ->addColumn('pendidikan', function ($row) {
                    return $row->ktp->pendidikan;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                        <a href="' . route('kkitem.edit', [ $row->id]) . '"  class="text-primary d-inline-block" title="View details"> <i class="ri-eye-fill fs-16"></i></a>
                    </li>
                     <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                        <a href="' . route('kkitem.destroy', [$row->id]) . '" class="text-danger d-inline-block" data-confirm-delete="true" title="View details"> <i class="ri-delete-bin-5-fill fs-16"></i></a>
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
        return view('kk.item.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $ktp = Ktp::all();
        return view('kk.item.create', compact('ktp', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        // 
      
        $data = request()->all();
        $validator = Validator::make($data, [
            'ktp_id' => 'required', 
            'status_hubungan' => 'required|string|max:191',  
        ]); 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try { 
            DB::transaction(function () use ($request,$id) { 
                $new_data = Kartu_keluarga_item::create([
                    'ktp_id' => $request->ktp_id, 
                    'kartu_keluarga_id' => $id, 
                    'status_hubungan' => $request->status_hubungan
                ]); 
                 
            });
            alert()->success( 'Berhasil Menambahkan Data');
            return redirect()->route('kk.show',$id)->with('success', 'User and Profile created successfully!');
            
        } catch (QueryException $e) { 
            die($e);
            Alert::error('Failed', 'Gagal Menyimpan Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage());
            
        } catch (Exception $e) { 
            die($e);
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kkitem = Kartu_keluarga_item::findOrFail($id); 
        $ktp = Ktp::all();
        return view('kk.item.edit', compact('ktp','kkitem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $data = $request->all(); 
        $validator = Validator::make($data, [
            'ktp_id' => 'required', 
            'status_hubungan' => 'required|string|max:191', 
        ]);
 
        if ($validator->fails()) {
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            
            $existing_data = Kartu_keluarga_item::findOrFail($id);
            
            DB::transaction(function () use ($request, $existing_data) {  
                $existing_data->update([
                    'ktp_id' => $request->ktp_id,  
                    'status_hubungan' => $request->status_hubungan
                ]);
                 
            });
            alert()->success( 'Berhasil Memperbarui Data');
            return redirect()->route('kk.show', $existing_data->kartu_keluarga_id)->with('success', 'Data berhasil diperbarui!');

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
            $delete_kk = Kartu_keluarga_item::findOrFail($id);
            $delete_kk->delete();
            alert()->success( 'Berhasil Menghapus Data');
            return redirect()->route('kk.show',$delete_kk->kartu_keluarga_id)->with('success', 'Data berhasil dihapus!');
        } catch (QueryException $e) { 
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage()); 
        } catch (Exception $e) { 
            Alert::error('Failed', 'Gagal Memperbarui Data');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
