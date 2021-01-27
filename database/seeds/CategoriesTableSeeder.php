<?php

use Illuminate\Database\Seeder;

use App\Category;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 5; $i++) {

            $newCategory = new Category();
            $newCategory->name = $faker->words(3, true);
            // genero lo slug
            $slug = Str::slug($newCategory->name);
            $slugBase = $slug;
            // verifico che lo slug non esista nel database
            $categoryPresent = Category::where('slug', $slug)->first();
            $contatore = 1;
                // entro nel ciclo while se ho trovato un post con lo stesso $slug
                while($categoryPresent) {
                    // genero un nuovo slug aggiungendo il contatore alla fine
                    $slug = $slugBase . '-' . $contatore;
                    $contatore++;
                    $categoryPresent = Category::where('slug', $slug)->first();
                }
            // esco dal while se lo slug non esiste nel db
            // assegno lo slug al post
            $newCategory->slug = $slug;
            $newCategory->save();
        }    

    }
}
