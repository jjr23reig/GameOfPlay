<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Cart;
use App\Models\Line;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;


class storeController extends Controller
{
    public function index(){
        
        return Inertia::render('Dashboard', [
            'games' => Game::all()
        ]);
    }
    public function showGame($id){
        $game = Game::find($id);
        return Inertia::render('Game', [
            'game' => $game
        ]);
    }

    public function addCart(Request $request){
        $idGame = $request->idGame;
        $idUser = $request->idUser;
        $cartExist = false;

        if(Cart::where('user_id',$idUser)->first()){
            $cartExist = true;
        }

        if(!$cartExist){
            var_dump('creamos un carrito');
            
            $cart = new Cart();
            $cart->user_id = $idUser;
            $cart->save();
            
        }

        var_dump('el carro ya existe');
        $cart = Cart::where('user_id',$idUser)->first();
        $idCart = $cart->id;
        
        var_dump($idCart);
        var_dump($idGame);
        
       

        DB::table('product_carts')->insert(['cart_id'=>$idCart, 'game_id'=>$idGame]);
        
        return Redirect::route('dashboard');
        
    }

    public function showCart($id){
        
        $cartExist = false;

        if(Cart::where('user_id',$id)->first()){
            $cartExist = true;
        }
        if(!$cartExist){
            var_dump('el carro no existe para este usuario');
            
            return Redirect::route('dashboard');
        }
        $cart=Cart::where('user_id',$id)->first();
        $idcart= $cart->id;
        

        $products=DB::table('games as g')
            ->rightJoin('product_carts as pc', 'g.id', '=', 'pc.game_id')
            ->select('pc.id as idAtCart','g.id', 'g.name','g.gender','g.price','g.description','g.photo')
            ->where('pc.cart_id',$idcart)
            ->orderBy('idAtCart')
            ->get();

        return Inertia::render('Cart', [
            'products' => $products
        ]);
    }

    public function deleteCart($id){
        $idCart=DB::table('product_carts')->select('cart_id')->where('id', $id)->get();
        $idCart=$idCart[0]->cart_id;
        $cart=Cart::find($idCart)->first();
        $idUser=$cart->user_id;
        
        
        DB::table('product_carts')->where('id', $id)->delete();

        return Redirect::route('cart',$idUser);
    }

    public function showPay($id){

        $user= User::find($id);
        $cart=Cart::where('user_id',$id)->first();
        $idcart= $cart->id;
        $total = 0;

        $products=DB::table('games as g')
            ->rightJoin('product_carts as pc', 'g.id', '=', 'pc.game_id')
            ->select('g.name','g.price','g.description','g.photo as image')
            ->where('pc.cart_id',$idcart)
            ->orderBy('pc.id')
            ->get();

        $stripe = new \Stripe\StripeClient(
            'sk_test_51IsOF3Gkh4ZqxVWi7ftRpVx7FbdklYG6EpI4XnwcFtH7RdqOJdeONTSPIYJPuAvRTBKM01b4weJhdUuIJ9dYdptT00WoUbA8b6'
        );
        if($user->card_brand == null){
            var_dump('no tiene tarjeta');
            return Redirect::route('cardbrand',$id);
            die();
        }
        foreach ($products as &$valor) {
            $total = $total + $valor->price;
        }

          $stripe->checkout->sessions->create([
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
            'payment_method_types' => ['card'],
            'client_reference_id'=>$user->stripe_id,
            'line_items' => [
              [
                'name'=>'Carrito',
                'currency'=> 'eur',
                'description' => 'Pago de compra del usuario '.$user->nick, 
                'amount'=>$total*100,
                'quantity' => 1,
              ],
            ],
            'mode' => 'payment',
          ]);

        return Redirect::route('dashboard');
        
    }

    public function cardInsert($id){
 
        $user= User::find($id);
        return Inertia::render('Card',[
            'intent' => $user->createSetupIntent()
        ]);
    }
    

    
        
        

    
}
