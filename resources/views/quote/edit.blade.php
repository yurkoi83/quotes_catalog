@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <form role="form" method="POST" action={{ route("update", [$quote->id]) }}>
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">
                                <div class="form-group" style="margin-bottom: 15px">
                                    <label for="quoteTextarea">Quote</label>
                                    <textarea name="text" class="form-control" id="quoteTextarea" rows="5"
                                              required>
                                        {{ $quote->text }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
