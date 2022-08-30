@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Buku</div>

                <div class="card-body">
                <a href="{{route('books.create')}}">+ Tambah Buku Baru</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('statusgagal'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('statusgagal') }}
                        </div>
                    @endif



                    <table id="nota" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:10%">Kode</th>
                            <th style="width:30%">Nama Buku</th>
                            <th style="width:30%" class="text-center">Publisher</th>
                            <th style="width:20%" class="text-center">Harga</th>
                            <th style="width:10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $t)
                            <tr>
                                <td data-th="Kode">
                                   {{ $t->id }}
                                </td>
                                <td data-th="Judul">{{ $t->title }}</td>
                                <td data-th="Publisher">
                                    {{ $t->publisher }}
                                </td>
                                <td data-th="Harga">
                                    Rp. {{ $t->price }}
                                </td>

                                <td class="actions" data-th="">
                                    {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_photo_{{$t->id}}">Change</button> --}}

                                    <a class="btn btn-info btn-sm update-cart" data-id="{{ $t->id }}"
                                        href="{{ route ('books.show',$t->id) }} ">View</a>

                                    <a href="{{route('books.edit', $t->id)}}" class="btn btn-primary btn-sm update-cart">
                                        Edit
                                    </a>

                                    @can('delete', $t)
                                    <form method='POST' action="{{route('books.destroy', $t->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm btn-xs"
                                    onclick="if(!confirm('Apakah Anda yakin ingin menghapus buku {{$t->title}}?')) return false;"/>
                                    </form>
                                    @endcan
                                </td>
                            </tr>

                            {{-- <div class="modal fade" id="modal_photo_{{$t->id}}" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                    <form method="POST" action="{{url('admin/changePhoto')}}" enctype="multipart/form-data" id="form_modal_{{$t->id}}">

                                        <p><img src="{{ asset('uploads/books/'.$t->gambar) }}" style="max-width: 400px;" alt="{{$t->gambar}}"></p>
                                        <div class="form-group row">
                                            <label for="photo" class="col-sm-2 col-form-label">New Photo</label>
                                            <div class="col-sm-10">
                                            <input type="file" value="" name="photo" class="form-control" id="photo" accept="image/*" required>
                                            </div>
                                            <input type="hidden" name="id" value="{{$t->id}}">

                                        </div>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary" form="form_modal_{{$t->id}}">
                                            Simpan
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                  </div>

                                </div>
                            </div> --}}
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
