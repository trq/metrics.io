<?php

use Illuminate\Database\Migrations\Migration;

class CreatePackageTables extends Migration {

	/**
     * Create the initial tables used to store package data.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('developers', function($create) {
            $create->increments('id');
            $create->string('name');
            $create->string('email');
            $create->timestamps();
        });

        Schema::create('developers_packages', function($create) {
            $create->integer('developer_id');
            $create->integer('package_id');
            $create->timestamps();
        });

        Schema::create('developers_versions', function($create) {
            $create->integer('developer_id');
            $create->integer('version_id');
            $create->timestamps();
        });

        Schema::create('dists', function($create) {
            $create->increments('id');
            $create->integer('version_id')->unsigned();
            $create->string('type');
            $create->string('url');
            $create->string('reference');
            $create->string('shasum');
            $create->timestamps();
        });

        Schema::create('keywords', function($create) {
            $create->increments('id');
            $create->string('keyword');
            $create->timestamps();
        });

        Schema::create('keywords_versions', function($create) {
            $create->integer('keyword_id');
            $create->integer('version_id');
            $create->timestamps();
        });

        Schema::create('licenses', function($create) {
            $create->increments('id');
            $create->string('license');
            $create->timestamps();
        });

        Schema::create('licenses_versions', function($create) {
            $create->integer('license_id');
            $create->integer('version_id');
            $create->timestamps();
        });

        Schema::create('packages', function($create) {
            $create->increments('id');
            $create->string('name');
            $create->string('description');
            $create->string('type');
            $create->string('repository');
            $create->integer('favors')->unsigned();
            $create->timestamps();
        });

        Schema::create('sources', function($create) {
            $create->increments('id');
            $create->integer('version_id')->unsigned();
            $create->string('type');
            $create->string('url');
            $create->string('reference');
            $create->string('shasum');
            $create->timestamps();
        });

        Schema::create('versions', function($create) {
            $create->increments('id');
            $create->string('name');
            $create->string('description');
            $create->string('homepage');
            $create->string('version');
            $create->string('version_normalized');
            $create->string('type');
            $create->string('time');
            $create->string('autoload_json');
            $create->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('developers');
        Schema::drop('developers_packages');
        Schema::drop('developers_versions');
        Schema::drop('dists');
        Schema::drop('keywords');
        Schema::drop('keywords_versions');
        Schema::drop('licenses');
        Schema::drop('licenses_versions');
        Schema::drop('packages');
        Schema::drop('sources');
        Schema::drop('versions');
	}
}
