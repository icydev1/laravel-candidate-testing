<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequestTrait;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiRequestTrait;

    public function index()
    {

        $queryParams = [
            'orderBy' => 'id',
            'direction' => 'ASC',
            'limit' => 12,
            'page' => 1,
        ];

        //  query string
        $queryString = http_build_query($queryParams);


        $url = '/api/v2/authors?' . $queryString;


        // Make the API request
        $response = $this->makeApiRequest('GET', $url, [], [
            'Authorization' => 'Bearer ' . session()->get('token'),
        ]);


        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        $authors = $response;

        return view('books.create', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
        ]);

        $data = [
            'author' => [
                'id' => $request->author_id,
            ],
            'title' => $request->title,
            'release_date' => now(),
            'description' =>  'best book',
            'isbn' => '2352353234',
            'format' => 'A4 format',
            'number_of_pages' => rand(0, 10),
        ];

        $response = $this->makeApiRequest('POST', '/api/v2/books', $data, [
            'Authorization' => 'Bearer ' . session()->get('token'),
        ]);

        // dd($response);


        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        return redirect()->route('authors.index')->with('success', 'Book created successfully.');
    }


    public function destroy($id)
    {
        // Delete a book via the API
        $response = $this->makeApiRequest('DELETE', "/api/v2/books/{$id}", [], [
            'Authorization' => 'Bearer ' . session('token')
        ]);

        if (isset($response['error'])) {
            return redirect()->route('authors.index')->with('error', $response['error']);
        }

        return redirect()->route('authors.index')->with('success', 'Book deleted successfully.');
    }
}
