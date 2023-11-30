<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressState extends Model
{
    use HasFactory;

    public function progress_stateable(){
        
        return $this->morphTo();
    }
}
