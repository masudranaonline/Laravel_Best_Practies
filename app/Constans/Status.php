<?php
namespace App\Constans;
// namespace app\Constants;


class Status 
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';

    public const LIST = [
        self::DRAFT,
        self::PUBLISHED
    ];
}