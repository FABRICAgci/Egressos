<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cidade extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Cidade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function uf(): HasOne
    {
        return $this->hasOne(Uf::class, 'id', 'uf_id');
    }
}
