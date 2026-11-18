<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

trait ProfileValidationRules
{
    /**
     * Prepare/sanitize profile input data before validation or saving.
     * Mengubah username, email, dan referral_id menjadi lowercase serta membersihkan spasi.
     *
     * @param  array<string, mixed>  $input
     * @return array<string, mixed>
     */
    protected function prepareProfileInput(array $input): array
    {
        if (isset($input['name'])) {
            $input['name'] = trim($input['name']);
        }

        if (isset($input['username'])) {
            $input['username'] = Str::lower(trim($input['username']));
        }

        if (isset($input['email'])) {
            $input['email'] = Str::lower(trim($input['email']));
        }

        if (isset($input['phone'])) {
            $input['phone'] = trim($input['phone']);
        }

        if (isset($input['referral_id'])) {
            $input['referral_id'] = Str::lower(trim($input['referral_id']));
        }

        return $input;
    }
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?string $userId = null): array
    {
        return [
            'name' => $this->nameRules(),
            'username' => $this->usernameRules($userId),
            'phone' => $this->phoneRules($userId),
            'email' => $this->emailRules($userId),
        ];
    }

    /**
     * Custom messages for profile validation rules.
     *
     * @return array<string, string>
     */
    protected function profileMessages(): array
    {
        return [
            'name.regex' => ':attribute hanya boleh berisi huruf, spasi, petik tunggal, titik, dan tanda hubung.',
            'username.regex' => ':attribute hanya boleh berisi huruf kecil, angka, dan garis bawah (_), tanpa spasi.',
            'phone.regex' =>
            ':attribute harus diawali dengan 08 dan diikuti nomor operator yang valid (contoh: 08123456789).',
        ];
    }
    /**
     * Custom attribute names for disguising or friendly display names.
     *
     * @return array<string, string>
     */
    protected function profileAttributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'username' => 'Username',
            'phone' => 'Nomor Telepon',
            'email' => 'Alamat Email',
            'referral_id' => 'Kode Referral',
        ];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:100', 'min:2', 'regex:/^[a-zA-Z\s\'\.\-]+$/'];
    }
    protected function usernameRules(?string $userId = null): array
    {
        return [
            'required',
            'string',
            'min:2',
            'max:30',
            'regex:/^[a-z0-9]+(?:_[a-z0-9]+)*$/',
            $userId === null ? Rule::unique(User::class) : Rule::unique(User::class)->ignore($userId),
        ];
    }
    protected function phoneRules(?string $userId = null): array
    {
        return [
            'required',
            'string',
            'min:9',
            'max:14',
            'regex:/^08[1-9][0-9]+$/',
            $userId === null ? Rule::unique(User::class) : Rule::unique(User::class)->ignore($userId),
        ];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?string $userId = null): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $userId === null ? Rule::unique(User::class) : Rule::unique(User::class)->ignore($userId),
        ];
    }
}
