<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function getCity($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ". $this->Settings_model->general()["api_rajaongkir"]
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response =  json_decode($response, true);
            return $response['rajaongkir']['results'];
        }
    }

    public function getProvinces(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ". $this->Settings_model->general()["api_rajaongkir"]
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response =  json_decode($response, true);
            return $response['rajaongkir']['results'];
        }
    }

    public function getService($kurir){
        $dbSetting = $this->db->get('settings')->row_array();
        $origin = $dbSetting['regency_id'];
        $destination = $this->input->post('destination');

        $weight = 0;
        foreach ($this->cart->contents() as $key) {
            $weight += ($key['weight'] * $key['qty']);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin."&originType=city&destination=".$destination."&destinationType=city&weight=".$weight."&courier=".$kurir."",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ". $this->Settings_model->general()["api_rajaongkir"]
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            return $response['rajaongkir']['results'][0]['costs'];
        }
    }

    public function succesfully(){
        $sett = $this->db->get('settings')->row_array();
        $invoice = substr(time(),7) . substr(rand(),0,3);
        $name = $this->input->post('name', true);
        $telp = $this->input->post('telp', true);
        $province = $this->input->post('paymentSelectProvinces', true);
        $district = $this->input->post('district', true);
        $village = $this->input->post('village', true);
        $zipcode = $this->input->post('zipcode', true);
        $address = $this->input->post('address', true);
        $courier = $this->input->post('paymentSelectKurir', true);
        $service1 = explode("-", $courier);
        $service2 = $service1[2];
        $ongkir = $service1[0];
        $kurir = $service1[1];
        $totalPrice = $this->cart->total();
        $dateInput = date('Y-m-d H:i:s');
        $dateLimit = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 2, date('Y')));

        if($sett['ongkir'] == 0){
            $regency = $this->input->post('paymentSelectRegenciesOngkir', true);
            $service2 = "";
            $kurir = "";
            $chijcec = $this->db->get_where('cost_delivery', ['destination' => $regency])->row_array();
            if($chijcec){
                $ongkir = $chijcec['price'];
            }else{
                $get = $this->db->get('settings')->row_array();
                $ongkir = $get['default_ongkir'];
            }
            $totalAll = intval($ongkir) + intval($totalPrice);
        }else{
            $regency = $this->input->post('paymentSelectRegencies', true);
            $service2 = $service1[2];
            $kurir = $service1[1];
            $totalAll = intval($ongkir) + intval($totalPrice);
        }
        
        $dataIns = [
            'invoice_code' => $invoice,
            'label' => 'true',
            'name' => $name,
            'telp' => $telp,
            'province' => $province,
            'regency' => $regency,
            'district' => $district,
            'village' => $village,
            'zipcode' => $zipcode,
            'address' => $address,
            'courier' => $service2,
            'courier_service' => $kurir,
            'ongkir' => $ongkir,
            'total_price' => $totalPrice,
            'total_all' => $totalAll,
            'date_input' => $dateInput,
            'date_limit' => $dateLimit,
            'process' => 0,
            'send' => 0
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=$province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ". $this->Settings_model->general()["api_rajaongkir"]
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response =  json_decode($response, true);
            $province_real = $response['rajaongkir']['results']['province'];
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=$regency",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ". $this->Settings_model->general()["api_rajaongkir"]
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response =  json_decode($response, true);
            $regency_real = $response['rajaongkir']['results']['type'] . ' ' . $response['rajaongkir']['results']['city_name'];
        }
        $address = $address . ' ' . $village . ', ' .  $district . ', ' . $regency_real . ', ' . $province_real . ' - ' . $zipcode;   
        

        $insertdata = $this->db->insert('invoice', $dataIns);

        foreach($this->cart->contents() as $c){
            $data = [
                'id_invoice' => $invoice,
                'product_name' => $c['name'],
                'price' => $c['price'],
                'qty' => $c['qty'],
                'slug' => $c['slug'],
                'ket' => $c['ket']
            ];
            $this->db->insert('transaction', $data);
        }

        return ['name' => $name, 'telp' => $telp, 'address' => $address, 'courier' => $service2, 'courier_service' => $kurir, 'ongkir' => $ongkir];
    }

}
