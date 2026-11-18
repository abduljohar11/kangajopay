<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Rules untuk pendaftaran atau ganti password (dengan konfirmasi).
     *
     * @return array<int, Password|ValidationRule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }

    /**
     * Rules untuk verifikasi password saat ini.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function currentPasswordRules(): array
    {
        return ['required', 'string', 'current_password'];
    }
    /**
     * Custom messages untuk validasi Password.
     *
     * @return array<string, string>
     */
    protected function passwordMessages(): array
    {
        return [
            'password.required' => ':attribute wajib diisi.',
            'password.confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'current_password' => ':attribute saat ini tidak sesuai.',
        ];
    }

    /**
     * Custom attribute names untuk penyamaran nama field Password.
     *
     * @return array<string, string>
     */
    protected function passwordAttributes(): array
    {
        return [
            'password' => 'Kata Sandi',
            'password_confirmation' => 'Konfirmasi Kata Sandi',
            'current_password' => 'Kata Sandi Saat Ini',
        ];
    }
}
