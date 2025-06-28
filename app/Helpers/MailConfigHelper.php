<?php

namespace App\Helpers;

use App\Models\admin\mail_setting;
use Illuminate\Support\Facades\Config;

class MailConfigHelper
{
    public static function getMailSettings()
    {
        $settings = mail_setting::first(); // or wherever you store settings

        if ($settings) {
            Config::set('mail.default', $settings->mail_mailer);
            Config::set('mail.mailers.' . $settings->mail_mailer, [
                'transport' => $settings->mail_mailer,
                'host' => $settings->mail_host,
                'port' => $settings->mail_port,
                'encryption' => $settings->mail_encryption,
                'username' => $settings->mail_username,
                'password' => $settings->mail_password,
            ]);

            Config::set('mail.from.address', $settings->mail_from_address);
            Config::set('mail.from.name', $settings->mail_from_name);
        }
    }
}
