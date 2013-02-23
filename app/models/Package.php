<?php

class Package extends Eloquent {

	protected $table = 'packages';

    public function download() {
        $this->hasOne('Download');
    }

    public function maintainers() {
        $this->hasMany('Developer');
    }

    public function versions() {
        $this->hasMany('Version');
    }
}
