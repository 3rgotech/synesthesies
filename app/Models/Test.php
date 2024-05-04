<?php

namespace App\Models;

use App\Enum\Perception;
use App\Enum\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'icon',
        'duration',
        'perception',
        'response',
        'stimuli',
        'repetitions',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'perception' => Perception::class,
        'response'   => Response::class,
        'stimuli'    => 'array',
    ];

    public function testData(): HasMany
    {
        return $this->hasMany(SubjectTest::class, 'test_id', 'id');
    }

    public function getTestComponent(): ?string
    {
        if ($this->response === Response::COLOR) {
            if ($this->perception === Perception::DIGIT || $this->perception === Perception::LETTER) {
                return 'grapheme-color-test';
            }
        }
        return null;
    }

    public function getResultsComponent(): ?string
    {
        if ($this->response === Response::COLOR) {
            if ($this->perception === Perception::DIGIT || $this->perception === Perception::LETTER) {
                return 'grapheme-color-results';
            }
        }
        return null;
    }
}
