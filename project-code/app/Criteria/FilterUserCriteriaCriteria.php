<?php

namespace App\Criteria;

use App\Helpers\Constant;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterUserCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class FilterUserCriteriaCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $isActive = request('is_active');
        $role = request('role');
        $keyword = request('keyword');
        $sort = request('sort', Constant::DEFAULT_SORT_FIELD);
        $order = request('order', Constant::DEFAULT_SORT_ORDER);

        return $model->when(isset($isActive), function ($query) use ($isActive) {
            $query->where('is_active', $isActive);
        })->when($role, function ($query) use ($role) {
            $query->where('role', $role);
        })->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%');
        })->orderBy($sort, $order);
    }
}
