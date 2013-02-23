<?php

class Dist extends Eloquent {

	protected $table = 'dists';

    public function version() {
        $this->belongsTo('Version');
    }
}
