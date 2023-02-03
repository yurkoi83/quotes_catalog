<?php

namespace App\Services;

use App\Jobs\SendQuoteJob;
use App\Models\Quote;
use App\Models\User;

class QuoteService
{
    /**
     * @param string $text
     * @return Quote
     */
    public static function create(User $user, string $text): Quote
    {
        $result = new Quote();
        $result->text = $text;
        $result->user_id = $user->id;
        $result->save();
        return $result;
    }

    /**
     * @param Quote $quote
     * @param string $text
     * @return mixed
     */
    public static function update(Quote $quote, string $text): Quote
    {
        $result = Quote::find($quote->id);
        $result->text = $text;
        $result->save();
        return $result;
    }


    /**
     * @param Quote $quote
     * @return void
     */
    public static function send(Quote $quote)
    {
        SendQuoteJob::dispatch($quote)->delay(rand(5, 20));
    }
}
