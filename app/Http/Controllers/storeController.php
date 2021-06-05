<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Cart;
use App\Models\Faq;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;


class storeController extends Controller
{
    public function index(){
        
        return Inertia::render('Dashboard', [
            'games' => Game::all(),
            'users' => User::where('role_id',1)->get()

        ]);
    }
    public function showGame($id){
        $game = Game::find($id);
        return Inertia::render('Game', [
            'game' => $game
        ]);
    }
    public function library(){
        $user = Auth::user();
        $games = DB::table('purchase_products as pp')
                                ->rightjoin('games as g', 'pp.game_id', '=', 'g.id')
                                ->leftjoin('purchases as p', 'pp.purchase_id', '=', 'p.id')
                                ->select('g.name','g.gender','g.description','g.photo')
                                ->where('p.user_id', $user->id)
                                ->get();
       
        return Inertia::render('Library', [
            'games'=>$games
        ]);
    }
    public function showUser($id){
        $user = User::find($id);

        $products = DB::table('purchase_products as pp')
                                ->rightjoin('games as g', 'pp.game_id', '=', 'g.id')
                                ->leftjoin('purchases as p', 'pp.purchase_id', '=', 'p.id')
                                ->select('g.name','g.gender','g.description','g.photo')
                                ->where('p.user_id', $id)
                                ->get();

        
        return Inertia::render('Userpage', [
            'client' => $user,
            'games' => $products
        ]);
        
    }

    public function chatWithUser($id){
        $user = User::find($id);
        $faqs = Faq::where('user_id', $user->id)->get();
       
        return Inertia::render('Faqs',[
            'faqs' => $faqs,
            'client' => $user
        ]);
    }

    public function support(){
        $user = Auth::user();
        $faqs = Faq::where('user_id', $user->id)->get();
        
        return Inertia::render('Support',[
            'faqs' => $faqs
        ]);
    }
    public function addFaq(Request $request){

        $user = Auth::user();
        var_dump($user->role_id);

        if($user->role_id == 1){
            $faq = new Faq();
            $faq->user_id = $user->id;
            $faq->ask = $request->faq;
            $faq->save();

            return Redirect::route('support');
        }
        else{
            
            $faq = Faq::find($request->id);
            $faq->answer = $request->faq;
            $faq->save();
            
            
            return Redirect::route('userchat',$faq->user_id);
        }
        
    }

    public function respondFaq($id){
        $faq = Faq::find($id);

        return Inertia::render('Respond', [
            'faq' => $faq
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
            ->select('g.id','g.name','g.price','g.description','g.photo as image')
            ->where('pc.cart_id',$idcart)
            ->orderBy('pc.id')
            ->get();

        $stripe = new \Stripe\StripeClient(
            'sk_test_51IsOF3Gkh4ZqxVWi7ftRpVx7FbdklYG6EpI4XnwcFtH7RdqOJdeONTSPIYJPuAvRTBKM01b4weJhdUuIJ9dYdptT00WoUbA8b6'
        );
        
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

         
        
        $purchase = new Purchase();
        $purchase->user_id = $id;
        $purchase->save();

        foreach ($products as &$valor) {
            $total = $total + $valor->id;
            DB::table('purchase_products')->insert(['purchase_id'=>$purchase->id, 'game_id'=>$valor->id]);
        }
        
        
        Cart::where('user_id',$id)->delete();

        return Redirect::route('dashboard');
        
    }

    
    

    
        
        

    
}
