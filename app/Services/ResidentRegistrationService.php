<?php

namespace App\Services;

use App\Models\Resident;
use App\Models\User;

class ResidentRegistrationService
{
    public function registerUserAsResident(User $user)
    {
        if ($user->hasRegisteredAsResident()) {
            return $user->resident;
        }

        $resident = Resident::create([
            'user_id' => $user->id,
            'nik' => 'NIK-SEMENTARA-'.time(), // Nilai sementara
            'name' => $user->name,
            'address' => $user->address ?? 'Alamat belum diisi',
            'phone' => $user->phone ?? '08123456789',
            'gender' => 'L',
            'birth_date' => now()->subYears(20),
            'is_registered' => false // Status belum lengkap data
        ]);

        return $resident;
    }
}