<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\HandleTweet;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HandleTweetTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * 
     * @test
     */
    public function expects_a_tweet_array_job_to_be_pushed()
    {
        // Fake the queue
        Queue::fake();

        // Push a job
        $tweet=array(['user'=>['name'=>'Adewale Adeoye','followers_count' =>2000]]);
        
        HandleTweet::dispatch($tweet);

        // Assert the job was pushed to the queue
        Queue::assertPushed(HandleTweet::class);
    }
}
