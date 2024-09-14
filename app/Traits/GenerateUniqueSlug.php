<?php


namespace App\Traits;

use App\Models\User;

trait GenerateUniqueSlug
{
    /**
     * Generate a unique slug for a given model.
     *
     * @param string $title
     * @param string $model
     * @param string $column
     * @return string
     */
    public function generate($baseSlug)
    {
        $slug = $baseSlug;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
