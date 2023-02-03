<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Http\Requests\SendQuoteRequest;
use App\Models\Quote;
use App\Services\QuoteService;
use function response;

class QuoteController extends Controller
{

    /**
     * @param Quote $quote
     * @param QuoteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Quote $quote, QuoteRequest $request)
    {
        if(empty($request->messages())) {
            QuoteService::send($quote);
            sleep(rand(5, 20));
        }

        return response()->json(array('success' => true, 'result' => 'ok'));
    }
}
