
@extends('layouts.frontend')

@section('title', 'Bookstore')

@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
    <div class="container books">

        <div class="row">

            @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{ asset('uploads/books/'.$product->gambar) }}" width="500" height="300">
                        <div class="caption">
                            <h4>{{ $product->title }}</h4>
                            <p>{{ Str::limit(strtolower(" Stok: ".$product->stok.", Publisher: ".$product->publisher.", Category: ".$product->category->name), 50) }}</p>
                            <p><strong>Price: </strong> Rp. {{ $product->price }}</p>
                        <p class="btn-holder"><a href="{{($product->stok > 0) ?  url('add-to-cart/'.$product->id) : '#' }}"
                               class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- End row -->

    </div>

@endsection
