@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($quotes as $quote)
                            <div class="row">
                                <div class="col-11">
                                    {{ $quote->text }}
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary"
                                            onclick="location.href='{{ route("edit", ['quote' => $quote->id]) }}'">Edit
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        <form role="form" method="POST" action={{ route("create") }}>
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-bottom: 15px">
                                <label for="quoteTextarea">Quote</label>
                                <textarea name="text" class="form-control" id="quoteTextarea" rows="5"
                                          required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
