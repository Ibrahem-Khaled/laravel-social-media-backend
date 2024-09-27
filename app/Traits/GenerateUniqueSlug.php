<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Models\User;

trait GenerateUniqueSlug
{
    /**
     * Generate a unique slug for a given model.
     *
     * @param string $baseSlug
     * @return string
     */
    public function generate($baseSlug)
    {
        $slug = Str::slug($baseSlug);
        $originalSlug = $slug;

        if (User::where('slug', $slug)->exists()) {
            $count = 1;
            do {
                $slug = $originalSlug . '-' . $count;
                $count++;
            } while (User::where('slug', $slug)->exists());
        }

        return $slug;
    }
}
