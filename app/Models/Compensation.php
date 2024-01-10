<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    use HasFactory;
    protected $guarded=['created_at'];
    public function expense()
    {
        return $this->hasMany(Expense::class,'money_id');
    }
    public function document()
    {
        return $this->hasMany(Document::class,'money_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class,'money_id');
    }
}
