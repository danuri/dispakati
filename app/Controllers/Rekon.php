<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PakiModel;

class Rekon extends BaseController
{
    public function index()
    {
      $model = new PakiModel;
      $paki = $model->where('status',0)->findAll();

      foreach ($paki as $row) {

        $param = [
              'paki_pns_nipbaru' => $row->paki_pns_nipbaru,
              'paki_konv_pddk_lama' => $row->paki_konv_pddk_lama,
              'paki_konv_pddk_baru' => $row->paki_konv_pddk_baru,
              'paki_konv_tupok_lama' => $row->paki_konv_tupok_lama,
              'paki_konv_tupok_baru' => $row->paki_konv_tupok_baru,
              'paki_konv_bangprov_lama' => $row->paki_konv_bangprov_lama,
              'paki_konv_bangprof_baru' => $row->paki_konv_bangprov_baru,
              'paki_konv_tunjang_lama' => $row->paki_konv_tunjang_lama,
              'paki_konv_tunjang_baru' => $row->paki_konv_tunjang_baru,
              'paki_tgl_awal' => $row->paki_tgl_awal,
              'paki_tgl_akhir' => $row->paki_tgl_akhir,
              'dokumen_pak' => $row->dokumen_pak
        ];

        $this->api($param);
      }

    }

    public function api($param)
    {
      $client = \Config\Services::curlrequest();

      $cache = \Config\Services::cache();
      $token = $cache->get('bkn_dispakati_token');
      // $token = '';

      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/angkakredit/hitung', [
                          'form_params' => $param,
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                      ]);

      if($request){


      }
    }

    public function login()
    {
      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://dispakati.bkn.go.id/api/login', [
                          'form_params' => [
                            'username' => 'xxx',
                            'password' => 'xxxx'
                          ]
                      ]);

      if($request){


      }
    }
}
