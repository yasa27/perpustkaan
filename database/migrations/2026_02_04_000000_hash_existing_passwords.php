<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ambil semua user dengan password yang belum di-hash
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Cek apakah password sudah di-hash (bcrypt password selalu dimulai dengan $2)
            if (!str_starts_with($user->password, '$2')) {
                // Hash password yang belum ter-hash
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($user->password)]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Migration ini tidak bisa di-revert karena password sudah ter-hash
    }
};
