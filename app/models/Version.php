<?php

class Version extends Eloquent {

	protected $table = 'versions';

    public function package() {
        $this->belongsTo('Package');
    }

    public function source() {
        $this->hasOne('Source');
    }

    public function dist() {
        $this->hasOne('Dist');
    }

    public function requires() {
        $this->belongsToMany('Version');
    }

    public function authors() {
        $this->belongsToMany('Developer');
    }

    public function keywords() {
        $this->belongsToMany('Keyword');
    }

    public function license() {
        $this->belongsToMany('License');
    }
}
