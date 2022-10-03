<?php

namespace App\Influencer\UserCategory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserCategory extends Model
{
    protected $table = 'users_categories';

    protected $fillable = [
        'user_id',
        'category_id'
    ];

    /**
     * Returns count of categories
     *
     * @param int $userId
     * @return integer
     */
    public function getCategoriesByUser(int $userId): int
    {
        return DB::table($this->table)
            ->where([
                'level' => 1,
                'user_id' => $userId
            ])
            ->join('categories', 'users_categories.category_id', '=', 'categories.id')
            ->get()
            ->count();
    }

    /**
     * Check if already exists category type of parent
     *
     * @param integer $userId
     * @param integer $categoryId
     * @return \Illuminate\Support\Collection
     */
    public function checkExistsParentCategory(int $userId, int $categoryId): \Illuminate\Support\Collection
    {
        return DB::table($this->table)
            ->where([
                'categories.level' => 1,
                'users_categories.category_id' => $categoryId,
                'users_categories.user_id' => $userId
            ])
            ->join('categories', 'users_categories.category_id', '=', 'categories.id')
            ->get();
    }
}
