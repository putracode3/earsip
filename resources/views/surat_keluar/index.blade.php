@extends('layouts.app')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Surat Keluar</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('surat-keluar.create') }}"> Tambah Surat Keluar</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tgl Surat</th>
            <th>Tgl Keluar</th>
            <th>Perihal</th>
            <th>Sifat</th>
            <th>Lampiran</th>
            <th>Kode Instansi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($surat_keluar as $sm)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $sm->tanggal_surat }}</td>
            <td>{{ $sm->tanggal_keluar }}</td>
            <td>{{ $sm->perihal }}</td>
            <td>{{ $sm->sifat }}</td>
            <td>{{ $sm->lampiran }}</td>
            <td>{{ $sm->kode_instansi }}</td>
            <td>
                <form action="{{ route('surat-keluar.destroy',$sm->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('surat-keluar.show',$sm->id) }}">Download</a>
      
                    <a class="btn btn-primary" href="{{ route('surat-keluar.edit',$sm->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $surat_keluar->links() !!}
        
@endsection