<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('frontend.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function form_submit_front()
    {
        $this->authorize('viewFrontend');
        return view('frontend.checkout');
    }

    public function submit_front()
    {
        $this->authorize('viewFrontend');

        $cart = session()->get('cart');
        if(isset($cart) && count((array) session('cart')) > 0){
            $user = Auth::user();

            foreach($cart as $id => $details){
                $book = Book::find($id);
                if($book->stok < $details['quantity']){
                    return redirect('/')->with('error', 'Stok buku '. $book->title.' HABIS!');
                }
            }
            $o = new Order;
            $o->user_id = $user->id;
            $o->created_at = Carbon::now()->toDateTimeString();
            $o->updated_at = Carbon::now()->toDateTimeString();
            $o->total_belanja = 0;
            $o->save();

            $total_harga = $o->insertBook($cart, $user);
            $o->total_belanja = $total_harga;
            $o->save();

            session()->forget('cart');
            return redirect()->route('home');
        }else{
            return redirect('/')->with('error', 'Keranjang Kosong!');
        }

    }
}
