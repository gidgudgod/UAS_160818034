<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Category::all();
        return view('category.index', compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.createform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Category();
        $this->authorize('create', $data);

        $data->name = $request->get('namaKategori');
        $data->save();
        return redirect()->route('category.index')->with('status','Data Kategori berhasil ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data = $category;
        return view('category.editform', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->name = $request->get('namaKategori');
        $category->save();
        return redirect()->route('category.index')->with('status','Data Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        try {
            // $this->handleAllRemoveChild($category);
            // $msg = $this->handleAllRemoveChild($category);
            $category->delete();
            return redirect()->route('category.index')->with('status','Data Kategori berhasil dihapus');
        } catch (\PDOException $e) {
            $msg="Data Gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->route('category.index')->with('error',
                $msg);
        }
    }

    //HINT untuk bantuan menghapus data child
    private function handleAllRemoveChild($s)
    {
        $s->books()->delete();
        $s->delete();
        return "Data dihapus beserta data yang berinteraksi dengan Kategori: $s->name";
    }

    private function handleChildWithDefault($s)
    {
        $ps = $s->books();
        $alternatif = Category::where('id','<>',$s->id)->first();
        foreach($ps as $p)
        {
            $p->idKategori = ($alternatif)->id;
            $p->save();
        }
        $s->delete();

        return "Data dihapus dan beserta data yang berinteraksi dengan tersebut dialihkan kepada $alternatif->name";
    }
}
