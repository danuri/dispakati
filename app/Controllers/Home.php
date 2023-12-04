<?php

namespace App\Controllers;
use App\Models\PakiModel;
use Aws\S3\S3Client;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new PakiModel;
        $data['paki'] = $model->where('paki_pns_nipbaru',session('nip'))->first();

        if(!$data['paki']){
          $data['paki'] = (object) [
            'id' => 0,
            'paki_konv_pddk_lama' => "",
            'paki_konv_pddk_baru' => "",
            'paki_konv_tupok_lama' => "",
            'paki_konv_tupok_baru' => "",
            'paki_konv_bangprov_lama' => "",
            'paki_konv_bangprof_baru' => "",
            'paki_konv_tunjang_lama' => "",
            'paki_konv_tunjang_baru' => "",
            'paki_tgl_awal' => "",
            'paki_file' => "",
            'status' => "",
          ];
        }

        return view('index', $data);
    }

    public function save()
    {
      if (! $this->validate([
          'txt_penlama' => "required",
          'txt_penbaru' => "required",
          'txt_tplama' => "required",
          'txt_tpbaru' => "required",
          'txt_proflama' => "required",
          'txt_profbaru' => "required",
          'txt_penjuLama' => "required",
          'txt_penjuBaru' => "required",
          'paki_tgl_awal' => "required",
          'gambar' => [
            'label' => 'Scan PAK',
                'rules' => [
                    'uploaded[gambar]',
                    'mime_in[gambar,application/pdf]',
                    'max_size[gambar,500]',
                ],
          ]
        ])) {
            return redirect()->back()->with('message', 'Input AK/File harus sesuai ketentuan.');
        }

        $file_name = $_FILES['gambar']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $file_name = 'paki.'.session('nip').'.'.$ext;
        $temp_file_location = $_FILES['gambar']['tmp_name'];

        $s3 = new S3Client([
          'region'  => 'us-east-1',
          'endpoint' => 'https://docu.kemenag.go.id:9000/',
          'use_path_style_endpoint' => true,
          'version' => 'latest',
          'credentials' => [
            'key'    => "118ZEXFCFS0ICPCOLIEJ",
            'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
          ],
          'http'    => [
              'verify' => false
          ]
        ]);

        $result = $s3->putObject([
          'Bucket' => 'cdn',
          'Key'    => 'dispakati/'.$file_name,
          'SourceFile' => $temp_file_location,
          'ContentType' => 'application/pdf'
        ]);

        $model = new PakiModel;
        $param = [
              'paki_pns_nipbaru' => session('nip'),
              'paki_pns_golru' => session('golongan'),
              'paki_pns_jabfung' => session('jabatan'),
              'paki_konv_pddk_lama' => $this->request->getVar('txt_penlama'),
              'paki_konv_pddk_baru' => $this->request->getVar('txt_penbaru'),
              'paki_konv_pddk_jum' => ($this->request->getVar('txt_penlama') + $this->request->getVar('txt_penbaru')),
              'paki_konv_tupok_lama' => $this->request->getVar('txt_tplama'),
              'paki_konv_tupok_baru' => $this->request->getVar('txt_tpbaru'),
              'paki_konv_tupok_jum' => ($this->request->getVar('txt_tplama') + $this->request->getVar('txt_tpbaru')),
              'paki_konv_bangprov_lama' => $this->request->getVar('txt_proflama'),
              'paki_konv_bangprof_baru' => $this->request->getVar('txt_profbaru'),
              'paki_konv_bangprof_jum' => ($this->request->getVar('txt_proflama') + $this->request->getVar('txt_profbaru')),
              'paki_konv_tunjang_lama' => $this->request->getVar('txt_penjuLama'),
              'paki_konv_tunjang_baru' => $this->request->getVar('txt_penjuBaru'),
              'paki_konv_tunjang_jum' => ($this->request->getVar('txt_penjuLama') + $this->request->getVar('txt_penjuBaru')),
              'paki_tgl_awal' => $this->request->getVar('paki_tgl_awal'),
              'paki_tgl_akhir' => $this->request->getVar('paki_tgl_akhir'),
              'pns_pnsnam' => session('nama'),
              'GOL_GOLNAM' => session('golongan'),
              'jabatan_fungsional' => session('jabatan'),
              'paki_file' => $file_name,
              'status' => 0,
        ];

        $id = decrypt($this->request->getVar('id'));
        if($id > 0){
          $param['id'] = $id;
        }

        $insert = $model->save($param);

        return redirect()->back()->with('message', 'Data telah diupdate.');
        // return redirect()->back()->with('message', 'Sementara ditutup.');
    }

    public function rekap()
    {
      $db = db_connect();
      $rekap = $db->query("SELECT `status`, (CASE WHEN`status` = 0 THEN 'PENDING' ELSE dispakati_message END) AS dispakati_message, COUNT(id) AS jumlah FROM paki
GROUP BY `status`, dispakati_message")->getResult();

      $data['rekaps'] = $rekap;
      return view('rekap',$data);
    }
}
