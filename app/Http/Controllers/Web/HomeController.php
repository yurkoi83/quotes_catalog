<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use App\Services\QuoteService;
use function auth;
use function redirect;
use function url;
use function view;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quotes = Quote::where('user_id', auth()->user()->id)->get();
        return view('home', ['quotes' => $quotes]);
    }

    /**
     * @param QuoteRequest $request
     * @param $quote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(QuoteRequest $request)
    {
        QuoteService::create(auth()->user(), $request->text);
        return redirect()->to(url('home'));
    }

    /**
     * @param Quote $quote
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Quote $quote)
    {
        return view('quote.edit', ['quote' => $quote]);
    }

    /**
     * @param Quote $quote
     * @param QuoteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Quote $quote, QuoteRequest $request)
    {
        QuoteService::update($quote, $request->text);
        return redirect()->to(url('home'));
    }
}
