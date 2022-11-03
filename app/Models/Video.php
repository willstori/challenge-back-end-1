<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'categoriaId', 'titulo', 'descricao', 'url'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoriaId', 'id');
    }


}
