<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait PinValidationRules
{
    /**
     * Rules PIN dasar untuk Transaksi (tanpa konfirmasi).
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function pinRules(): array
    {
        return ['required', 'string', 'regex:/^[0-9]{6}$/'];
    }

    /**
     * Rules PIN untuk Create & Update PIN (membutuhkan field 'pin_confirmation').
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function pinWithConfirmationRules(): array
    {
        return array_merge($this->pinRules(), ['confirmed']);
    }
    /**
     * Custom messages untuk validasi PIN.
     *
     * @return array<string, string>
     */
    protected function pinMessages(): array
    {
        return [
            'pin.required' => ':attribute wajib diisi.',
            'pin.regex' => ':attribute harus berupa 6 digit angka.',
            'pin.confirmed' => 'Konfirmasi :attribute tidak cocok.',
        ];
    }

    /**
     * Custom attribute names untuk penyamaran nama field PIN.
     *
     * @return array<string, string>
     */
    protected function pinAttributes(): array
    {
        return [
            'pin' => 'PIN Keamanan',
            'pin_confirmation' => 'Konfirmasi PIN Keamanan',
        ];
    }
}
