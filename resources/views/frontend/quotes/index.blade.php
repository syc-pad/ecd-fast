@extends('layouts.master')

@section('title')
    Accueil
@endsection

@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
@endsection

@section('content')
    @include('includes.info-box')
    @foreach($quotes as $quote)
        <article class="quote">
            <h3>{{ $quote->title}}</h3>
            <span class="subtitle">{{ $quote->customer }} | {{ $quote->created_at }}</span>
            <p>{{ $quote->body }}</p>
            <a href="{{ route('public.single', ['quote_id' => $quote->id, 'end' => 'frontend']) }}">Voir plus</a>
        </article>
    @endforeach
    @if($quotes->lastPage() > 1)
        <section class="pagination">
            @if($quotes->currentPage() !== 1)
                <a href="{{ $posts->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
            @endif
            @if($quotes->currentPage() !== $posts-lastPage())
                <a href="{{ $posts->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
            @endif
        </section>
    @endif
    
@endsection