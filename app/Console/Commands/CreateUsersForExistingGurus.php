<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUsersForExistingGurus extends Command
{
    protected $signature = 'guru:create-users';
    protected $description = 'Membuat akun user untuk guru yang belum memiliki akun login';

    public function handle()
    {
        $this->info('Mencari guru yang belum memiliki akun...');
        
        $gurusWithoutUsers = Guru::whereNull('user_id')->orWhere('user_id', 0)->get();
        
        if ($gurusWithoutUsers->count() === 0) {
            $this->info('Semua guru sudah memiliki akun!');
            return 0;
        }
        
        $this->info("Ditemukan {$gurusWithoutUsers->count()} guru tanpa akun. Membuat akun...");
        
        foreach ($gurusWithoutUsers as $guru) {
            // Generate username dari nama jika belum ada
            $username = $guru->username ?? Str::slug($guru->nama, '');
            
            // Jika username sudah ada, tambahkan angka random
            if (User::where('username', $username)->exists()) {
                $username = $username . '_' . rand(100, 999);
            }
            
            // Generate email jika belum ada
            $email = $guru->email ?? $username . '@school.local';
            
            // Jika email sudah ada, tambahkan angka
            if (User::where('email', $email)->exists()) {
                $email = $username . '_' . rand(100, 999) . '@school.local';
            }
            
            // Generate password default
            $defaultPassword = 'guru123';
            
            // Buat user
            $user = User::create([
                'name' => $guru->nama,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($defaultPassword),
                'role' => 'user', // atau 'guru' jika kolom role sudah diperbaiki
            ]);
            
            // Update guru dengan user_id
            $guru->user_id = $user->id;
            $guru->username = $username;
            $guru->email = $email;
            $guru->save();
            
            $this->line("✅ Akun dibuat untuk {$guru->nama}");
            $this->line("   Username: {$username}");
            $this->line("   Email: {$email}");
            $this->line("   Password: {$defaultPassword}");
            $this->newLine();
        }
        
        $this->info("Selesai! {$gurusWithoutUsers->count()} akun berhasil dibuat.");
        $this->warn("⚠️  Penting: Informasikan username dan password default ke masing-masing guru!");
        
        return 0;
    }
}