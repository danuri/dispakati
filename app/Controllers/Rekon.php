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

        $this->download($row->paki_file);

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
              // 'dokumen_pak' => curl_file_create('https://docu.kemenag.go.id:9000/cdn/dispakati/'.$row->paki_file,'application/pdf',$row->paki_file)
              'dokumen_pak' => new \CURLFile('temp/'.$row->paki_file),
        ];

        print_r($param);

        $client = \Config\Services::curlrequest();

        $token = session('tokendispakati');

        $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/angkakredit/hitung', [
                            'multipart' => $param,
                            'headers' => [
                                'Authorization' => 'Bearer '.$token,
                                'Cookie' => '4230614d55baff62a2f629cf357fa896=ac6f1c4b3cb384cbb68c70f54a103949; ci_session=3jjdk6jue5oo5frjtmrl1mpb7sefc127'
                            ],
                            'verify' => false,
                            'debug' => true
                        ]);
        $rekon = json_decode($request->getBody());
        // print_r($request);
        if($rekon){
          if($rekon->message == 'error'){
            $set = [
              'status' => 3,
              'dispakati_message' => $rekon->data,
            ];

            $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set($set)->update();
            echo 'Gagal update. ';
            echo $rekon->data;
          }else if($rekon->status == 1){
            $set = [
              'status' => 1,
              'dispakati_message' => $rekon->message,
              'dispakati_pakiid' => $rekon->data->pakiid,
            ];

            $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set($set)->update();

            print_r($rekon);
          }else{
            $set = [
              'status' => 2,
              'dispakati_message' => $rekon->message,
            ];

            $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set($set)->update();
            echo 'Gagal update. ';
            echo $rekon->message;
          }
        }else{
          $set = [
            'status' => 2,
            'dispakati_message' => 'Gagal Update'
          ];

          $paki = $model->where('paki_pns_nipbaru',$row->paki_pns_nipbaru)->set($set)->update();
        }

        unlink(FCPATH.'temp/'.$row->paki_file);
      }

      // sleep(2);

      // $n = $this->request->getVar('n')+1;
      // return redirect()->to('rekon?n='.$n);

    }

    public function getdata($nip)
    {
      $client = \Config\Services::curlrequest();

      $token = session('tokendispakati');

      $request = $client->request('GET', 'https://dispakati.bkn.go.id/api/trial/angkakredit/byid/'.$nip, [
                          'headers' => [
                              'Authorization' => 'Bearer '.$token,
                              'Cookie' => '4230614d55baff62a2f629cf357fa896=6e305bba31d7df92fe22ae6d9cc18535; ci_session=gogacr9fs3l25fqdtgfgscg2vbv3atue'
                          ],
                          'verify' => false,
                          'debug' => true
                      ]);

      // if($request){
      //   return $body;
      // }
      $body = json_decode($request->getBody());

      print_r($body);
    }

    public function api($param)
    {
      $client = \Config\Services::curlrequest();

      $token = session('tokendispakati');

      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/trial/angkakredit/hitung', [
                          'multipart' => $param,
                          'headers' => [
                              'Authorization' => 'Bearer '.$token,
                              'Cookie' => '4230614d55baff62a2f629cf357fa896=6e305bba31d7df92fe22ae6d9cc18535; ci_session=gogacr9fs3l25fqdtgfgscg2vbv3atue'
                          ],
                          'verify' => false,
                          'debug' => true
                      ]);

      if($request){
        $body = json_decode($request->getBody());
        return $body;
      }
    }

    public function download($filename)
    {
      $arrContextOptions = array(
                              "ssl"=>array(
                                  "verify_peer"=>false,
                                  "verify_peer_name"=>false,
                              ),
                          );

      $url = 'https://docu.kemenag.go.id:9000/cdn/dispakati/'.$filename;

      $file_name = basename($url);

      if (file_put_contents('temp/'.$file_name, file_get_contents($url,false,stream_context_create($arrContextOptions))))
      {
          echo "File downloaded successfully";
      }
      else
      {
          echo "File downloading failed.";
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
                          'headers' => [
                            'Cookie' => '4230614d55baff62a2f629cf357fa896=ac6f1c4b3cb384cbb68c70f54a103949; ci_session=3jjdk6jue5oo5frjtmrl1mpb7sefc127'
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
