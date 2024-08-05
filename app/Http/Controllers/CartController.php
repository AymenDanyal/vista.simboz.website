<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;
class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function index(){
        $cartTotal = 0;
        $totalSaved = 0;
        $cartQuantity = 0;
        $subtotal= 0;
        $cartItems = Cart::where('user_id', Auth()->user()->id)->with('product')->get();

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $originalPrice = $product->price;
                $subtotal+=$originalPrice*$cartItem->quantity;
                $discount = $product->discount;
                $discountedPrice = round($originalPrice - ($originalPrice * $discount / 100));
                $amountSavedPerItem = round(($originalPrice - $discountedPrice) * $cartItem->quantity);
                
                $totalSaved += round($amountSavedPerItem);
                $cartTotal += $cartItem->amount; // Using $cartItem->amount to get the amount after discount for each item
            }

        return view('frontend.pages.cart',compact('cartTotal','totalSaved','subtotal'));
    }
    public function addToCart(Request $request){
       //  dd($request->all());
       
        if (empty($request->id)) {
  
            return back();
        }        
        $product = Product::where('id', $request->id)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = 1;
            $cart->amount=$cart->price*$cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        $notification = view('frontend.layouts.notification')->render();
        
        
        request()->session()->flash('success','Product successfully added to cart');
        return response()->json([
            'success' => true,
            'reloadCart' => $reloadCart,
        ]);     
    }  

    public function singleAddToCart($slug){
        
        // dd($request->quant[1]);

        $quantity=1;
        $product = Product::where('slug', $slug)->first();
        if($product->stock <$quantity){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($quantity < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }    

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();

        // return $already_cart;

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $quantity;
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($product->price * $quantity)+ $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');

            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = $quantity;
            $cart->amount=($product->price *$quantity);
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();       
    } 
     
    public function cartDelete($id){
        $cart = Cart::find($id);
       
        if ($cart) {
            $cart->delete();
            $cartTotal=Helper::cartCount();
            request()->session()->flash('success','Cart successfully removed');
            return response()->json([
                'message' => 'Cart deleted.',
                'cartTotal'=>$cartTotal,
            ]);  
        }
        request()->session()->flash('error','Error please try again');
        return response()->json([
            'message' => 'Error Cart not found.'
        ]);
    }     

    public function cartUpdate(Request $request)
    {
        $quantity = $request->quantity;
        $cartId = $request->cartId;

        // Retrieve the cart item along with its product information
        $cart = Cart::where('id', $cartId)->with('product')->first();

        // Check if the cart item exists
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $product = $cart->product;
        $originalPrice = $product->price;
        $discount = $product->discount;
        $discountedPrice = $originalPrice - ($originalPrice * $discount / 100);
        $amountSavedPerItem = ($originalPrice - $discountedPrice) * $quantity;

        // Update the cart quantity
        $cart->quantity = $quantity;
        $cart->price = $discountedPrice;
        $cart->amount = round($cart->quantity * $cart->price);

        if ($cart->quantity <= 0) {
            // Delete the cart item if quantity is zero or less
            $cart->delete();
            return response()->json(['message' => 'Cart item removed'], 200);
        } else {
            // Save the updated cart item
            $cart->save();

            // Calculate the total cart value for the user
            $cartTotal = 0;
            $totalSaved = 0;
            $cartQuantity = 0;
            $cartItems = Cart::where('user_id', $cart->user_id)->with('product')->get();

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $originalPrice = $product->price;
                $discount = $product->discount;
                $discountedPrice = round($originalPrice - ($originalPrice * $discount / 100));
                $amountSavedPerItem = round(($originalPrice - $discountedPrice) * $cartItem->quantity);

                $cartQuantity += $cartItem->quantity;
                $totalSaved += round($amountSavedPerItem);
                $cartTotal += $cartItem->amount; // Using $cartItem->amount to get the amount after discount for each item
            }

            // Return the updated cart information as a JSON response
            return response()->json([
                'cartId' => $cart->id,
                'quantity' => $cart->quantity,
                'priceBeforeDiscount' => $originalPrice,
                'priceAfterDiscount' => $discountedPrice,
                'amount' => $cart->amount,
                'discount' => $discount,
                'amountSaved' => $amountSavedPerItem, // Amount saved for this specific item
                'totalSaved' => $totalSaved, // Total amount saved for the entire cart
                'cartTotal' => $cartTotal,
                'cartQuantity' => $cartQuantity, // Total quantity of items in the cart
            ]);
        }
    }


    // public function addToCart(Request $request){
    //     // return $request->all();
    //     if(Auth::check()){
    //         $qty=$request->quantity;
    //         $this->product=$this->product->find($request->pro_id);
    //         if($this->product->stock < $qty){
    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);
    //         }
    //         if(!$this->product){
    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);
    //         }
    //         // $session_id=session('cart')['session_id'];
    //         // if(empty($session_id)){
    //         //     $session_id=Str::random(30);
    //         //     // dd($session_id);
    //         //     session()->put('session_id',$session_id);
    //         // }
    //         $current_item=array(
    //             'user_id'=>auth()->user()->id,
    //             'id'=>$this->product->id,
    //             // 'session_id'=>$session_id,
    //             'title'=>$this->product->title,
    //             'summary'=>$this->product->summary,
    //             'link'=>route('product-detail',$this->product->slug),
    //             'price'=>$this->product->price,
    //             'photo'=>$this->product->photo,
    //         );
            
    //         $price=$this->product->price;
    //         if($this->product->discount){
    //             $price=($price-($price*$this->product->discount)/100);
    //         }
    //         $current_item['price']=$price;

    //         $cart=session('cart') ? session('cart') : null;

    //         if($cart){
    //             // if anyone alreay order products
    //             $index=null;
    //             foreach($cart as $key=>$value){
    //                 if($value['id']==$this->product->id){
    //                     $index=$key;
    //                 break;
    //                 }
    //             }
    //             if($index!==null){
    //                 $cart[$index]['quantity']=$qty;
    //                 $cart[$index]['amount']=ceil($qty*$price);
    //                 if($cart[$index]['quantity']<=0){
    //                     unset($cart[$index]);
    //                 }
    //             }
    //             else{
    //                 $current_item['quantity']=$qty;
    //                 $current_item['amount']=ceil($qty*$price);
    //                 $cart[]=$current_item;
    //             }
    //         }
    //         else{
    //             $current_item['quantity']=$qty;
    //             $current_item['amount']=ceil($qty*$price);
    //             $cart[]=$current_item;
    //         }

    //         session()->put('cart',$cart);
    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);
    //     }
    //     else{
    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
    //     }
    // }

    public function removeCart(Request $request){
        $index=$request->index;
        // return $index;
        $cart=session('cart');
        unset($cart[$index]);
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Successfully remove item');
    }

    public function checkout(Request $request){
        $cartTotal = 0;
        $totalSaved = 0;
        $cartQuantity = 0;
        $subtotal= 0;
        $cartItems = Cart::where('user_id', Auth()->user()->id)->with('product')->get();

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $originalPrice = $product->price;
                $subtotal+=$originalPrice*$cartItem->quantity;
                $discount = $product->discount;
                $discountedPrice = round($originalPrice - ($originalPrice * $discount / 100));
                $amountSavedPerItem = round(($originalPrice - $discountedPrice) * $cartItem->quantity);
                
                $totalSaved += round($amountSavedPerItem);
                $cartTotal += $cartItem->amount; // Using $cartItem->amount to get the amount after discount for each item
            }

        return view('frontend.pages.checkout',compact('cartTotal','totalSaved','subtotal'));
    
    }
}
