<?php

namespace App\Enums;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

enum CategoryType: string
{
    case PREFIX = 'prefix';
    case VOUCHER = 'voucher';
    case GAME = 'game';
    case PRABAYAR = 'prabayar';
    case PASCABAYAR = 'pascabayar';

    /**
     * Daftar ikon bawaan dari Lucide Icon.
     */
    public function lucideIcons(): array
    {
        return [
            'Smartphone',
            'Wifi',
            'Zap',
            'Wallet',
            'Gamepad2',
            'HeartPulse',
            'Droplets',
            'PhoneCall',
            'Tv',
            'SmartphoneNfc',
            'Flame',
            'Receipt',
            'CreditCard',
            'Box',
            'HelpCircle',
        ];
    }

    /**
     * Memindai ikon gambar custom dari folder storage secara ketat (strict group scanning) dengan Cache.
     */
    public function scan(): array
    {
        return Cache::rememberForever('category_icons', function () {
            $disk = Storage::disk('public');

            if (!$disk->exists('icons')) {
                return [];
            }

            $allowedGroups = ['operator', 'prabayar', 'pascabayar', 'game'];
            $result = [];
            $hasAnyFile = false;

            foreach ($allowedGroups as $group) {
                $folderPath = "icons/{$group}";
                $result[$group] = [];

                if ($disk->exists($folderPath)) {
                    $files = $disk->files($folderPath);

                    foreach ($files as $file) {
                        $fileName = basename($file);

                        if (preg_match('/\.(svg|png|webp|jpg|jpeg)$/i', $fileName)) {
                            $result[$group][] = "{$group}/{$fileName}";
                            $hasAnyFile = true;
                        }
                    }
                }
            }

            return $hasAnyFile ? $result : [];
        });
    }

    /**
     * Menggabungkan ikon Lucide dan grup-grup ikon hasil scan secara langsung.
     */
    public function getAvailableIcons(): array
    {
        return array_merge(['lucide' => $this->lucideIcons()], $this->scan());
    }

    /**
     * validasi
     */

    public static function isValidation(string $inputType, string $inputIcon): bool
    {
        // FormRequest sudah memastikan $inputType selalu valid
        $expectedGroup = match ($inputType) {
            'prefix', 'voucher' => 'operator',
            'prabayar' => 'prabayar',
            'pascabayar' => 'pascabayar',
            'game' => 'game',
        };

        $slashCount = substr_count($inputIcon, '/');

        // 1. Tanpa garis miring -> Pengecekan Ikon Lucide
        if ($slashCount === 0) {
            return in_array($inputIcon, self::lucideIcons(), true);
        }

        // 2. Tepat 1 garis miring -> Pengecekan Custom Icon (Grup/NamaFile)
        if ($slashCount === 1) {
            [$folder, $filename] = explode('/', $inputIcon);

            // Folder sebelum '/' harus sesuai dengan grupnya
            if ($folder !== $expectedGroup) {
                return false;
            }

            // Nama file setelah '/' tidak boleh kosong
            if (empty($filename)) {
                return false;
            }

            // Cek keberadaan file di hasil scan() untuk grup tersebut
            $scannedIcons = self::scan();
            $groupIcons = $scannedIcons[$expectedGroup] ?? [];

            return in_array($inputIcon, $groupIcons, true);
        }

        // 3. Jika garis miring lebih dari 1 (misal 2, 3, dst.) -> Langsung tolak (false)
        return false;
    }
    /**
     * Clear cache scan ikon.
     */
    public static function clearIconCache(): void
    {
        Cache::forget('category_icons');
    }
}
