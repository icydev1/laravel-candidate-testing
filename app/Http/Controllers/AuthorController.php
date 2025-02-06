<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequestTrait;


class AuthorController extends Controller
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

        // Build the query string
        $queryString = http_build_query($queryParams);


        $url = '/api/v2/authors?' . $queryString;


        // Make the API request
        $response = $this->makeApiRequest('GET', $url, [], [
            'Authorization' => 'Bearer ' . session()->get('token'),
        ]);


        if (isset($response['error'])) {
            return back()->withErrors(['api' => 'Failed to fetch authors: ' . $response['error']]);
        }

        // If the response is successful, pass the authors to the view
        return view('authors.index', ['authors' => $response]);
    }

    public function show($id)
    {


        $url = '/api/v2/authors/' . $id;


        // Make the API request
        $response = $this->makeApiRequest('GET', $url, [], [
            'Authorization' => 'Bearer ' . session()->get('token'),
        ]);


        if (isset($response['error'])) {
            return back()->withErrors(['api' => 'Failed to fetch author details: ' . $response['error']]);
        }

        // If the response is successful, pass the authors to the view
        return view('authors.view', ['author' => $response]);
    }


    public function destroy($id)
    {
        // Check if the author has books associated with them
        $authorResponse = $this->makeApiRequest('GET', "/api/v2/authors/{$id}", [], [
            'Authorization' => 'Bearer ' . session()->get('token'),
        ]);

        if (isset($authorResponse['error'])) {
            return redirect()->route('authors.index')->with('error', $authorResponse['error']);
        }



        // Check if the author has any books
        if (isset($authorResponse['books']) && count($authorResponse['books']) > 0) {

            // dd($authorResponse);

            return redirect()->route('authors.index')->with('error', 'This author cannot be deleted because they have associated books.');
        }

        // delete author
        $deleteResponse = $this->makeApiRequest('DELETE', "/api/v2/authors/{$id}", [], [
            'Authorization' => 'Bearer ' . session('token')
        ]);

        if (isset($deleteResponse['error'])) {
            return redirect()->route('authors.index')->with('error', $deleteResponse['error']);
        }

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
