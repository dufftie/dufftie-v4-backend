<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ToDo: Add $body for Artwork class
 */
/**
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $publishDate
 * @property string $daysSpent
 * @property string $preview
 * @property string $bgColor
 * @property boolean $hidden
 * @property string $created_at
 * @property string $updated_at
 */
class Artwork extends Model
{
    protected $table = 'artwork';

    const ID = 'id';
    const NAME = 'name';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const PUBLISH_DATE = 'publishDate';
    const DAYS_SPENT = 'daysSpent';
    const PREVIEW = 'preview';
    const BG_COLOR = 'bgColor';
    const IS_HIDDEN = 'hidden';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        Artwork::ID,
        Artwork::NAME,
        Artwork::TITLE,
        Artwork::DESCRIPTION,
        Artwork::PUBLISH_DATE,
        Artwork::DAYS_SPENT,
        Artwork::PREVIEW,
        Artwork::BG_COLOR,
        Artwork::IS_HIDDEN,
        Artwork::CREATED_AT,
        Artwork::UPDATED_AT,
    ];
}
