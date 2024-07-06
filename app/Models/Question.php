<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table="questions";
    protected $guarded=[
        'id'
    ];

   

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function options()
    {
        $opts=array_filter(array($this->opt1, $this->opt2, $this->opt3), function($v) { return $v; });
        // dd($opts);
        return array_values($opts);
    }
}
