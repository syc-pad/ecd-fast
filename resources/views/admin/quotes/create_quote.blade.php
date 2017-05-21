@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::secure('src/css/form.css') }}" type="text/css"/>
@endsection

@section('content')
    @include('includes.info-box')
    <div class="container">
        <form action="{{ route('admin.quotes.create') }}" method="post">
            <div class="input-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" {{ $errors->has('title') ? 'class=has-error' : '' }} value="{{ Request::old('title') }}"/>
            </div>
            <div class="input-group">
                <label for="customer">Client</label>
                <input type="text" name="customer" id="customer" {{ $errors->has('customer') ? 'class=has-error' : '' }} value="{{ Request::old('customer') }}"/>
            </div>
            <div class="input-group">
                <label for="cateogry_select">Ajouter catégorie</label>
                <select name="category_select" id="category_select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn">Ajouter</button>
                <div class="added-categories">
                    <ul></ul>
                </div>
                <input type="hidden" name="categories" id="categories">
            </div>
            <div class="input-group">
                <label for="body">Contenu</label>
                <textarea name="body" id="body" rows="12" {{ $errors->has('body') ? 'class=has-error' : '' }} value="{{ Request::old('body') }}"></textarea>
            </div>
            <button type="submit" class="btn">Créer devis</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::secure('src/js/quotes.js') }}"></script>
@endsection