@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5 my-5">
            <div class="card-header">
                <h1>Thank you for getting in touch with us!</h1>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>   
                @endif
                    <p>We'll get back to you as soon as possible.</p>
            </div>
        </div>
        <a href="{{ route('guests.home') }}"><h3>Go back to the homepage.</h3></a>
    </div>
@endsection




