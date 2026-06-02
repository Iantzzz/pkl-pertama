<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TempatPkl extends Model
{
    protected $table = 'tempat_pkl';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
