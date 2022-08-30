@extends('layouts.frontend')

@section('title', 'Riwayat')

@section('content')

    <p>
        <b>Kode Order: {{$order->id}}</b><br/>
        <b>Tanggal Order: {{$order->created_at}}</b><br/>
    </p>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $ob = $order->books; ?>


            @foreach($ob as $d)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ asset('uploads/books/'.$d->gambar) }}" width="100" height="100" alt="{{$d->gambar}}"
                                class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $d->title }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp. {{ $d->price }}</td>
                    <td data-th="Quantity">{{ $d->pivot->quantity }} </td>
                    <td data-th="Subtotal" class="text-center">Rp. {{ $d->pivot->subtotal }}</td>
                    <td class="actions" data-th="">
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{ $order->total_belanja }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/home') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Kembali ke Riwayat Pemesanan</a></td>
            <td class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total Rp. {{ $order->total_belanja }}</strong></td>
        </tr>
        </tfoot>
    </table>

@endsection

