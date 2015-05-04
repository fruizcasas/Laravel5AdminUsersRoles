<?php namespace App\Library;
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 3/05/15
 * Time: 12:37
 */

class Status {
    const STATUS_FP_DRAFT='DRAFT';
    const STATUS_FP_TO_BE_REVIEWED='TO_BE_REVIEWED';
    const STATUS_FP_REVIEWED='REVIEWED';
    const STATUS_FP_TO_BE_APPROVED='TO_BE_APPROVED';
    const STATUS_FP_APPROVED='APPROVED';
    const STATUS_FP_TO_BE_PUBLISHED='TO_BE_PUBLISHED';
    const STATUS_FP_PUBLISHED='PUBLISHED';
    const STATUS_FP_ARCHIVED='ARCHIVED';

    static public function getFrontPageStatus()
    {
        return [
            null => 'None',
            static::STATUS_FP_DRAFT => static::STATUS_FP_DRAFT,
            static::STATUS_FP_TO_BE_REVIEWED => static::STATUS_FP_TO_BE_REVIEWED,
            static::STATUS_FP_REVIEWED =>static::STATUS_FP_REVIEWED,
            static::STATUS_FP_TO_BE_APPROVED => static::STATUS_FP_TO_BE_APPROVED,
            static::STATUS_FP_APPROVED => static::STATUS_FP_APPROVED,
            static::STATUS_FP_TO_BE_PUBLISHED => static::STATUS_FP_TO_BE_PUBLISHED,
            static::STATUS_FP_PUBLISHED => static::STATUS_FP_PUBLISHED,
            static::STATUS_FP_ARCHIVED => static::STATUS_FP_ARCHIVED,
        ];

    }

}