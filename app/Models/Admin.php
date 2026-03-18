<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;

    protected string $admin;
    protected string $email;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->admin = config('admin.name');
        $this->email = config('admin.email');
    }
}
