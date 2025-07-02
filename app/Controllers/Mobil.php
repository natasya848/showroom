<?php

namespace App\Controllers;
use App\Models\M_mobil;

class Mobil extends BaseController
{
    public function index()
    {
        $M_mobil = new M_mobil();
        $data = [
            'title' => 'Data Mobil',
            'a' => $M_mobil
                ->where('status_delete', 0)
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('data/v_mobil', $data);
        echo view('footer');
    }

    public function tambah_mobil()
	{
		$model = new M_mobil();
		$data['title']='Tambah Data Mobil';

		echo view('header', $data);
        echo view('menu');
        echo view('data/tambah_mobil', $data);
        echo view('footer');
	}

    public function aksi_tambah_mobil()
    {
        $nama       = $this->request->getPost('nama');
        $kode       = $this->request->getPost('kode');
        $plat       = $this->request->getPost('plat');
        $harga      = $this->request->getPost('harga');
        $stok       = $this->request->getPost('stok');
        $keterangan = $this->request->getPost('keterangan');
        $masuk      = $this->request->getPost('masuk');
        $keluar     = $this->request->getPost('keluar'); 

        $harga_bersih = str_replace(['Rp', '.', ' '], '', $harga);

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = null;

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName(); 
            $fileFoto->move('uploads/mobil', $namaFoto); 
        }

        $data = [
            'nama_mobil'   => $nama,
            'kode_mobil'   => $kode,
            'plat_mobil'   => $plat,
            'harga_mobil'  => $harga_bersih,
            'stok'         => $stok,
            'keterangan'   => $keterangan,
            'tanggal_masuk'    => $masuk,
            'tanggal_keluar'   => $keluar ?: null, 
            'foto_mobil'   => $namaFoto,
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $model = new M_mobil();
        $model->insert($data);

        return redirect()->to(base_url('mobil'))->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit_mobil($id)
    {
        $model = new M_mobil();
        $data['title'] = 'Edit Mobil';
        $data['mobil'] = $model->asObject()->find($id);

        if (!$data['mobil']) {
            return redirect()->to('/mobil')->with('error', 'Mobil tidak ditemukan.');
        }

        echo view('header', $data);
        echo view('menu');
        echo view('data/edit_mobil', $data);
        echo view('footer');
    }

    public function update_mobil($id)
    {
        $model = new \App\Models\M_mobil();
        $mobil = $model->find($id);

        if (!$mobil) {
            return redirect()->to('/mobil')->with('error', 'Mobil tidak ditemukan.');
        }

        $nama       = $this->request->getPost('nama');
        $kode       = $this->request->getPost('kode');
        $plat       = $this->request->getPost('plat');
        $harga      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga'));
        $stok       = $this->request->getPost('stok');
        $keterangan = $this->request->getPost('keterangan');
        $masuk      = $this->request->getPost('masuk');
        $keluar     = $this->request->getPost('keluar') ?: null;

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $mobil['foto_mobil']; 

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('uploads/mobil', $namaFoto);

            if ($mobil['foto_mobil'] && file_exists('uploads/mobil/' . $mobil['foto_mobil'])) {
                unlink('uploads/mobil/' . $mobil['foto_mobil']);
            }
        }

        $data = [
            'nama_mobil'   => $nama,
            'kode_mobil'   => $kode,
            'plat_mobil'   => $plat,
            'harga_mobil'  => $harga,
            'stok'         => $stok,
            'keterangan'   => $keterangan,
            'tanggal_masuk'    => $masuk,
            'tanggal_keluar'   => $keluar,
            'foto_mobil'   => $namaFoto,
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('mobil'))->with('success', 'Data mobil berhasil diupdate.');
    }

    public function dihapus_mobil()
    {
        // $this->logActivity("Mengakses Tabel Data Data Mobil yang Dihapus");

        // if (!session()->has('id_user')) { 
        //     return redirect()->to('login/halaman_login');
        // }

        // if (!in_array(session()->get('level'), [1])) {
        //     return redirect()->to('home/dashboard'); 
        // }

        $M_mobil = new M_mobil();
        $data = [
            'title' => 'Data Mobil yang Dihapus',
            'deleted_mobil' => $M_mobil->getDeletedMobil(),
            'showWelcome' => false 
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('data/deleted_mobil', $data);
        echo view('footer');
    }

    public function hapus_mobil($id)
    {
        $M_mobil = new M_mobil();
        if ($M_mobil->deletePermanen($id)) {
            // $this->logActivity("Menghapus permanen mobil ID: $id");

            return redirect()->to(base_url('mobil/dihapus_mobil'))->with('success', 'Data Mobil berhasil dihapus secara permanen');
        }
        return redirect()->to(base_url('mobil/dihapus_mobil'))->with('error', 'Data Mobil tidak ditemukan atau gagal dihapus');
    }

    public function delete_mobil($id)
    {
        $M_mobil = new M_mobil();
        if ($M_mobil->softDelete($id)) {
            // $this->logActivity("Menghapus mobil ID: $id (soft delete)");

            return redirect()->to(base_url('mobil/dihapus_mobil'))->with('success', 'Data Mobil berhasil dihapus (soft delete)');
        }
        return redirect()->to(base_url('mobil'))->with('error', 'Data Mobil tidak ditemukan atau gagal dihapus');
    }

    public function restore_mobil($id)
    {
        $M_mobil = new M_mobil();

        if ($M_mobil->restore($id)) {
            // $this->logActivity("Mengembalikan mobil ID: $id (soft delete)");
            return redirect()->to(base_url('mobil'))->with('success', 'Data Mobil berhasil direstore');
        }
        return redirect()->to(base_url('mobil/dihapus_mobil'))->with('error', 'Data Mobil tidak ditemukan');
    }

    public function detail_mobil($id)
    {
        // $session = session();
        // $user_id = $session->get('id_user'); 
        // $user_level = $session->get('level'); 

        // $logModel = new \App\Models\M_log();
        $M_mobil = new M_mobil();
        $mobil = $M_mobil->getmobilById($id);

        // $logModel->saveLog($mobil_id, "id_mobil={$mobil_id} berhasil melihat detail mobil ID {$id}", $ip_address);

        $data = [
            'title' => 'Detail mobil',
            'mobil' => $mobil
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('data/detail_mobil', $data);
        echo view('footer');
    }

}