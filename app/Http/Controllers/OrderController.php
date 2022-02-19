<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::query()
            ->with(array('pelanggan' => function ($query) {
                $query->select('idpelanggan', 'pelanggan');
            }))
            ->orderBy('status', 'asc')
            ->get();
        return response()->json($data);
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($a, $b)
    {
        // $order = Order::whereBetween('tgl_order', [$a, $b])->get();
        $order = Order::query()
            ->whereBetween('tgl_order', [$a, $b])
            ->with(array('pelanggan' => function ($query) {
                $query->select('idpelanggan', 'pelanggan');
            }))
            ->orderBy('status', 'asc')
            ->get();

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bayar' => 'required | numeric',
            'kembali' => 'required | numeric',
            'status' => 'required | numeric',
        ]);

        $data = [
            'bayar' => $request->input('bayar'),
            'kembali' => $request->input('kembali'),
            'status' => $request->input('status'),
        ];


        $order = Order::where('idorder', $id)->update($data);
        if ($order) {
            return response()->json([
                'pesan' => 'Pesanan sudah dibayar',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
