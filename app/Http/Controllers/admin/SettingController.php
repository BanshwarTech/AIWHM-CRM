<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\mail_setting;
use App\Models\admin\whmcs_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SettingController extends Controller
{
    public function mailSettings()
    {
        $result['data'] = mail_setting::first();
        $result['user'] = currentUser();
        // dd($result);
        return view('admin.mail-settings', $result);
    }



    public function mailSettingsUpdate(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'mail_mailer' => 'required|string',
                'mail_scheme' => 'nullable|string',
                'mail_host' => 'required|string',
                'mail_port' => 'required|integer',
                'mail_username' => 'required|string',
                'mail_password' => 'required|string',
                'mail_from_address' => 'required|email',
                'mail_from_name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Fetch existing row (assumes only one record with id = 1)
            $mail_setting = mail_setting::find(1);

            if (!$mail_setting) {
                return redirect()->back()->with('error', 'Mail setting not found.');
            }

            // Update fields
            $mail_setting->mail_mailer = $request->post('mail_mailer');
            $mail_setting->mail_scheme = $request->post('mail_scheme');
            $mail_setting->mail_host = $request->post('mail_host');
            $mail_setting->mail_port = $request->post('mail_port');
            $mail_setting->mail_username = $request->post('mail_username');
            $mail_setting->mail_password = $request->post('mail_password');
            $mail_setting->mail_from_address = $request->post('mail_from_address');
            $mail_setting->mail_from_name = $request->post('mail_from_name');

            $mail_setting->save();

            return redirect()->back()->with('success', 'Mail settings updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



    public function whmcsApiSettings()
    {
        $result['data'] = whmcs_setting::first();
        $result['user'] = currentUser();
        // dd($result);
        return view('admin.whmcs-api-settings', $result);
    }

    public function updateWhmcsApiSettings(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'whmcs_api_url' => 'required|url',
                'whmcs_api_identifier' => 'required|string',
                'whmcs_api_secret' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Fetch existing row (assumes only one record with id = 1)
            $whmcs_setting = whmcs_setting::find(1);

            if (!$whmcs_setting) {
                return redirect()->back()->with('error', 'WHMCS API setting not found.');
            }

            // Update fields
            $whmcs_setting->api_url = $request->post('whmcs_api_url');
            $whmcs_setting->api_identifier = $request->post('whmcs_api_identifier');
            $whmcs_setting->api_secret = $request->post('whmcs_api_secret');

            $whmcs_setting->save();

            return redirect()->back()->with('success', 'WHMCS API settings updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
