<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class Payment extends BaseController
{

    protected $transaksi;
    public function __construct(){
        $this ->transaksi=new PaymentModel();
    }
    public function bayar()
    {
        $data['tagihan']=$this->transaksi->findAll();
        return view('pembayaran',$data);
    }

    public function proses(){

    $depan =$this->request->getVar('depan');
    $belakang =$this->request->getVar('belakang');
    $email =$this->request->getVar('email');
    $ponsel =$this->request->getVar('ponsel');
    $nominal =$this->request->getVar('nominal');
    $id_order=time();

    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = 'Mid-server-1BvPZNaT-5G94_yU4GcU-RBm';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = true;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    $params = array (
        'transaction_details' => array(
            'order_id' => time(),
            'gross_amount' => $nominal,
        ),
        'customer_details'=> array(
            'first_name' => $depan,
            'last_name' => $belakang,
            'email'=> $email,
            'phone'=>$ponsel,
        ),
    );

       $snapToken = \Midtrans\Snap::getSnapToken($params);
       $token=$snapToken;

       $data=[
        'id_transaksi' => $id_order,
        'nama_depan' => $depan,
        'nama_belakang' => $belakang,
        'email' => $email,
        'ponsel' => $ponsel,
        'nominal' => $nominal,
        'token'=>$token

       ];
       $this->transaksi->save($data);

       return redirect()->to('pembayaran');
  
   
    }

}