@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @can('viewBackend')

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                    @elsecan('viewFrontend')
                    <h1>Riwayat Transaksi</h1>
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10%">Kode</th>
                                <th style="width: 50%">Waktu Transaksi</th>
                                <th style="width: 30%">Total</th>
                                <th style="width: 10%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $o)
                            <tr>
                                <td>{{$o->id}}</td>
                                <td>{{$o->created_at}}</td>
                                <td>{{$o->total_belanja}}</td>
                                <td>
                                <a href="{{route('member.orders.show', $o->id)}}" class="btn btn-info btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
