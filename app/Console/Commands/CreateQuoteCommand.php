<?php

namespace App\Console\Commands;

use App\Services\QuoteService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CreateQuoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Quote:create {user_id} {text}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Auth::loginUsingId($this->argument('user_id'));

        if (!Auth::check()) {
            throw new \Exception('User not found!!!');
        }

        $result = QuoteService::create(Auth::user(), $this->argument('text'));
        return true;
    }
}
