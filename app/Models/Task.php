<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{

    use HasFactory;
    protected $fillable = ['title','description','priority','user_id'];
    protected $table = 'tasks';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites_task', 'task_id', 'user_id');
    }
}
