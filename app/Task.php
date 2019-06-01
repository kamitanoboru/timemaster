<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
        protected $fillable = [
        'user_id', 'title', 'type','start_date','task_time','zone','task_order','status','memo','fix_start','importance','emergency'
    ];
    
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}

