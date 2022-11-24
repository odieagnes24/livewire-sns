@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Feed</h2>

                @livewire('posts')
            </div>
        </div>
    </div>
@endsection