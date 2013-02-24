<?php

class Developer extends Eloquent {

	protected $table = 'developers';

    public function package() {
        $this->belongsTo('Package');
    }

    public function version() {
        $this->belongsTo('Version');
    }
}
