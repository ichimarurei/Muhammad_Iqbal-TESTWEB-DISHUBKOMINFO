<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKPD extends Model
{
    protected $table = 'skpd';
    protected $fillable = ['skpd'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function unitKerja()
    {
        return $this->hasMany(UnitKerja::class);
    }
}
