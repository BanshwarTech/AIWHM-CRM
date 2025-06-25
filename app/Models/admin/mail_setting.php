<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mail_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'mail_mailer',
        'mail_scheme',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
    ];
}
