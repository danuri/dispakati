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
              'paki_pendidikan_lama' => $row->paki_konv_pddk_lama,
              'paki_pendidikan_baru' => $row->paki_konv_pddk_baru,
              'paki_tugas_pokok_lama' => $row->paki_konv_tupok_lama,
              'paki_tugas_pokok_baru' => $row->paki_konv_tupok_baru,
              'paki_pengembangan_profesi_lama' => $row->paki_konv_bangprov_lama,
              'paki_pengembangan_profesi_baru' => $row->paki_konv_bangprof_baru,
              'paki_konv_tunjang_lama' => $row->paki_konv_tunjang_lama,
              'paki_konv_tunjang_baru' => $row->paki_konv_tunjang_baru,
              'paki_tgl_awal' => $row->paki_tgl_awal,
              'paki_tgl_akhir' => $row->paki_tgl_akhir,
              'dokumen_pak' => file_get_contents('https://docu.kemenag.go.id:9000/cdn/dispakati/'.$row->paki_file)
        ];

        // $rekon = $this->api($param);
        $client = \Config\Services::curlrequest();

        $token = session('tokendispakati');

        $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/angkakredit/hitung', [
                            'multipart' => $param,
                            'headers' => [
                                'Authorization' => 'Bearer '.$token
                            ],
                            'verify' => false,
                            'debug' => true
                        ]);

        $rekon = json_decode($request->getBody());
        // print_r($rekon);
        if($rekon->status === true){
          $set = [
            'status' => 1,
            'dispakati_message' => $rekon->message,
            'dispakati_pakiid' => $rekon->data->pakiid,
          ];

          $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set($set)->update();

          print_r($rekon);
        }else{
          echo 'Gagal update. ';
          echo $rekon->message;
        }
      }

    }

    public function getdata($nip)
    {
      $client = \Config\Services::curlrequest();

      $token = session('tokendispakati');

      $request = $client->request('GET', 'https://dispakati.bkn.go.id/api/trial/angkakredit/getbyid', [
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

    public function api($param)
    {
      $client = \Config\Services::curlrequest();

      // $cache = \Config\Services::cache();
      // $token = $cache->get('bkn_dispakati_token');
      // $token = session('tokendispakati');
      $token = session('tokendispakati');

      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/angkakredit/hitung', [
                          'multipart' => $param,
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
      // $cache = \Config\Services::cache();
      // $token = $cache->get('tokendispakati');
      $token = session('tokendispakati');
      echo $token;
    }

    public function login()
    {
      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/login', [
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
        if($body->status === true ){

          // $cache = \Config\Services::cache();
          // $cache->save('bkn_dispakati_token', $body->token,3600);
          session()->set(['tokendispakati'=>$body->token]);
          // echo 'Success';
          echo $body->token;
          // return $body->token;
        }else{
          echo 'Error';
        }
      }else{
        echo 'Gagal Koneksi';
      }
    }
}
