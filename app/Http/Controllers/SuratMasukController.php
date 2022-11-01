<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_masuk = SuratMasuk::latest()->paginate(5);
    
        return view('surat_masuk.index',compact('surat_masuk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_masuk.create');
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
            $destinationPath = 'surat_masuk/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['file'] = "$profileImage";
        }
        $input['tanggal_surat'] = date('Y-m-d');
    
        SuratMasuk::create($input);
     
        return redirect()->route('surat-masuk.index')
            ->with('success','SuratMasuk created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\SuratMasuk  $surat_masuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $surat_masuk)
    {
        $filePath = public_path("surat_masuk/".$surat_masuk->file);
        return response()->download($filePath);

        // return view('surat_masuk.show',compact('surat_masuk'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratMasuk  $surat_masuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $surat_masuk)
    {
        return view('surat_masuk.edit',compact('surat_masuk'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratMasuk  $surat_masuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
  
        $input = $request->all();
  
        if ($image = $request->file('file')) {
            $destinationPath = 'surat_masuk/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['file'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $input['tanggal_surat'] = date('Y-m-d');
          
        $surat_masuk->update($input);
    
        return redirect()->route('surat-masuk.index')
                        ->with('success','SuratMasuk updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratMasuk  $surat_masuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $surat_masuk)
    {
        $surat_masuk->delete();
     
        return redirect()->route('surat-masuk.index')
                        ->with('success','SuratMasuk deleted successfully');
    }
}
