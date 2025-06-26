<?php

namespace App\Helpers;

use App\Models\admin\whmcs_setting;
use App\Models\WhmcsSetting;
use Illuminate\Support\Facades\Log;

class WhmcsApiConfigHelper
{
    public static function getWhmcsSettings()
    {
        $whmcsSetting = whmcs_setting::first(); // Assuming single record for now
        if ($whmcsSetting) {
            return [
                'api_url' => $whmcsSetting->api_url,
                'api_identifier' => $whmcsSetting->api_identifier,
                'api_secret' => $whmcsSetting->api_secret,
            ];
        }
        return null;
    }
}
