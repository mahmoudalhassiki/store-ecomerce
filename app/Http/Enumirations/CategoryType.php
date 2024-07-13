<?php


namespace App\Http\Enumirations;
use Spatie\Enum\Enum;
//use Spatie\Enum\Laravel\Enum;

final class CategoryType extends Enum
{
    const mainCategory = 1;
    const subCategory = 2;
}
