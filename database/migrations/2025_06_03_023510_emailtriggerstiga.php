<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hanya sinkronisasi dari siswas/gurus ke users (satu arah saja)
        // Untuk menghindari recursive trigger
        
        // Trigger untuk sinkronisasi email dari siswas ke users saat UPDATE
        DB::unprepared('
            CREATE TRIGGER sync_siswas_to_users_email
            AFTER UPDATE ON siswas
            FOR EACH ROW
            BEGIN
                IF OLD.email != NEW.email THEN
                    UPDATE users 
                    SET email = NEW.email, 
                        updated_at = NOW()
                    WHERE email = OLD.email;
                END IF;
            END
        ');

        // Trigger untuk sinkronisasi email dari gurus ke users saat UPDATE
        DB::unprepared('
            CREATE TRIGGER sync_gurus_to_users_email
            AFTER UPDATE ON gurus
            FOR EACH ROW
            BEGIN
                IF OLD.email != NEW.email THEN
                    UPDATE users 
                    SET email = NEW.email, 
                        updated_at = NOW()
                    WHERE email = OLD.email;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS sync_siswas_to_users_email');
        DB::unprepared('DROP TRIGGER IF EXISTS sync_gurus_to_users_email');
    }
};