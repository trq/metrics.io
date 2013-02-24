<?php

class Keyword extends Eloquent {

    protected $table = 'keywords';

    public function version() {
        $this->belongsTo('Version');
    }
}
