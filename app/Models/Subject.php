<?php

namespace App\Models;

use App\Enum\Disorder;
use App\Enum\Gender;
use App\Enum\Region;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Subject extends Model implements Authenticatable
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
        'disordersWithDiagnosis',
        'other_disorders',
        'synesthesies',
        'spatial_synesthesies',
        'subtitles',
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
        'gender'               => Gender::class,
        'region'               => Region::class,
        'keep_informed'        => 'boolean',
        'disorders'            => AsEnumCollection::class . ':' . Disorder::class,
        'diagnosis'            => 'array',
        'synesthesies'         => 'array',
        'spatial_synesthesies' => 'array',
        'subtitles'            => 'boolean',
        'always_existed'       => 'boolean',
        'has_changed'          => 'boolean',
        'problematic'          => 'boolean',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'other_disorders' => '',
        'comments'        => '',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['disordersWithDiagnosis'];

    public function testData(): HasMany
    {
        return $this->hasMany(SubjectTest::class, 'subject_id', 'id');
    }

    public function liketTestData(): HasMany
    {
        return $this->hasMany(LikertTestSubject::class, 'subject_id', 'id');
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return Hash::make('password');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        if (!empty($this->getRememberTokenName())) {
            return (string) $this->{$this->getRememberTokenName()};
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (!empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getDisordersWithDiagnosisAttribute()
    {
        return $this->disorders->map(fn ($disorder) => [
            'disorder'  => $disorder->value,
            'diagnosis' => $this->diagnosis[$disorder->value] ?? null,
        ])->all();
    }

    public function setDisordersWithDiagnosisAttribute($value)
    {
        $this->disorders = collect($value)
            ->pluck('disorder')
            ->unique()
            ->map(fn ($disorder) => Disorder::tryFrom($disorder))
            ->filter(fn ($v) => filled($v));
        $this->diagnosis = collect($value)->pluck('diagnosis', 'disorder')->all();
    }
}
