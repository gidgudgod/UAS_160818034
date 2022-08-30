<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Book::all();
        return view('book.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categori = Category::all();
        return view('book.createform',compact('categori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Book;
        $this->authorize('create', $data);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imgFile =time()."_". $file->getClientOriginalName();
        }else{
            $imgFile = "no image";
        }

        $data->title = $request->get('namaBuku');
        $data->publisher = $request->get('publisherBuku');
        $data->price = $request->get('hargaBuku');
        $data->idKategori = $request->get('kategoriBuku');
        $data->stok = $request->get('stokBuku');
        $data->gambar = $imgFile;


        if($data->save()){
            $path="uploads/books";
            $file->move($path, $imgFile);
            return redirect()->route('books.index')->with('status','Data Buku berhasil ditambah!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $data = $book;
        return view('book.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $data = $book;
        $categori = Category::all();
        return view('book.editform',compact('data', 'categori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imgFile =time()."_". $file->getClientOriginalName();
        }else{
            $imgFile = "no image";
        }

        $book->title = $request->get('namaBuku');
        $book->publisher = $request->get('publisherBuku');
        $book->price = $request->get('hargaBuku');
        $book->idKategori = $request->get('kategoriBuku');
        $book->stok = $request->get('stokBuku');
        $book->gambar = $imgFile;

        if($book->save()){
            $path="uploads/books";
            $file->move($path, $imgFile);
            return redirect()->route('books.index')->with('status','Data Buku berhasil diubah');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        try{
            $book->delete();
            return redirect()->route('books.index')->with('status','Data Buku berhasil dihapus');

        }catch(\PDOException $e){
            $msg = "Data Gagal Dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->route('books.index')->with('statusgagal', $msg);
        }

    }

    public function changePhoto(Request $request)
    {

        $id = $request->id;
        $book = Book::find($id);
        $this->authorize('update', $book);

        $file = $request->file('photo');
        $imgFolder = 'uploads/books';
        $imgFile = time() . '_' . $file->getClientOriginalName();
        $file->move($imgFolder, $imgFile);

        $book->gambar = $imgFile;
        $book->save();

        return redirect()->route('books.index')->with('status', 'Gambar Buku '.$book->title.' Berhasil Diubah :D');
    }
}
