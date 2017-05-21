@extends('layouts.master')

@section('title')
    Contact
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('src/css/form.css') }}" type="text/css"/>
@endsection

@section('content')
    @include('includes.info-box')
    <form action="{{ route('contact.send') }}" method="post" id="contact-form">
        <div class="input-group">
            <label for="name">Votre nom</label>
            <input type="text" name="name" id="name" value="{{ Request::old('name') }}"/>
        </div>
        <div class="input-group">
            <label for="email">Votre e-mail</label>
            <input type="text" name="email" id="email" value="{{ Request::old('email') }}"/>
        </div>
        <div class="input-group">
            <label for="subject">Objet de votre message</label>
            <input type="text" name="subject" id="subject" value="{{ Request::old('subject') }}"/>
        </div>
        <div class="input-group">
            <label for="message">Votre message</label>
            <textarea name="message" id="message" rows="10" value="{{ Request::old('message') }}"></textarea>
        </div>
        <button class="btn" type="submit">Envoyer</button>
        <input type="hidden" value="{{ Session::token() }}" name="_token"/>
    </form>
@endsection