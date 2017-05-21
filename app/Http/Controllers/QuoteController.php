<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Quote;
use App\Category;
use Illuminate\Support\Facades\DB;


class QuoteController extends Controller
{
    public function getSiteIndex(){

        $quotes = Quote::orderBy('created_at', 'desc')->paginate();
        foreach($quotes as $quote){
            $quote->body = $this->shortenText($quote->body, 20);
        }
        return view('frontend.quotes.index', ['quotes' => $quotes]);
    }

    public function getQuoteIndex()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.quotes.index', ['quotes' => $quotes]);
    }

    public function getSingleQuote($quote_id, $end = 'frontend'){

        $quote = Quote::find($quote_id);
        if(!$quote){
            return redirect()->route('admin.quotes.index')->with(['fail' => 'Devis non trouvé']);
        }
        $categories = $quote->categories;
        return view($end.'.quotes.single', ['quote' => $quote, 'categories' => $categories]);
    }

    public function getQuotesForCustomer($customer_name, $end = 'frontend')
    {
        $quotes = Quote::where('customer', $customer_name)->paginate(5);
        if(!$quotes){
            return redirect()->route('admin.quotes.index')->with(['fail' => 'Devis non trouvé']);
        }
        return view('admin.quotes.index', ['quotes' => $quotes, 'customer_name' => $customer_name]);
    }

    public function getCreateQuote()
    {
        $categories = Category::all();
        return view('admin.quotes.create_quote', ['categories' => $categories]);
    }

    public function postCreateQuote(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|max:120|unique:quotes',
           'customer' => 'required|max:80',
           'body' => 'required'
        ]);

        $quote = new Quote();
        $quote->title = $request['title'];
        $quote->customer = $request['customer'];
        $quote->body = $request['body'];
        $quote->save();

        // gère l'association devis / catégories
        if(strlen($request['categories']) > 0){
            $categoryIds = explode(',', $request['categories']);
            foreach($categoryIds as $categoryId){
                $quote->categories()->attach($categoryId);
            }
        }

        return redirect()->route('admin.index')->with(['success' => 'Devis créé avec succès !']);
    }

    public function getUpdateQuote($quote_id)
    {
        $quote = Quote::find($quote_id);
        $categories = Category::all();
        $quote_categories  = $quote->categories;
        $quote_categories_ids = array();
        $i = 0;
        foreach($quote_categories as $quote_category){
            $quote_categories_ids[$i] = $quote_category->id;
            $i++;
        }

        if(!$quote){
            return redirect()->route('public.index')->with(['fail' => 'Devis non trouvé']);
        }

        return view('admin.quotes.edit_quote', ['quote' => $quote, 'categories' => $categories, 'quote_categories' => $quote_categories, 'quote_categories_ids' => $quote_categories_ids]);
    }

    public function postUpdateQuote(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'customer' => 'required|max:80',
            'body' => 'required'
        ]);

        $quote = Quote::find($request["quote_id"]);
        $quote->title = $request["title"];
        $quote->customer = $request["customer"];
        $quote->body = $request["body"];
        $quote->update(); // idéalement, il faudrait checker si la sauvegarde s'est vraiment faite

        // categories
        $quote->categories()->detach();
        if(strlen($request['categories']) > 0){
            $categoryIds = explode(',', $request['categories']);
            foreach($categoryIds as $categoryId){
                $quote->categories()->attach($categoryId);
            }
        }

        return redirect()->route('admin.quotes.index')->with(['success' => 'Devis mis à jour !']);
    }

    public function getDeleteQuote($quote_id)
    {
        $quote = Quote::find($quote_id);
        if(!$quote){
            return redirect()->route('public.index')->with(['fail' => 'Devis non trouvé']);
        }
        $quote->delete();
        return redirect()->route('admin.index')->with(['success' => 'Devis supprimé avec succès']);
    }

    private function shortenText($text, $words_count)
    {
        if(str_word_count($text, 0) > $words_count){
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$words_count]) . '...';
        }

        return $text;
    }
}
