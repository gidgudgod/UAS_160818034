@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kategori Buku</div>

                <div class="card-body">
                <a href="{{route('category.index')}}"><< Kembali</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <hr/>
                    <form method="POST" action="{{ route('category.update', $data->id)  }}">
                        <div class="form-group">
                                @csrf
                                @method('PUT')
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="namaKategori" value="{{$data->name}}" required>
                            <small class="form-text text-muted">Isikan Nama Kategori Buku Anda</small>
                            <br/>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
