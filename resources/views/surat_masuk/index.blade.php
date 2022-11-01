@extends('layouts.app')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Surat Masuk</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('surat-masuk.create') }}"> Tambah Surat Masuk</a>
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
            <th>Tgl Diterima</th>
            <th>Perihal</th>
            <th>Sifat</th>
            <th>Lampiran</th>
            <th>Kode Instansi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($surat_masuk as $sm)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $sm->tanggal_surat }}</td>
            <td>{{ $sm->tanggal_diterima }}</td>
            <td>{{ $sm->perihal }}</td>
            <td>{{ $sm->sifat }}</td>
            <td>{{ $sm->lampiran }}</td>
            <td>{{ $sm->kode_instansi }}</td>
            <td>
                <form action="{{ route('surat-masuk.destroy',$sm->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('surat-masuk.show',$sm->id) }}">Download</a>
      
                    <a class="btn btn-primary" href="{{ route('surat-masuk.edit',$sm->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $surat_masuk->links() !!}
        
@endsection