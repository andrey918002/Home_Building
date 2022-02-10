<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')
                ->after('name')
                ->nullable();

            $table->string('position')
                ->default('')
                ->after('date_of_birth');

            $table->string('phone')
                ->default('')
                ->after('position');

            $table->string('instagram')
                ->default('')
                ->after('phone');

            $table->string('facebook')
                ->default('')
                ->after('instagram');

            $table->string('address')
                ->default('')
                ->after('facebook');

            $table->text('last_place_of_work')
                ->default('')
                ->after('address');

            $table->string('image')
                ->after('last_place_of_work')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('position');
            $table->dropColumn('phone');
            $table->dropColumn('instagram');
            $table->dropColumn('facebook');
            $table->dropColumn('address');
            $table->dropColumn('last_place_of_work');
            $table->dropColumn('image');
        });
    }
}
