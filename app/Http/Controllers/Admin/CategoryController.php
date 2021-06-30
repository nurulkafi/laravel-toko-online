<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Categories";
        $data = Category::get();
        return view('admin.categories.index',compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Categories";
        return view('admin.categories.formAdd', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = "Add Categories";
        $categories = $request->categories;
        $slug = Str::slug($categories);
        $parent_id = 0;
        Category::create(
            [
                'name' => $categories,
                'slug' => $slug,
                'parent_id' => $parent_id
            ]
        );

        Alert::success('Tambah Data','Berhasil');
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Category::find($id);
        $title = "Edit Data";
        return view('admin.categories.formEdit',compact('data','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = "Add Categories";
        $categories = $request->categories;
        $slug = Str::slug($categories);
        $parent_id = 0;
        Category::where('id',$id)->first()->update([
            'name' => $categories,
            'slug' => $slug
        ]);
        Alert::success('Update Data', 'Berhasil');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Category::where('id',$id)->delete();
        Alert::success('Hapus Data','Data Berhasil Dihapus');
        return redirect('/admin/categories');
    }
}
