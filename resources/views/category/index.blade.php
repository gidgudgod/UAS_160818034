@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Kategori Buku</div>

                <div class="card-body">
                <a href="{{route('category.create')}}">+ Tambah Kategori Baru</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif



                    <table id="nota" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:10%">Kode</th>
                            <th style="width:80%">Nama Kategori</th>
                            <th style="width:10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $t)
                            <tr>
                                <td data-th="Kode">
                                   {{ $t->id }}
                                </td>
                                <td data-th="Nama Kategori">{{ $t->name }}</td>

                                <td class="actions" data-th="">
                                    <a href="{{route('category.edit', $t->id)}}" class="btn btn-primary btn-sm update-cart">
                                        Edit
                                    </a>

                                    @can('delete', $t)
                                    <form method='POST' action="{{route('category.destroy', $t->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm btn-xs"
                                    onclick="if(!confirm('Apakah Anda yakin ingin menghapus kategori {{$t->name}}?')) return false;"/>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
