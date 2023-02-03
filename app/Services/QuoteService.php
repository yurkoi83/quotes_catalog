<?php

namespace App\Services;

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
     * @param string $messenger
     * @return Quote
     */
    public static function send(Quote $quote): Quote
    {
        $result = Quote::find($quote->id);
        $result->send_count = $result->send_count+1;
        $result->save();

        return $result;
    }
}
