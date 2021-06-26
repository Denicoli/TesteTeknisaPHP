<?php

namespace App\Models;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'body',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function filter(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function sort(array $emails)
    {
        asort($emails);
        return $emails;
    }

    public function send()
    {
        $faker = Faker::create();
        return $faker->boolean;
    }
}
