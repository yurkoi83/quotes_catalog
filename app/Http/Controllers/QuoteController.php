<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function create()
    {

    }

    public function store(QuoteRequest $request)
    {
        return true;
    }

    public function update(QuoteRequest $request)
    {
        return true;
    }
}
