<?php

class Required extends Eloquent {

	protected $table = 'requires';

    public function version() {
        $this->belongsTo('Version');
    }
}
