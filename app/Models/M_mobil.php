<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mobil extends Model
{
    protected $table = 'mobil'; 
    protected $primaryKey = 'id_mobil'; 
    protected $allowedFields = [
        'foto_mobil', 'nama_mobil', 'kode_mobil', 'harga_mobil', 'status',
        'plat_mobil', 'keterangan', 'tanggal_masuk', 'tanggal_keluar', 'stok', 
        'status_delete', 'created_at', 'updated_at', 'deleted_at' ];

    public function softDelete($id)
    {
        return $this->update($id, ['status_delete' => 1]);
    }

    public function restore($id)
    {
        return $this->update($id, ['status_delete' => 0]);
    }

    public function deletePermanen($id)
    {
        return $this->where('id_mobil', $id)->delete();
    }

    public function getDeletedMobil()
    {
        return $this->db->table('mobil')->where('status_delete', 1)->get()->getResult();
    }

    public function getMobilById($id)
    {
        return $this->asObject()->find($id);
    }

}
