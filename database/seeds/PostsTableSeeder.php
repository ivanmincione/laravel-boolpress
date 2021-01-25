<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->word();
            $newPost->author = $faker->name();
            $newPost->type = $faker->word();
            $newPost->description = $faker->realText($maxNbChars = 50, $indexSize = 2);
            $newPost->content = $faker->text($maxNbChars = 200);

            $newPost -> save();

        }
    }
}
