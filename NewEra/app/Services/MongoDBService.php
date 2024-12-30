<?php

namespace App\Services;

use MongoDB\Client;

class MongoDBService
{
    protected $client;
    protected $database;

    public function __construct()
    {
        // Ensure the MongoDB URI and database name are set properly
        $this->client = new Client(env('MONGO_URI'));
        $this->database = $this->client->selectDatabase(env('NewEra')); // Fetch database name from the .env file
    }

    public function getCollection($collectionName)
    {
        return $this->database->selectCollection($collectionName); // Select collection
    }
}

