<?php

namespace App\Criteria;

use App\Helpers\Constant;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterCategoryCriteria.
 *
 * @package namespace App\Criteria;
 */
class FilterCategoryCriteria implements CriteriaInterface
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
        $type = request('type');
        $isActive = request('is_active');
        $keyword = request('keyword');
        $sort = request('sort', Constant::DEFAULT_SORT_FIELD);
        $order = request('order', Constant::DEFAULT_SORT_ORDER);

        return $model->when(isset($isActive), function ($query) use ($isActive) {
            $query->where('is_active', $isActive);
        })->when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->orderBy($sort, $order);
    }
}
