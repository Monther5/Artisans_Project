<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{

    use HasFactory;
    protected $fillable = ['title','description','paiority','user_id'];
    protected $table = 'tasks';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
