<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trigger untuk update status_lapor_pkl setelah INSERT
        DB::unprepared('
            CREATE TRIGGER after_pkl_insert
            AFTER INSERT ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas 
                SET status_lapor_pkl = TRUE 
                WHERE id = NEW.siswa_id;
            END;
        ');

        // Trigger untuk update status_lapor_pkl setelah DELETE
        DB::unprepared('
            CREATE TRIGGER after_pkl_delete
            AFTER DELETE ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas 
                SET status_lapor_pkl = FALSE 
                WHERE id = OLD.siswa_id;
            END;
        ');

        // Trigger untuk update lama_hari sebelum INSERT
        DB::unprepared('
            CREATE TRIGGER before_pkl_insert_update_lama_hari
            BEFORE INSERT ON pkls
            FOR EACH ROW
            BEGIN
                SET NEW.lama_hari = DATEDIFF(NEW.selesai, NEW.mulai) + 1;
            END;
        ');

        // Trigger untuk update lama_hari sebelum UPDATE
        DB::unprepared('
            CREATE TRIGGER before_pkl_update_lama_hari
            BEFORE UPDATE ON pkls
            FOR EACH ROW
            BEGIN
                SET NEW.lama_hari = DATEDIFF(NEW.selesai, NEW.mulai) + 1;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_pkl_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_pkl_delete');
        DB::unprepared('DROP TRIGGER IF EXISTS before_pkl_insert_update_lama_hari');
        DB::unprepared('DROP TRIGGER IF EXISTS before_pkl_update_lama_hari');
    }
};
