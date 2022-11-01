<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_keluar = SuratKeluar::latest()->paginate(5);
    
        return view('surat_keluar.index',compact('surat_keluar'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_keluar.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
  
        $input = $request->all();
  
        if ($image = $request->file('file')) {
            $destinationPath = 'surat_keluar/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['file'] = "$profileImage";
        }
        $input['tanggal_surat'] = date('Y-m-d');
    
        SuratKeluar::create($input);
     
        return redirect()->route('surat-keluar.index')
            ->with('success','SuratKeluar created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\SuratKeluar  $surat_keluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $surat_keluar)
    {
        $filePath = public_path("surat_keluar/".$surat_keluar->file);
        return response()->download($filePath);

        // return view('surat_keluar.show',compact('surat_keluar'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratKeluar  $surat_keluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $surat_keluar)
    {
        return view('surat_keluar.edit',compact('surat_keluar'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratKeluar  $surat_keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $surat_keluar)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
  
        $input = $request->all();
  
        if ($image = $request->file('file')) {
            $destinationPath = 'surat_keluar/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['file'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $input['tanggal_surat'] = date('Y-m-d');
          
        $surat_keluar->update($input);
    
        return redirect()->route('surat-keluar.index')
                        ->with('success','SuratKeluar updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratKeluar  $surat_keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $surat_keluar)
    {
        $surat_keluar->delete();
     
        return redirect()->route('surat-keluar.index')
                        ->with('success','SuratKeluar deleted successfully');
    }
}
