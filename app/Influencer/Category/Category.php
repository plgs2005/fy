<?php

namespace App\Influencer\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'level',
        'child_of',
        'icon_path',
        'require_measurements'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Influencer\User\User', 'users_categories');
    }

    public function campaigns()
    {
        return $this->hasMany('App\Influencer\Campaign\Campaign');
    }

    public function getAllCategories($id = null)
    {
        $firstLvl = $this->getFirstLevelCategories($id);
        $firstLvl = json_decode(json_encode($firstLvl), true);

        foreach ($firstLvl as $key => $cat1) {
            $childs = $this->getChildCategories($cat1['id']);

            if ($childs) {
                $childs = json_decode(json_encode($childs), true);
                $firstLvl[$key]['childs'] = $childs;

                foreach ($firstLvl[$key]['childs'] as $key2 => $cat2) {
                    $childs2 = $this->getChildCategories($cat2['id']);

                    if ($childs2) {
                        $childs2 = json_decode(json_encode($childs2), true);
                        $firstLvl[$key]['childs'][$key2]['childs'] = $childs2;
                    }
                }
            }
        }
        
        foreach ($firstLvl as $key => $cat1) {
            $cat1Copy = $cat1;
            $cat1Copy['name'] = 'All';
            if (isset($cat1['childs'])) {
                array_pop($cat1Copy);
                array_unshift($firstLvl[$key]['childs'], $cat1Copy);
            } else {
                $firstLvl[$key]['childs'][] = $cat1Copy;
            }
        }
        return $firstLvl;
    }

    public function getFirstLevelCategories($id)
    {
        $condition = ['level' => 1];

        if ($id !== null) {
            $condition['id'] = $id;
        }

        return DB::table($this->table)
            ->where($condition)
            ->get(['id', 'name', 'icon_path', 'require_measurements'])
            ->toArray();
    }
    public function getSecondLevelCategories()
    {
        return DB::table($this->table)
            ->where('level', 2)
            ->get(['id', 'name', 'child_of', 'icon_path', 'require_measurements']);
    }

    public function getThirdLevelCategories()
    {
        return DB::table($this->table)
            ->where('level', 3)
            ->get(['id', 'name', 'child_of', 'icon_path', 'require_measurements']);
    }

    public function getChildCategories($id)
    {
        $temp = DB::table($this->table)
            ->where('child_of', $id)
            ->get(['id', 'name', 'child_of', 'icon_path', 'require_measurements']);

        if ($temp->count() == 0) {
            return false;
        }

        return $temp;
    }

    /**
     * Returns categories and childs of user for using in template list
     *
     * @param integer $id
     * @param array|null $userCategories
     * @return array
     */
    public function createCatoriesAndChildrens(int $id, ?array $userCategories): array
    {
        $parentLevel = $this->getFirstLevelCategories($id);

        foreach ($parentLevel as $key => $firstChild) {

            $firstChilds = $this->getChildCategories($firstChild->id);

            if ($firstChilds) {

                $parentLevel[$key]->childs = $this->checkCategorieExistsInUser($firstChilds, $userCategories);

                foreach ($parentLevel[$key]->childs as $key2 => $secondChild) {

                    $secondChilds = $this->getChildCategories($secondChild->id);

                    if ($secondChilds) {
                        $parentLevel[$key]->childs[$key2]->childs = $secondChilds;
                    }
                }
            }
        }

        return $parentLevel;
    }

    /**
     * Method to filter only as user-owned categories and children
     *
     * @param \Illuminate\Support\Collection $firstChilds All childrens found in categories
     * @param array|null $userCategories Categories of user
     * @return array Filtered categories of user
     */
    public function checkCategorieExistsInUser(
        \Illuminate\Support\Collection $firstChilds,
        ?array $userCategories
    ): array {

        $categoriesChildsOfUser = [];
        foreach ($firstChilds as $first) {
            if (in_array($first->id, $userCategories)) {
                $categoriesChildsOfUser[] = $first;
            }
        }

        return $categoriesChildsOfUser;
    }
}
