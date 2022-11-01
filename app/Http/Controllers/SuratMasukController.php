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
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        SuratMasuk::create($input);
     
        return redirect()->route('surat_masuk.index')
                        ->with('success','SuratMasuk created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\SuratMasuk  $product
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $product)
    {
        return view('surat_masuk.show',compact('product'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratMasuk  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $product)
    {
        return view('surat_masuk.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratMasuk  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $product->update($input);
    
        return redirect()->route('surat_masuk.index')
                        ->with('success','SuratMasuk updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratMasuk  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $product)
    {
        $product->delete();
     
        return redirect()->route('surat_masuk.index')
                        ->with('success','SuratMasuk deleted successfully');
    }
}
