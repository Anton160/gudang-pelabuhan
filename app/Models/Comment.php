<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=['id_com'];
    public function rent(){
        return $this->belongsTo(Warehouse_rent::class);
    }
    public function salary(){
        return $this->belongsTo(Salary::class);
    }
    public function other(){
        return $this->belongsTo(Other_cost::class);
    }
    public function debt(){
        return $this->belongsTo(Debt::class);
    }
    public function debt_payment(){
        return $this->belongsTo(Debt_payment::class);
    }
    public function tax(){
        return $this->belongsTo(Tax::class);
    }
    public function compensation(){
        return $this->belongsTo(Compensation::class);
    }
    
}
