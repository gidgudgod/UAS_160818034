@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Buku Baru</div>

                <div class="card-body">
                <a href="{{route('books.index')}}"><< Kembali</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <hr/>
                    <form method="POST" action="{{ route('books.store')  }}" enctype="multipart/form-data">
                        <div class="form-group">
                                @csrf
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="namaBuku" required>
                            <small class="form-text text-muted">Isikan Judul Buku Anda</small>
                            <br/>
                            <label>Publisher </label>
                            <input type="text" class="form-control" name="publisherBuku" required>
                            <small class="form-text text-muted">Isikan Nama Badan Publisher Anda</small>

                            <br/>
                            <label>Harga Jual Buku </label>
                            <input type="number" class="form-control" name="hargaBuku" required>
                            <small class="form-text text-muted">Isikan Nominal Harga Buku Anda</small>

                            <br/>

                            <label>Stok Buku </label>
                            <input type="number" class="form-control" name="stokBuku" required>
                            <small class="form-text text-muted">Isikan Jumlah Stok Buku Anda</small>

                            <br/>

                            <label>Kategori Buku</label>
                            <select name="kategoriBuku" id="spls" required>

                                @foreach($categori as $s)
                                <option value="{{ $s->id }}"> <?php echo $s->name ?> </option>
                                @endforeach
                            </select>
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
