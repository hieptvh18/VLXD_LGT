<?php

namespace App\Criteria;

use App\Helpers\Constant;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ItemCriteria.
 *
 * @package namespace App\Criteria;
 */
class ItemCriteria implements CriteriaInterface
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
        $type = request('type'); // ban or cho thue
        $status = request('status'); // ban or cho thue
        $wardId = request('ward_id'); // ID địa chỉ phường xã 
        $categoryId = request('category_id'); // ID địa chỉ phường xã 
        $keyword = request('keyword');
        $sort = request('sort', Constant::DEFAULT_SORT_FIELD);
        $order = request('order', Constant::DEFAULT_SORT_ORDER);

        return $model->when(isset($isFeatured), function ($query) use ($isFeatured) {
            $query->where('is_featured', $isFeatured);
        })->when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })->when($categoryId, function ($query) use ($categoryId) {
            $query->whereHas('categories', function($q) use($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        })->when($wardId, function ($query) use ($wardId) {
            $query->where('ward_id', $wardId);
        })->when($keyword, function ($query) use ($keyword) {
            $query->where('item_name', 'like', '%' . $keyword . '%')
                ->orWhere('item_code', 'like', '%' . $keyword . '%')
                ->orWhere('slug', 'like', '%' . $keyword . '%');
        })->orderBy($sort, $order);
    }
}
