<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pinjam;

class Asset extends Model
{
    use HasFactory;
    public function pinjam() {
        return $this->hasOne(Pinjam::class)->latest();
  }
}
