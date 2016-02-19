<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        factory(App\User::class, 10)->create()->each(function($user) {
            $subbreddit = factory(App\Subbreddit::class)->make();
            $user->subbreddits()->save($subbreddit);

            $post = factory(App\Post::class)->make([
                'subbreddit_id' => rand(1, App\Subbreddit::all()->count())
            ]);
            $user->posts()->save($post);

            $comment = factory(App\Comment::class)->make([
                'post_id' => rand(1, App\Post::all()->count())
            ]);

            // $user->comments()->save();

            // $user->comments()->save(factory(App\Comment::class)->make([
            //     'comment_id' => rand(1,App\Comment::all()->count())
            // ]));

            $user->subscribedSubbreddits()->attach(rand(1,App\Subbreddit::all()->count()));

        });

    }
}
