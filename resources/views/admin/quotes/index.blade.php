@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::secure('src/css/form.css') }}" type="text/css"/>
@endsection

@section('content')
<div class="container">
    @if(isset($customer_name))
        <h2>Devis pour {{ $customer_name }}</h2>
    @endif
    @if(isset($category_filter))
        <h2>Devis catégorie {{ $category_filter }}</h2>
    @endif
    @include('includes.info-box')
    <section id="quote-admin">
        <a href="{{ route('admin.quote.create_quote') }}" class="btn">Nouveau devis</a>
    </section>
    <section class="list">
            @if(count($quotes) == 0)
                Pas de devis
            @else
                @foreach($quotes as $quote)
                    <article>
                        <div class="quote-info">
                            <h3>{{ $quote->title }}</h3>
                            <span class="info">Pour <a href="{{ route('admin.quotes.customer', ['customer_name' => $quote->customer, 'end' => 'admin']) }}">{{ $quote->customer }}</a> | Créé le {{ $quote->created_at }}</span>
                        </div>
                        <div class="edit">
                            <ul>
                                <li><a href="{{ route('admin.quotes.quote', ['quote_id' => $quote->id, 'end' => 'admin']) }}">Voir</a></li>
                                <li><a href="{{ route('admin.quote.edit', ['quote_id' => $quote->id]) }}">Editer</a></li>
                                <li><a href="{{ route('admin.quote.delete', ['quote_id' => $quote->id]) }}" class="danger">Supprimer</a></li>
                            </ul>
                        </div>
                    </article>
                @endforeach
            @endif
    </section>
    @if($quotes->lastPage() > 1)
        <section class="pagination">
            @if($quotes->currentPage() !== 1)
                <a href="{{ $posts->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
            @endif
            @if($quotes->currentPage() !== $posts->lastPage())
                <a href="{{ $posts->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
            @endif
        </section>
    @endif
</div>
@endsection