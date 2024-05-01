<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LikertTest extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'scale',
        'fixed_order',
        'score_computation_method'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scale'       => 'json',
        'fixed_order' => 'boolean'
    ];

    public function testData(): HasMany
    {
        return $this->hasMany(LikertTestSubject::class, 'likert_test_id', 'id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(LikertTestQuestion::class);
    }
}
