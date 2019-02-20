<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Set
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Card[] $cards
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Set whereUpdatedAt($value)
 */
class Set extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
