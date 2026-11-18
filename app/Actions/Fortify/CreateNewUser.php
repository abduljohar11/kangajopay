<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Concerns\PinValidationRules;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules, PinValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        //pembersih
        $input = $this->prepareProfileInput($input);
        Validator::make(
            $input,
            [
                ...$this->profileRules(),
                'pin' => $this->pinWithConfirmationRules(),
                'password' => $this->passwordRules(),
                'referral_id' => ['nullable', 'regex:/^[a-z0-9]+(?:_[a-z0-9]+)*$/', 'exists:users,username'],
            ],
            [
                ...$this->profileMessages(),
                ...$this->pinMessages(),
                ...$this->passwordMessages(),
                'referral_id.exists' => ':attribute yang dimasukkan tidak ditemukan.',
            ],
            [
                ...$this->profileAttributes(),
                ...$this->pinAttributes(),
                ...$this->passwordAttributes(),
                'referral_id' => 'Kode Referral',
            ],
        )->validate();

        $referralId = !empty($input['referral_id'])
            ? User::where('username', $input['referral_id'])->value('id')
            : null;
        $levelId = Level::where('is_default', true)->value('id') ?? (Level::where('slug', 'mitra')->value('id') ?? 1);
        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => $input['password'],
            'pin' => $input['pin'],
            'level_id' => $levelId,
            'referral_id' => $referralId,
        ]);
    }
}
