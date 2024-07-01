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

    public function is_valid()
    {
        $opts=array_filter(array($this->opt1, $this->opt2, $this->opt3, $this->opt4), function($v) { return $v; });
        return count($opts)===0 || count($opts)>=2;
    }

    public function is_qcm(){
        return array_filter(array($this->opt1, $this->opt2, $this->opt3, $this->opt4), function($v) { return $v; });
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
