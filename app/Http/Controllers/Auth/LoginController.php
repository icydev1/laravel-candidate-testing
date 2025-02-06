<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiRequestTrait;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use ApiRequestTrait;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        $response = $this->makeApiRequest('POST', '/api/v2/token', $data);

        // dd($response);

        // Check for success response
        if (isset($response['token_key']) && isset($response['user'])) {
            // Store the token and data in session
            session(['token' => $response['token_key'], 'user' => $response['user']]);

            $filePath = storage_path('app/auth_data.json');
            if (!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0777, true);
            }


            file_put_contents($filePath, json_encode([
                'token' => $response['token_key'],
                'user' => $response['user'],
            ], JSON_PRETTY_PRINT));


            chmod($filePath, 0666);


            return redirect()->route('profile');
        } else {
            // Handle failure
            return back()->withErrors(['login' => 'Login failed. ' . ($response['error'] ?? 'Unexpected response from the API.')]);
        }
    }

    //  Show logged in user  data 
    public function showProfile()
    {
        return view('auth.profile', ['data' => session()->all()]);
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
