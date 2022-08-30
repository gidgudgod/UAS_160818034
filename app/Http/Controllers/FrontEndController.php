<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $products = Book::all();
        return view('frontend.index', compact('products'));
    }
    public function cart()
    {
        return view('frontend.cart');
    }

    public function addToCart($id)
    {
        $book = Book::find($id);
        if(!$book){
            abort('404');
        }

        if($book->stok > 0){
            $cart = session()->get('cart');
            if(!isset($cart[$id])){
                $cart[$id] = [
                    'name' => $book->title,
                    'quantity' => 1,
                    'price' =>$book->price,
                    'photo' =>$book->gambar
                ];
            }else{
                $quantity = $cart[$id]['quantity'];
                if($book->stok >= ($quantity+1)){
                    $cart[$id]['quantity'] ++;
                }else{
                    return redirect()->back()->with('error', 'Stok Buku '.$book->title.' tidak mencukupi, gagal menambah ke keranjang');
                }
            }
        }else{
            return redirect()->back()->with('error', 'Stok Buku '.$book->title.' habis, gagal menambah ke keranjang');
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Buku '.$book->title.' added to cart successfully');
    }

    public function deleteFromCart($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            session()->forget('cart.'.$id);
            return redirect('/');
        }else{
            return redirect()->back()->with('error', 'Gagal menghapus buku dari keranjang');
        }
    }
}
