<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Http\Resources\QuotesCollection;
use App\Models\Quote;
use App\Services\QuoteService;

class QuoteController extends Controller
{
    use ApiResponseTrait;

    public function create(QuoteRequest $request)
    {
        $data = QuoteService::create(auth()->user(), $request->text);
        return $this->respondWithCollection(new QuotesCollection($data));
    }

    public function update(Quote $quote, QuoteRequest $request)
    {
        $data = QuoteService::update($quote, $request->text);
        return $this->respondWithCollection(new QuotesCollection($data));
    }

    public function sendQuote(Quote $quote, QuoteRequest $request)
    {
        $data = $quote->findOrFail(($request->get('id')));
        $data->send_count = $data->send_count+1;
        $data->save();
        return $this->respondWithCollection(new QuotesCollection($data));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuotes(): \Illuminate\Http\JsonResponse
    {
        $data = new \App\Http\Resources\QuotesCollection(\App\Models\Quote::with(['User'])->get());
        return $this->respondWithCollection($data);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuote(string $id): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::with(['User'])->whereId($id)->get();
        $data = new \App\Http\Resources\QuotesCollection($quote);
        return $this->respondWithCollection($data);
    }
}
