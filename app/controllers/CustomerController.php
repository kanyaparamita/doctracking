<?php

class CustomerController extends \BaseController {

    public function find() {
        $rules = array (
            'ktp' => 'required|numeric',
            'password' => 'required'
        );

        // validate to operational database
        $verifier = App::make('validation.presence');
        $verifier->setConnection(Config::get('doctrack.operational_connection'));

        $validator = Validator::make(Input::all(), $rules);
        $validator->setPresenceVerifier($verifier);


        if ($validator->fails()) {
            return Redirect::to('login')
                ->with('message', 'Data anda tidak ditemukan');
        } else {
            $ktp = Input::get('ktp');
            $password = Input::get('password');

            // cari customer
            $customer = Customer::where('ktp', '=', $ktp)
                                ->first();

            if ($customer == null || Hash::check($customer->password, $password)) {
                return Redirect::to('login')
                    ->with('message', 'Data yang anda masukkan tidak terdaftar');
            } else {
                // simpan customer id ke session
                Session::put('customer_id', $customer->id);
                Session::put('customer_name', $customer->nama);
                // redirect ke list service
                return Redirect::to('outsider');
            }
        }
    }

    public function store() {
        $rules = array (
            'nama' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric|unique:customers,phone',
            'ktp' => 'required|numeric|min:16|unique:customers,ktp',
            'password' => 'required'
        );

        // validate to operational database
        $verifier = App::make('validation.presence');
        $verifier->setConnection(Config::get('doctrack.operational_connection'));

        $validator = Validator::make(Input::all(), $rules);
        $validator->setPresenceVerifier($verifier);

        //process
        if ($validator->fails()) {
            return Redirect::to('login')
                ->with('message', 'Format data yang anda masukkan salah / email, hp dan no ktp yang anda masukkan sudah terdaftar');
        } else {
            $customer = new Customer();
            $customer->nama = Input::get('nama');
            $customer->email = Input::get('email');
            $customer->phone = Input::get('phone');
            $customer->address = Input::get('address');
            $customer->ktp = Input::get('ktp');
            $customer->password = Hash::make(Input::get('password'));
            $customer->save();
            // simpan customer id ke session
            Session::put('customer_id', $customer->id);
            Session::put('customer_name', $customer->nama);
            // redirect ke list service
            return Redirect::to('outsider');
        }
    }

}