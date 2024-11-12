<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;

class UserData extends Eloquent implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb'; // Specify MongoDB connection

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'matric_number',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Get the identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id; // Use the 'id' field as the identifier
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password; // Return the password stored in the model
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id'; // This can be adjusted to match your identifier column
    }

    /**
     * Get the remember token value.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token; // Adjust this if using a custom token column
    }

    /**
     * Set the remember token value.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Set the remember token field
    }

    /**
     * Get the name of the "password" column.
     *
     * @return string
     */
    public function getAuthPasswordName()
    {
        return 'password'; // Return the name of the password column
    }

    /**
     * Get the name of the "remember token" column.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token'; // Return the name of the remember_token column
    }
}
