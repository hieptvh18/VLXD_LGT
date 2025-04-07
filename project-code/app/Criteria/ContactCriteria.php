<?php

namespace App\Criteria;

use App\Helpers\Constant;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ContactCriteria.
 *
 * @package namespace App\Criteria;
 */
class ContactCriteria implements CriteriaInterface
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
        $keyword = request('keyword');
        $itemId = request('item_id');
        $sort = request('sort', Constant::DEFAULT_SORT_FIELD);
        $order = request('order', Constant::DEFAULT_SORT_ORDER);

        return $model::with(['item' => function ($query) {
            $query->withTrashed();
        }])->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%');
        })->orderBy($sort, $order);
    }
}
