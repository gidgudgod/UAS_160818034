@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Buku</div>

                <div class="card-body">
                <a href="{{route('books.index')}}"><< Kembali</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <hr/>
                    <form method="POST" action="{{ route('books.update', $data->id)  }}" enctype="multipart/form-data">
                        <div class="form-group">
                                @csrf
                                @method('PUT')
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="namaBuku" value="{{$data->title}}" required>
                            <small class="form-text text-muted">Isikan Judul Buku Anda</small>
                            <br/>
                            <label>Publisher </label>
                            <input type="text" class="form-control" name="publisherBuku" value="{{$data->publisher}}" required>
                            <small class="form-text text-muted">Isikan Nama Badan Publisher Anda</small>

                            <br/>
                            <label>Harga Jual Buku </label>
                            <input type="number" class="form-control" name="hargaBuku" value="{{$data->price}}" required>
                            <small class="form-text text-muted">Isikan Nominal Harga Buku Anda</small>

                            <br/>

                            <label>Stok Buku </label>
                            <input type="number" class="form-control" name="stokBuku"  value="{{$data->stok}}" required>
                            <small class="form-text text-muted">Isikan Jumlah Stok Buku Anda</small>

                            <br/>

                            <label>Kategori Buku</label>
                            <select name="kategoriBuku" id="spls" required>

                                @foreach($categori as $s)
                                @if($data->idKategori == $s->id)
                                <option value="{{ $s->id }}" selected> <?php echo $s->name ?> </option>
                                @else
                                <option value="{{ $s->id }}"> <?php echo $s->name ?> </option>
                                @endif

                                @endforeach
                            </select>
                            <br/>
                            <img src="{{ asset('uploads/books/'.$data->gambar) }}" style="max-width: 400px;" alt="{{$data->gambar}}">
                            <br/>
                            <label class="custom-file-label" for="image">Choose Image</label>
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
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
