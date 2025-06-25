<?php

namespace Database\Seeders;

use App\Models\admin\mail_setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mail_setting::create([
            'mail_mailer'        => 'smtp',
            'mail_scheme'        => 'TLS',
            'mail_host'          => 'smtp.gmail.com',
            'mail_port'          => '587',
            'mail_username'      => 'banshwar2000@gmail.com',
            'mail_password'      => 'uiia jvzr pkaf imob',
            'mail_from_address'  => 'banshwar2000@gmail.com',
            'mail_from_name'     => 'AIWHM-CRM',
        ]);
    }
}
