<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Cart;
use App\CartDetail;
use App\Product;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->admin = 1) {
            
            $pedidos = DB::table('users')
                        ->join('carts', 'users.id', '=', 'carts.user_id')
                        ->join('cart_details', 'carts.id', '=', 'cart_details.cart_id')
                        ->join('products', 'products.id', '=', 'cart_details.product_id')
                        ->select('cart_details.id as detail_id', 'users.name as user_name', 'users.address', 'users.phone', 'products.name', 'products.price', 'cart_details.quantity')
                        ->where('cart_details.state', '=', 'sin atender')
                        ->whereNotNull('phone')
                        ->whereNotNull('address')
                        ->Where('carts.status', '=', 'Pending')
                        ->orderBy('detail_id', 'desc')
                        ->paginate(20);
    
            return view('admin.pedidos.index')->with(compact('pedidos'));
        } else {

            $details = CartDetail::all();

            return view('home', compact('details'));
        }

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $pedido = CartDetail::find($id);
        $pedido->state = 'Atendido';
        $pedido->update($request->all());

        return back();
    }

    public function destroy($id)
    {
        $pedido = CartDetail::find($id);
        $pedido->delete();

        return back();
    }
}
