<?php

use Illuminate\Database\Migrations\Migration;

class AddPostsFulltextIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE FULLTEXT INDEX idx_fulltext_post ON posts(title, content);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP INDEX idx_fulltext_post ON posts;');
    }
}
