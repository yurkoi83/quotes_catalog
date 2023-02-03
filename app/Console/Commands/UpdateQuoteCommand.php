<?php

namespace App\Console\Commands;

use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Console\Command;

class UpdateQuoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Quote:update {id} {text}';

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
        $quote = Quote::find($this->argument('id'));
        QuoteService::update($quote, $this->argument('text'));

        return true;
    }
}
