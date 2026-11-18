<script setup lang="ts">
import { Form, Head } from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import PasswordInput from "@/components/PasswordInput.vue";
import TextLink from "@/components/TextLink.vue";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Spinner } from "@/components/ui/spinner";
import { login } from "@/routes";
import { store } from "@/routes/register";

defineProps<{
    passwordRules?: string;
}>();

defineOptions({
    layout: {
        title: "Buat Akun",
        description:
            "Masukkan detail informasi Anda di bawah untuk membuat akun baru",
    },
});
</script>

<template>
    <Head title="Daftar Akun" />

    <Form
        v-bind="store.form()"
        :reset-on-success="[
            'password',
            'password_confirmation',
            'pin',
            'pin_confirmation',
        ]"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-6">
            <!-- Nama Lengkap -->
            <div class="grid gap-2">
                <Label for="name">Nama Lengkap</Label>
                <Input
                    id="name"
                    type="text"
                    required
                    v-focus
                    :tabindex="1"
                    autocomplete="name"
                    name="name"
                    placeholder="Nama Lengkap"
                />
                <InputError :message="errors.name" />
            </div>

            <!-- Username -->
            <div class="grid gap-2">
                <Label for="username">Username</Label>
                <Input
                    id="username"
                    type="text"
                    required
                    :tabindex="2"
                    autocomplete="username"
                    name="username"
                    placeholder="Masukkan username"
                />
                <InputError :message="errors.username" />
            </div>

            <!-- No HP / WhatsApp -->
            <div class="grid gap-2">
                <Label for="phone">Nomor HP/WhatsApp</Label>
                <Input
                    id="phone"
                    type="tel"
                    required
                    :tabindex="3"
                    autocomplete="tel"
                    name="phone"
                    placeholder="0857XXXXXXXX"
                />
                <InputError :message="errors.phone" />
            </div>

            <!-- Email -->
            <div class="grid gap-2">
                <Label for="email">Alamat Email</Label>
                <Input
                    id="email"
                    type="email"
                    required
                    :tabindex="4"
                    autocomplete="email"
                    name="email"
                    placeholder="email@example.com"
                />
                <InputError :message="errors.email" />
            </div>

            <!-- Password -->
            <div class="grid gap-2">
                <Label for="password">Kata Sandi</Label>
                <PasswordInput
                    id="password"
                    required
                    :tabindex="5"
                    autocomplete="new-password"
                    name="password"
                    placeholder="Masukkan kata sandi"
                    :passwordrules="passwordRules"
                />
                <InputError :message="errors.password" />
            </div>

            <!-- Password Confirmation -->
            <div class="grid gap-2">
                <Label for="password_confirmation">Konfirmasi Kata Sandi</Label>
                <PasswordInput
                    id="password_confirmation"
                    required
                    :tabindex="6"
                    autocomplete="new-password"
                    name="password_confirmation"
                    placeholder="Ulangi kata sandi"
                    :passwordrules="passwordRules"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <!-- PIN -->
            <div class="grid gap-2">
                <Label for="pin">PIN Transaksi</Label>
                <PasswordInput
                    id="pin"
                    required
                    :tabindex="7"
                    autocomplete="off"
                    name="pin"
                    placeholder="Masukkan PIN"
                />
                <InputError :message="errors.pin" />
            </div>

            <!-- PIN Confirmation -->
            <div class="grid gap-2">
                <Label for="pin_confirmation">Konfirmasi PIN Transaksi</Label>
                <PasswordInput
                    id="pin_confirmation"
                    required
                    :tabindex="8"
                    autocomplete="off"
                    name="pin_confirmation"
                    placeholder="Ulangi PIN"
                />
                <InputError :message="errors.pin_confirmation" />
            </div>

            <!-- Kode Referral (Opsional) -->
            <div class="grid gap-2">
                <Label for="referral_id">Kode Referral (Opsional)</Label>
                <Input
                    id="referral_id"
                    type="text"
                    :tabindex="9"
                    autocomplete="off"
                    name="referral_id"
                    placeholder="Username pengajak (jika ada)"
                />
                <InputError :message="errors.referral_id" />
            </div>

            <!-- Tombol Submit -->
            <Button
                type="submit"
                class="mt-2 w-full"
                :tabindex="10"
                :disabled="processing"
                data-test="register-user-button"
            >
                <Spinner v-if="processing" />
                Buat Akun
            </Button>
        </div>

        <!-- Link ke Halaman Login -->
        <div class="text-center text-sm text-muted-foreground">
            Sudah punya akun?
            <TextLink
                :href="login()"
                class="underline underline-offset-4"
                :tabindex="11"
                >Masuk</TextLink
            >
        </div>
    </Form>
</template>
