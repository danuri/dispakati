<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PakiModel;

class Rekon extends BaseController
{
    public function index()
    {

      $cache = \Config\Services::cache();
      $token = $cache->get('bkn_dispakati_token');

      $model = new PakiModel;
      $paki = $model->where('status',9)->findAll(1,0);

      foreach ($paki as $row) {

        $param = [
              'paki_pns_nipbaru' => $row->paki_pns_nipbaru,
              'paki_konv_pddk_lama' => $row->paki_konv_pddk_lama,
              'paki_konv_pddk_baru' => $row->paki_konv_pddk_baru,
              'paki_konv_tupok_lama' => $row->paki_konv_tupok_lama,
              'paki_konv_tupok_baru' => $row->paki_konv_tupok_baru,
              'paki_konv_bangprov_lama' => $row->paki_konv_bangprov_lama,
              'paki_konv_bangprof_baru' => $row->paki_konv_bangprof_baru,
              'paki_konv_tunjang_lama' => $row->paki_konv_tunjang_lama,
              'paki_konv_tunjang_baru' => $row->paki_konv_tunjang_baru,
              'paki_tgl_awal' => $row->paki_tgl_awal,
              'paki_tgl_akhir' => $row->paki_tgl_akhir,
              'dokumen_pak' => file_get_contents('https://docu.kemenag.go.id:9000/cdn/dispakati/'.$row->paki_file)
        ];

        $rekon = $this->api($param);

        if($rekon){
          $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set('status',0)->update();

          print_r($rekon);
        }
      }

    }

    public function api($param)
    {
      $client = \Config\Services::curlrequest();

      // $cache = \Config\Services::cache();
      // $token = $cache->get('bkn_dispakati_token');
      $token = session('tokendispakati');

      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/angkakredit/hitung_err', [
                          'form_params' => $param,
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false,
                          'debug' => true
                      ]);

      if($request){
        $body = json_decode($request->getBody());
        // echo $token;
        return $body;
      }
    }

    public function token()
    {
      $cache = \Config\Services::cache();
      $token = $cache->get('bkn_dispakati_token');
      echo $token;
    }

    public function login()
    {
      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/login/index_err', [
                          'form_params' => [
                            'username' => '198707222019031005',
                            'password' => 'Nurfa1'
                          ],
                          'verify' => false,
                      ]);

      if($request){
        $body = json_decode($request->getBody());
        // print_r($body);
        // echo $body->message;
        //
        if($body->status == 1){

          // $cache = \Config\Services::cache();
          // $cache->save('bkn_dispakati_token', $body->token,3600);
          session()->set(['tokendispakati'=>$body->token]);
          echo 'Success';
        }else{
          echo 'Error';
        }
      }else{
        echo 'Gagal Koneksi';
      }
    }
}
