<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Rubric;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $this->create_rubrics();
        Post::factory(20)->create();
        Like::factory(50)->create();
    }

    public function create_rubrics() {
        $rubrics = ['Бизнес', 'Политика', 'Экономика', 'Космос'];
        foreach ($rubrics as $r) {
            $rr = new Rubric;
            $rr->title = $r;
            $rr->save();
        }
    }
}
