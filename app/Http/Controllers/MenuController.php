<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use File;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Menu::with('kategori')->get();
        $data = Menu::query()
            ->with(array('kategori' => function ($query) {
                $query->select('idkategori', 'kategori');
            }))
            ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'idkategori' => 'required | numeric',
            'menu' => 'required |unique:menus',
            'gambar' => 'image|max:2048|required',
            'harga' => 'required | numeric',
        ]);

        $filenameWithExt = $request->file('gambar')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('gambar')->getClientOriginalExtension();
        $filenameSimpan = $filename . '_' . time() . '.' . $extension;

        $request->file('gambar')->move('upload', $filenameSimpan);
        $data = [
            'idkategori' => $request->input('idkategori'),
            'menu' => $request->input('menu'),
            'gambar' => url('upload/' . $filenameSimpan),
            'harga' => $request->input('harga'),
        ];

        $menu = Menu::create($data);
        if ($menu) {
            return response()->json([
                'pesan' => 'Data sudah di simpan',
            ]);
        }
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data =  Menu::where('idmenu', $id)->with('kategori')->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($image = $request->file('gambar')) {
            $this->validate($request, [
                'idkategori' => 'required | numeric',
                'menu' => 'required',
                'gambar' => 'image|max:2048|required',
                'harga' => 'required | numeric',
            ]);
            $ambil_gambar = Menu::where('idmenu', $id)->first();
            $gambar = substr($ambil_gambar->gambar, 22);
            if (file_exists($gambar)) {
                unlink($gambar);
            } else {
                return 'Gagal Ubah Gambar';
            }

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;

            $image->move('upload', $filenameSimpan);
            $data = [
                'idkategori' => $request->input('idkategori'),
                'menu' => $request->input('menu'),
                'gambar' => url('upload/' . $filenameSimpan),
                'harga' => $request->input('harga'),
            ];
        } else {
            $this->validate($request, [
                'idkategori' => 'required | numeric',
                'menu' => 'required',
                'harga' => 'required | numeric',
            ]);

            $data = [
                'idkategori' => $request->input('idkategori'),
                'menu' => $request->input('menu'),
                'harga' => $request->input('harga'),
            ];
        }

        // return response()->json($data);

        $menu = Menu::where('idmenu', $id)->update($data);

        if ($menu) {
            return response()->json([
                'pesan' => 'Data sudah di ubah!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where('idmenu', $id)->first();

        $gambar = substr($menu->gambar, 22);
        if (file_exists($gambar)) {
            unlink($gambar);
            Menu::where('idmenu', $id)->delete();
            return response()->json([
                'pesan' => 'Data sudah dihapus!'
            ]);
        } else {
            return 'Gagal Hapus';
        }
    }
}
