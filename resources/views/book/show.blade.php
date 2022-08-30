@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Buku <strong>{{$data->title}}</strong></div>

                <div class="card-body">
                    <a href="{{route('books.index')}}"><< Kembali</a>
                    <hr>
                <img src="{{ asset('uploads/books/'.$data->gambar) }}" style="max-width: 400px;" alt="{{$data->gambar}}">

                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:30%">Data</th>
                            <th style="width:70%">Hasil</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-th="Kode"> Kode </td>
                                <td data-th="Kode">
                                   {{ $data->id }}
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Judul"> Judul </td>
                                <td data-th="Judul">{{ $data->title }}</td>
                            </tr>
                            <tr>
                                <td data-th="Publisher"> Publisher </td>
                                <td data-th="Publisher">
                                    {{ $data->publisher }}
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Harga"> Harga </td>
                                <td data-th="Harga">
                                    Rp. {{ $data->price }}
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Stok"> Stok </td>
                                <td data-th="Stok">
                                    {{ $data->stok }}
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Kategori"> Kategori </td>
                                <td data-th="Kategori">
                                    {{ $data->category->name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
