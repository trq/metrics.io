<?php

use Illuminate\Database\Migrations\Migration;

class CreatePackageTables extends Migration {

	/**
     * Create the initial tables used to store package data.
	 *
total 64
-rw-r--r--  1 thorpe  staff   79 22 Feb 07:49 Developer.php
-rw-r--r--  1 thorpe  staff  145 22 Feb 18:35 Dist.php
-rw-r--r--  1 thorpe  staff   78 22 Feb 18:34 Keyword.php
-rw-r--r--  1 thorpe  staff   75 22 Feb 07:50 License.php
-rw-r--r--  1 thorpe  staff  305 22 Feb 18:24 Package.php
-rw-r--r--  1 thorpe  staff  152 22 Feb 18:35 Required.php
-rw-r--r--  1 thorpe  staff  149 22 Feb 18:35 Source.php
-rw-r--r--  1 thorpe  staff  608 22 Feb 18:37 Version.php
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

        Schema::table('dists', function($table) {
            $table->increments('id');
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

        Schema::table('licenses', function($table) {
            $table->increments('id');
            $table->string('license');
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

        Schema::table('requires', function($table) {
            $table->increments('id');
            $table->string('package');
            $table->string('version');
            $table->timestamps();
        });

        Schema::table('sources', function($table) {
            $table->increments('id');
            $table->string('type');
            $table->string('url');
            $table->string('reference');
            $table->string('shasum');
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
