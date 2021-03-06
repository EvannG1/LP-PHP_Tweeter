<?php

namespace tweeterapp\model;

class User extends \Illuminate\Database\Eloquent\Model {
    
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function tweets() {
        return $this->belongsTo('\tweeterapp\model\Tweet', 'author');
    }

}