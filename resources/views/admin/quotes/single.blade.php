@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <section id="quote-admin">
            <div class="edit">
                <ul>
                    <li><a href="{{ route('admin.quote.edit', ['quote_id' => $quote->id]) }}">Éditer</a></li>
                    <li><a href="{{ route('admin.quote.delete', ['quote_id' => $quote->id]) }}">Supprimer</a></li>
                </ul>
            </div>
        </section>
        <section class="quote">
            <h1>{{ $quote->title }}</h1>
            <span class="info"><a href="{{ route('admin.quotes.customer', ['customer_name' => $quote->customer, 'end' => 'admin']) }}">{{ $quote->customer }}</a> | {{ $quote->created_at}} </span>
            <br/>
            <span class="info">
                <ul>
                    @foreach($categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </span>
            <p>{{ $quote->body }}</p>
        </section>
    </div>
@endsection