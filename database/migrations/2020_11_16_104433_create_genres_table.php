<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('genres')->insert( 
            array(
                array(
                    'name' => 'Shooter',
                    'description' => 'Players use ranged weapons to participate in the action, which takes place at a distance.',
                ),
                array(
                    'name' => 'Fighting',
                    'description' => 'Center around close-ranged combat typically one-on-one fights or against a small number of equally powerful opponents, often involving violent and exaggerated unarmed attacks.',
                ),
                array(
                    'name' => 'Stealth',
                    'description' => 'These games tend to emphasize sneaking around and avoiding enemy notice over direct conflict, for example, the Metal Gear series, and the Sly Cooper series.',
                ),
                array(
                    'name' => 'Survival',
                    'description' => 'Start the player off with minimal resources, in a hostile, open-world environment, and require them to collect resources, craft tools, weapons, and shelter, in order to survive as long as possible.',
                ),
                array(
                    'name' => 'Battle Royale',
                    'description' => ' Is a genre that blends the survival, exploration and scavenging elements of a survival game with last man standing gameplay.',
                ),
                array(
                    'name' => 'Rhythm',
                    'description' => 'Challenges a players sense of rhythm. The genre includes dance games such as Dance Dance Revolution and music-based games such as Donkey Konga and Guitar Hero.',
                ),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
