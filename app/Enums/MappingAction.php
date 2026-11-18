<?php

namespace App\Enums;

enum MappingAction: string
{
    case CEK = 'cek';
    case BAYAR = 'bayar';
    case INPUT = 'input';
    case PRABAYAR = 'prabayar';
    case HELPER = 'helper';
}
