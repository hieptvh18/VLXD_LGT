<?php

namespace App\Helpers;

class Constant
{

    const LIMIT_NUMBER = 20;

    // role user
    const USER_CUSTOMER_ROLE = 'CUSTOMER';
    const USER_ADMIN_ROLE = 'ADMIN';
    const USER_SUPER_ADMIN_ROLE = 'SUPER_ADMIN';

    const USER_ROLE_TEXT = [
        'CUSTOMER' => 'Khách hàng',
        'ADMIN' => 'Nhân viên',
        'SUPER_ADMIN' => 'Super Admin',
    ];

    // user status
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_DEACTIVE = 0;

    // user role
    const USER_ROLES_NAME = [
        'CUSTOMER' => 'Khách hàng',
        'ADMIN' => 'Admin',
        'SUPER_ADMIN' => 'Super Admin',
    ];

    const DEFAULT_SORT_ORDER = 'DESC';
    const DEFAULT_SORT_FIELD = 'created_at';

    // item bds type
    const ITEM_TYPE_SELL = 'SELL'; // ban
    const ITEM_TYPE_RENT = 'RENT'; // cho thue

    // status bds
    const ITEM_TYPE_TEXT = [
        'SELL' => 'Bán',
        'RENT' => 'Cho thuê',
    ];

    // status bds
    const ITEM_STATUS_TEXT = [
        'OPEN_SALE' => 'Mở bán',
        'ON_SALE' => 'Đang bán',
        'SOLD' => 'Đã bán',
        'DISABLE' => 'Ẩn',
    ];

    // 'DONG','TAY','NAM','BAC','DONG_NAM','TAY_NAM','DONG_BAC','TAY_BAC',
    const HOME_DIRECTION = [
        'DONG' => 'Đông',
        'TAY' => 'Tây',
        'NAM' => 'Nam',
        'BAC' => 'Bắc',
        'DONG_NAM' => 'Đông Nam',
        'TAY_NAM' => 'Tây Nam',
        'DONG_BAC' => 'Đông Bắc',
        'TAY_BAC' => 'Tây Bắc',
    ];

    // const tab page edit item bds
    const ITEM_EDIT_VIEW_INFO = 'basic-info';
    const ITEM_EDIT_VIEW_MEDIA = 'media';

    // category type
    const CATE_TYPE_ITEM = 'ITEM';
    const CATE_TYPE_NEWS = 'NEWS';
    const CATE_TYPE_PROJECT = 'PROJECT';

    const CATE_TYPE_TEXT = [
        'ITEM' => 'BDS',
        'NEWS' => 'Tin tức',
        'PROJECT' => 'Dự án',
    ];

    // new status text
    const NEWS_STATUS_TEXT = [
        'DRAFT' => 'Bản nháp',
        'PUBLISH' => 'Đã đăng',
    ];

    // color status item
    const ITEM_STATUS_COLOR = [
        'DISABLE' => '#ccc',
        'ON_SALE' => '#42edb4',
        'OPEN_SALE' => '#52d1f7',
        'SOLID' => '#f76fea',
    ];
    const ITEM_STATUS_DISABLE_COLOR = '#ccc';
    const ITEM_STATUS_ON_SALE_COLOR = '#42edb4';
    const ITEM_STATUS_OPEN_SALE_COLOR = '#52d1f7';
    const ITEM_STATUS_SOLID_COLOR = '#f76fea';
}
