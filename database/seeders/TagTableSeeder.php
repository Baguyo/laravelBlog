<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Math', 'Programming', 'Technology', 'Algorithm', 'Application']);

        $tags->each(function($item){
            $tagObject = new Tag();
            $tagObject->name = $item;
            $tagObject->save();
        });
        
    }
}
