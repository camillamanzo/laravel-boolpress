@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <div class="card-header">
                <h1 class="text-uppercase">Contact us!</h1>
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

                <form action="{{route('guests.contact.send')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Insert your name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email_address">Email address</label>
                        <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Insert your email address" value="{{ old('email_address') }}">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" placeholder="Insert your message" value="{{ old('message') }}"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="reset" class="btn btn-secondary">Delete</button>

                </form>
                
            </div>
        </div>
    </div>
@endsection