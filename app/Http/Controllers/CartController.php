<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function update()
    {
    	$client = auth()->user(); 
    	$cart = $client->cart;
    	$cart->status = 'Pending';
    	$cart->order_date = Carbon::now();
    	$cart->save(); // UPDATE

        $cantidad = collect([]);
        $clave = collect([]);
        //dd($cart->details);
        //foreach($cart->details as $key => $detail) {
            //@php
                //echo "{$clave} => {$detail} ";
                //print_r($detail);
            //@endphp
             //$clave->push($key);
        //}
            $space = '%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20';

            $data = '';
            $data .= $space . '* * *' . $space;
            $data .= 'CLIENTE:' . $space;
            $data .= 'NOMBRE: ' . $client->name . $space . 'CELULAR: ' . $client->phone. $space . 'DIRECCIÓN: ' . $client->address . $space;
            $data .= $space . '* * *' . $space;
            $data .= 'MIS PEDIDOS:' . $space;
            foreach($cart->details as $detail){
                $data .= 'x' . $detail->quantity . ' ' . '-' . ' ' . $detail->product->name . ' ' . 'S/' . $detail->quantity * $detail->product->price . '' . $space;
            }
            $data .= $space . '* * *' . $space;
            $data .= 'TOTAL A PAGAR: S/' . $cart->total;
            //$data .= '</div>';



        //dd($cantid);
        $myarray = $cantidad;
        //$myarray->implode(' ', $cantidad);

    	// $admins = User::where('admin', true)->get();
    	// Mail::to($admins)->send(new NewOrder($client, $cart));

    	$notification = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía WhatsApp!';

    	//return back()->with(compact('notification'));
        return new RedirectResponse("https://api.whatsapp.com/send?phone=+51980751862&text=Hola! Necesito los siguientes productos por favor: %20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20 {$data}");
    }
}
