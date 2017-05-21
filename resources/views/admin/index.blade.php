@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{  URL::secure('src/css/modal.css') }}" type="text/css"/>
@endsection

@section('content')
    <div class="container">
        @include('includes.info-box')
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.quote.create_quote') }}" class="btn">Nouveau devis</a></li>
                        <li><a href="{{ route('admin.quotes.index') }}" class="btn">Tous les devis</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($quotes) == 0)
                        <li>Pas de devis</li>
                    @else
                        @foreach($quotes as $quote)
                            <li>
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
                            </li>
                        @endforeach
                    @endif
                </ul>
            </section>
        </div>
        
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.contact.index') }}" class="btn">Tous les messages</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($contact_messages) == 0)
                        <li>Pas de messages</li>
                    @endif
                    
                    @foreach($contact_messages as $contact_message)
                        <li>
                            <article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
                                <div class="message-info">
                                    <h3>{{ $contact_message->subject }}</h3>
                                    <span class="info">De: {{ $contact_message->sender }} | Reçu le {{ $contact_message->created_at }}</span>
                                </div>
                                <div class="edit">
                                    <nav>
                                        <ul>
                                            <li><a href="">Lire</a></li>
                                            <li><a href="" class="danger">Supprimer</a></li>
                                        </ul>    
                                    </nav>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
    <div class="modal" id="contact-message-info">
        <button class="btn" id="modal-close">Fermer</button>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var token = "{{ Session::token() }}";
    </script>
    <script type="text/javascript" src="{{ URL::secure('src/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ URL::secure('src/js/contact_message.js') }}"></script>
@endsection