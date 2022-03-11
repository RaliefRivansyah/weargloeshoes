<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\order;
use App\Models\product;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class OrderDec extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(
                'Weargloeshoes', 'Official Email'
            );
        });
        $order = order::find($this->id);
        $products = product::find($order->product_id);
        $user = User::find($order->user_id);
        $this->from("gloeshoesleather@gmail.com", "Weargloeshoes")
            ->view('orderconfirm')
            ->with(
                [
                    'nama' => $user->nama,
                    'nama_barang' => $products->product_name,
                    'type' => $products->product_type,
                    'gambar' => $order->product_image,
                    'harga_awal' => $products->price,
                    'diskon' => $products->discount,
                    'harga_now' => $order->price_now,
                    'total' => $order->total_price,
                    'quantity' => $order->quantity,
                    'alamat' => $order->alamat,
                    'no_telp' => $order->no_telp,
                    'bukti_tf' => $order->bukti_tf,
                    'status' => $order->status,
                    'no_rekening' => $order->no_rekening,
                    'website' => "weargloeshoes.com",
                    'link' => URL::to('/detailproduct/'. $order->product_id)
                ]
            )->subject("Weargloeshoes Order Konfirmation");
        return $this;
    }
}
