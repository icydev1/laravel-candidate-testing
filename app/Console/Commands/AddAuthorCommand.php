<?php

namespace App\Console\Commands;

use App\Traits\ApiRequestTrait;
use Illuminate\Console\Command;

class AddAuthorCommand extends Command
{


    use ApiRequestTrait;

    protected $signature = 'app:add-author {first_name} {last_name}';

    protected $description = 'Command to add an new author';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $first_name = $this->argument('first_name');
        $last_name = $this->argument('last_name');

        $filePath = storage_path('app/auth_data.json');

        if (!file_exists($filePath)) {
            $this->error('Auth data file not found. Please login first in the web.');
            return;
        }

        $jsonData = file_get_contents($filePath);
        $authData = json_decode($jsonData, true);

        $birthday = now()->toIso8601String();
        $biography = 'I am the richest person in the world';
        $gender = 'male';
        $place_of_birth = 'USA';

        $response = $this->makeApiRequest('POST', '/api/v2/authors', [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birthday' => $birthday,
            'biography' => $biography,
            'gender' => $gender,
            'place_of_birth' => $place_of_birth
        ], [
            'Authorization' => 'Bearer ' . $authData['token']
        ]);

        if (isset($response['id'])) {
            $this->info("Author created successfully! Name: {$first_name} {$last_name}");
        } else {
            $error = $response['error'] ?? 'Unexpected error occurred.';
            $this->error("Failed to create author. Error: {$error}");
        }
    }
}
