<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\HandleTweet;
use TwitterStreamingApi;

class TwitterConnectionHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:stream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve specified hashtags from Twitter API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hashtag = $this->ask('Enter the hashtag?');
        $this->info('Test');
        if(empty($hashtag)){
            $this->error('You did not enter an hashtag');
        }else{
            TwitterStreamingApi::publicStream()
                ->whenHears($hashtag, function (array $tweet) {
                    HandleTweet::dispatch($tweet);
                })
                ->startListening();
        }
    }
}
