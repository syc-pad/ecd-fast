@extends('layouts.master')

@section('title')
    {{ $quote->title }}
@endsection

@section('content')
    <article>
        <h1>{{ $quote->title }}</h1>
        <span class="subtitle">{{ $quote->customer }} | {{ $quote->created_at }}</span>
        <p>{{ $quote->body }}</p>
    </article>
@endsection