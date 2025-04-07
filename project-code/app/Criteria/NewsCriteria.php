<?php

namespace App\Criteria;

use App\Helpers\Constant;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NewsCriteria.
 *
 * @package namespace App\Criteria;
 */
class NewsCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $isFeatured = request('is_featured');
        $isFirstPage = request('is_first_page');
        $status = request('status'); // ban or cho thue
        $categoryId = request('category_id'); // ID địa chỉ phường xã
        $keyword = request('keyword');
        $sort = request('sort', Constant::DEFAULT_SORT_FIELD);
        $order = request('order', Constant::DEFAULT_SORT_ORDER);

        return $model->when(isset($isFirstPage), function ($query) use ($isFirstPage) {
            $query->where('is_first_page', $isFirstPage);
        })->when(isset($isFeatured), function ($query) use ($isFeatured) {
            $query->where('is_featured', $isFeatured);
        })->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })->when($categoryId, function ($query) use ($categoryId) {
            $query->whereHas('categories', function($q) use($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        })->when($keyword, function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('slug', 'like', '%' . $keyword . '%');
        })
            ->orderByDesc('is_first_page')
            ->orderBy($sort, $order);
    }
}
