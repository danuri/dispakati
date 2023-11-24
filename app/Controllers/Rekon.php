<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PakiModel;

class Rekon extends BaseController
{
    public function index()
    {
      $model = new PakiModel;
      $paki = $model->where('status',0)->findAll(1,0);

      foreach ($paki as $row) {

        $arrContextOptions = array(
                                "ssl"=>array(
                                    "verify_peer"=>false,
                                    "verify_peer_name"=>false,
                                ),
                            );

        $param = [
              'nip' => $row->paki_pns_nipbaru,
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
              'dokumen_pak' => curl_file_create('https://docu.kemenag.go.id:9000/cdn/dispakati/'.$row->paki_file,'application/pdf',$row->paki_file)
        ];

        // print_r($param);

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
        // print_r($request);
        $rekon = json_decode($request->getBody());
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
        return $body;
      }
    }

    public function api($param)
    {
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

      if($request){
        $body = json_decode($request->getBody());
        return $body;
      }
    }

    public function token()
    {
      $token = session('tokendispakati');
      echo $token;
    }

    public function login()
    {
      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/login', [
                          'form_params' => [
                            'username' => getenv('DISPAKATI_USERNAME'),
                            'password' => getenv('DISPAKATI_PASSWORD')
                          ],
                          'verify' => false
                      ]);

      if($request){
        $body = json_decode($request->getBody());

        if($body->status === true ){

          session()->set(['tokendispakati'=>$body->token]);
          echo $body->token;
        }else{
          echo 'Error';
        }
      }else{
        echo 'Gagal Koneksi';
      }
    }
}
