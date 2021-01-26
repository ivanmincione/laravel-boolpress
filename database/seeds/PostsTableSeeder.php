<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
            $newPost->title = $faker->sentence();
            $newPost->type = $faker->word();
            $newPost->description = $faker->realText($maxNbChars = 50, $indexSize = 2);
            $newPost->content = $faker->text($maxNbChars = 200);
            // genero lo slug che deve essere diverso per ogni post
            $slug = Str::slug($newPost->title);
            $slugBase = $slug;
            // verifico che lo slug non esista nel database
            $postPresente = Post::where('slug', $slug)->first();
            //creo un contatore
            $contatore = 1;
            // ciclo while se trova un post con lo stesso $slug
            while($postPresente) {
                // creo un nuovo slug concatenando il contatore alla fine
                $slug = $slugBase . '-' . $contatore;
                $contatore++;
                $postPresente = Post::where('slug', $slug)->first();
            }
            //uscito dal ciclo while assegno lo slug al post
            $newPost->slug = $slug;
            $newPost -> save();

        }
    }
}
