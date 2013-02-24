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
        Schema::create('developers', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->unique(['name', 'email']);
            $table->timestamps();
        });

        Schema::create('developers_packages', function($table) {
            $table->integer('developer_id');
            $table->integer('package_id');
            $table->timestamps();
        });

        Schema::create('developers_versions', function($table) {
            $table->integer('developer_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::create('dists', function($table) {
            $table->increments('id');
            $table->integer('version_id')->unsigned();
            $table->string('type');
            $table->string('url');
            $table->string('reference');
            $table->string('shasum');
            $table->timestamps();
        });

        Schema::create('keywords', function($table) {
            $table->increments('id');
            $table->string('keyword');
            $table->timestamps();
        });

        Schema::create('keywords_versions', function($table) {
            $table->integer('keyword_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::create('licenses', function($table) {
            $table->increments('id');
            $table->string('license');
            $table->timestamps();
        });

        Schema::create('licenses_versions', function($table) {
            $table->integer('license_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::create('packages', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->string('repository');
            $table->integer('favors')->unsigned();
            $table->timestamps();
        });

        Schema::create('sources', function($table) {
            $table->increments('id');
            $table->integer('version_id')->unsigned();
            $table->string('type');
            $table->string('url');
            $table->string('reference');
            $table->string('shasum');
            $table->timestamps();
        });

        Schema::create('versions', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('homepage');
            $table->string('version');
            $table->string('version_normalized');
            $table->string('type');
            $table->string('time');
            $table->string('autoload_json');
            $table->timestamps();
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
