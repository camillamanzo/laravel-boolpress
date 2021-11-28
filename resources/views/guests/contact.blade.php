@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <div class="card-header">
                <h1>Contattaci</h1>
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

                <form action="{{route('guests.contacts.send')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="email" class="form-control" id="name" placeholder="Insert your name">
                    </div>

                    <div class="form-group">
                        <label for="email_address">Email address</label>
                        <input type="email" class="form-control" id="email_address" placeholder="Insert your email address">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="reset" class="btn btn-secondary">Delete</button>

                </form>
                
            </div>
        </div>
    </div>
@endsection




