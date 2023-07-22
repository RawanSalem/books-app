<?php

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;


class BookFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    public $filters = ['search', 'category'];


    /**
     * Search query
     * @param string $search
     * @return Builder
     */
    public function search($search) : Builder
    {
        return $this->builder->where('name', 'LIKE', "%{$search}%")
            ->orWhere('ISBN', 'LIKE', "%{$search}%")
            ->orWhereHas('author', function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%");
                })
            ->orWhereHas('publisher', function($query) use($search){
                return $query->where('name', 'LIKE', "%{$search}%");
            });
    }

    /**
     * Filter the query by a given category.     
     * @param integer $category
     * @return Builder
     */
    public function category($category) : Builder
    {
        return $this->builder->whereHas('categories', function ($query) use ($category) {
                return $query->where('id', $category);
                });
    }   
}
