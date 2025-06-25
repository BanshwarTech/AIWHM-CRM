<?php

namespace Database\Seeders;

use App\Models\admin\whmcs_setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhmcsApiSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        whmcs_setting::create([
            'api_url'        => 'https://your-whmcs-url.com/includes/api.php',
            'api_identifier' => 'your_api_identifier',
            'api_secret'     => 'your_api_secret',
        ]);
    }
}
