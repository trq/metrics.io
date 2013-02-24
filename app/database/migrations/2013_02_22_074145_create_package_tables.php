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
        Schema::table('developers', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });

        // Joining table
        Schema::table('developers_packages', function($table) {
            $table->integer('developer_id');
            $table->integer('package_id');
            $table->timestamps();
        });

        // Joining table
        Schema::table('developers_versions', function($table) {
            $table->integer('developer_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::table('dists', function($table) {
            $table->increments('id');
            $table->integer('version_id')->unsigned()
            $table->string('type');
            $table->string('url');
            $table->string('reference');
            $table->string('shasum');
            $table->timestamps();
        });

        Schema::table('keywords', function($table) {
            $table->increments('id');
            $table->string('keyword');
            $table->timestamps();
        });

        // Joining table
        Schema::table('keywords_versions', function($table) {
            $table->integer('keyword_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::table('licenses', function($table) {
            $table->increments('id');
            $table->string('license');
            $table->timestamps();
        });

        // Joining table
        Schema::table('licenses_versions', function($table) {
            $table->integer('license_id');
            $table->integer('version_id');
            $table->timestamps();
        });

        Schema::table('packages', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->string('repository');
            $table->integer('favors')->unsigned();
            $table->timestamps();
        });

        Schema::table('sources', function($table) {
            $table->increments('id');
            $table->integer('version_id')->unsigned()
            $table->string('type');
            $table->string('url');
            $table->string('reference');
            $table->string('shasum');
            $table->timestamps();
        });

        Schema::table('versions', function($table) {
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
		//
	}

}
