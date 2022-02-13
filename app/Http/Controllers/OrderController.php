<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use App\Models\product;
use App\Mail\OrderAcc;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
    public function insertOrder(Request $request, $id)
    {

        $productId = $id;
        $userName = session('user');

        DB::table('orders')->insert([
            'user_id' =>  session()->has('user_id'),
            'product_id' => $productId
        ]);

        return redirect('/shoes');
    }


    public function getOrder()
    {
        $userOrder = session('user');
        if (session('success')) {
            $orders = DB::table('orders')->where('user_name', $userOrder)->get();
            return view('pages.cart', ['orders' => $orders]);
        } else {
            return redirect('/login-register');
        }
    }

    public function deleteOrder($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect('/cart');
    }

    public function index()
    {
        if(session()->get('auth')->level != 1){
        $payment = order::with('user', 'product')->where('user_id', session()->get('auth')->id)->first();
        // dd($payment);
        if(!empty($payment)) $payment = order::where('user_id', session()->get('auth')->id)->get();
        }else $payment = order::all();
        view()->share([
            'payment' => $payment
        ]);
        return view('statusorder');
    }

    public function order($id, Request $request)
    { 
        $request->validate([
            'quantity' => 'required',
            'price_now' => 'required',
            'total_price' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic,heif,hevc,pdf|max:50048'
        ]);
        $data = new order();
        $product = product::find($id);
        $data->user_id =  session()->get('auth')->id;
        $data->product_id = $id;
        $data->product_image = asset('images/'.$product->product_image);
        $data->quantity = $request->quantity;
        $data->price_now = $request->price_now;
        $data->total_price = $request->total_price;
        $data->alamat = $request->alamat;
        $data->no_telp = $request->no_telp;
        $photo = $request->file('bukti_tf');
        $path = 'bukti_tf';
        $string = rand(22, 10003);
        if( $photo != NULL){
            $fileName = $string . '___buktitfmasuk.'.$photo->getClientOriginalExtension();
            $photo->move($path, $fileName);
            $data->bukti_tf = $path .'/'. $fileName;
        }
        $data->save();
        return redirect()->route('order.status')
        ->with('berhasil', 'Pesananmu berhasil, Harap Menunggu untuk konfirmasi Seller!');

    }

    public function preview($id)
    {
        $data = order::find($id);
        $image = $data->bukti_tf;
        view()->share([
            'image' => $image
        ]);
        return view('preview');
    }

    public function konfirmAcc($id)
    {
        if(session()->get('auth')->level == 1){
            $data = order::find($id);
            $data->status = 1;
            $data->save();
            $customer = User::find($data->user_id);
            Mail::to($customer->email, 'Weargloeshoes')->send(new OrderAcc($id));
            return redirect()->route('order.status')
            ->with('berhasil', 'Berhasil dikonfirmasi!');
        }else return redirect()->route('order.status')
        ->with('gagal', 'Tidak ada akses!');
    }

    public function konfirmDec($id)
    {
        if(session()->get('auth')->level == 1){
            $data = order::find($id);
            $data->status = 2;
            $data->save();
            $customer = User::find($data->user_id);
            Mail::to($customer->email, 'Weargloeshoes')->send(new OrderAcc($id));
            return redirect()->route('order.status')
            ->with('berhasil', 'Konfirmasi ditolak!');
        }else return redirect()->route('order.status')
        ->with('gagal', 'Tidak ada akses!');
    }

    public function konfirmAgain($id)
    {
        if(session()->get('auth')->level == 1){
            $data = order::find($id);
            $data->status = 1;
            $data->save();
            $customer = User::find($data->user_id);
            Mail::to($customer->email, 'Weargloeshoes')->send(new OrderAcc($id)); 
            return redirect()->route('order.status')
            ->with('berhasil', 'Berhasil dikonfirmasi ulang!');
        }else return redirect()->route('order.status')
        ->with('gagal', 'Tidak ada akses!');
    }

    public function update($id, Request $request)
    { 
        $request->validate([
            'quantity' => 'required',
            'price_now' => 'required',
            'total_price' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);
        $data = order::find($id);
        $product = product::find($data->product_id);
        $data->user_id =  session()->get('auth')->id;
        // $data->product_id = $id;
        $data->product_image = asset('images/'.$product->product_image);
        $data->quantity = $request->quantity;
        $data->price_now = $request->price_now;
        $data->total_price = $request->total_price;
        $data->alamat = $request->alamat;
        $data->no_telp = $request->no_telp;
        $photo = $request->file('bukti_tf');
        $path = 'bukti_tf';
        $string = rand(22, 10003);
        if( $photo != NULL){
            $fileName = $string . '___buktitfmasuk.'.$photo->getClientOriginalExtension();
            $photo->move($path, $fileName);
            $data->bukti_tf = $path .'/'. $fileName;
        }
        $data->save();
        return redirect()->route('order.status')
        ->with('berhasil', 'Pesananmu berhasil diedit, Harap Menunggu untuk konfirmasi Seller!');

    }

    public function updateBukti($id, Request $request)
    { 
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic,heif,hevc,pdf|max:50048'
        ]);
        $data = order::find($id);
        $product = product::find($data->product_id);
        $data->user_id =  session()->get('auth')->id;
        $photo = $request->file('bukti_tf');
        $path = 'bukti_tf';
        $string = rand(22, 10003);
        if( $photo != NULL){
            $fileName = $string . '___buktitfmasuk.'.$photo->getClientOriginalExtension();
            $photo->move($path, $fileName);
            $data->bukti_tf = $path .'/'. $fileName;
        }
        $data->status = 0;
        $data->save();
        return redirect()->route('order.status')
        ->with('berhasil', 'Bukti ulang berhasil diedit, Harap Menunggu untuk konfirmasi Seller!');

    }

    public function delete($id)
    {
        order::find($id)->delete();
        return redirect()->route('order.status')
            ->with('berhasil', 'Berhasil dihapus!');
    }

    public function reset()
    {
        order::truncate();
        echo "sukses reset";
    }
}
