<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class whmcs_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'api_url',
        'api_identifier',
        'api_secret',
    ];
}
