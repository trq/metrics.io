<?php

class License extends Eloquent {

	protected $table = 'licenses';

    public function version() {
        $this->belongsTo('Version');
    }
}
