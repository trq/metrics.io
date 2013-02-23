<?php

class Source extends Eloquent {

	protected $table = 'sources';

    public function version() {
        $this->belongsTo('Version');
    }
}
