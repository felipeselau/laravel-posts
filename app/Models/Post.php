<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'imagem',
        'type',
    ];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'imagem' => 'required|image',
            'type' => 'required|in:aviso,noticia,recado,geral',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
