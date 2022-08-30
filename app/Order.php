<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Order extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function books() {
        //order dimiliki banyak book_order
        return $this->belongsToMany('App\Book'
                                , 'book_order'
                                , 'order_id'
                                , 'book_id')->withPivot('quantity', 'harga_satuan', 'subtotal');
    }

    public function insertBook($cart, $user){
        $total = 0;
        foreach($cart as $id => $details){
            $book = Book::find($id);
            if($book->stok >= $details['quantity']){
                $total += $details['price'] * $details['quantity'];
                $this->books()->attach($id, [
                    'quantity'=>$details['quantity'],
                    'harga_satuan'=>$details['price'],
                    'subtotal'=>$details['price']*$details['quantity']
                    ]);


                $book->stok -= $details['quantity'];
                $book->save();
            }
        }
        return $total;
    }
}
