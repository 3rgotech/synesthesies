<?php

namespace App\Models;

use App\Enum\Disorder;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'gender',
        'birth_year',
        'citizenship',
        'region',
        'language',
        'keep_informed',
        'disorders',
        'diagnosis',
        'always_existed',
        'has_changed',
        'has_changed_details',
        'problematic',
        'problematic_details',
        'comments',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'keep_informed'  => 'boolean',
        'disorders'      => AsEnumCollection::class . ':' . Disorder::class,
        'always_existed' => 'boolean',
        'has_changed'    => 'boolean',
        'problematic'    => 'boolean',
    ];
}
