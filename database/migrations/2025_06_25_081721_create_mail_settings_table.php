<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mail_mailer')->nullable();          // smtp, sendmail, log
            $table->string('mail_scheme')->nullable();          // tls, ssl
            $table->string('mail_host')->nullable();            // smtp.mailtrap.io
            $table->string('mail_port')->nullable();            // 2525, 587
            $table->string('mail_username')->nullable();        // SMTP username
            $table->string('mail_password')->nullable();        // SMTP password
            $table->string('mail_from_address')->nullable();    // noreply@example.com
            $table->string('mail_from_name')->nullable();       // Your App Name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_settings');
    }
};
