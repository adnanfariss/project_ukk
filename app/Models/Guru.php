<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable =['nama','nip','gender','alamat','kontak' ,'email'];

    public function pkls() {
        return $this->hasMany(Pkl::class);
    }
}
