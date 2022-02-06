<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\Bracket;
use App\Models\Contracts\HasFaceItApi;
use App\Services\FaceIt\Enums\Region;
use Carbon\Carbon;
use Database\Factories\ChampionshipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $faceit_id
 * @property string $name
 * @property Region $region
 * @property Carbon $started_at
 * @property-read Matchup[]|Collection $matchups
 * @property-read string $faceitUrl
 * @property-read bool $is_ffa
 * @property-read bool $has_championship
 * @method static ChampionshipFactory factory(...$parameters)
 */
class Championship extends Model implements HasFaceItApi
{
    use HasFactory;

    public $guarded = [
        'id',
    ];

    public $dates = [
        'started_at'
    ];

    public $casts = [
        'region' => Region::class
    ];

    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'faceit_id';
    }

    public function setRegionAttribute(string $value): void
    {
        $region = is_numeric($value) ? Region::fromValue((int) $value) : Region::coerce(Str::upper($value));
        if (empty($region)) {
            throw new \InvalidArgumentException('Invalid Region Enum (' . $value . ')');
        }

        $this->attributes['region'] = $region->value;
    }

    public function setStartedAtAttribute(string $value): void
    {
        $this->attributes['started_at'] = Carbon::createFromTimestampMsUTC($value);
    }

    public function getFaceitUrlAttribute(): string
    {
        return 'https://www.faceit.com/en/championship/' . $this->faceit_id . '/' . $this->name;
    }

    public function getIsFfaAttribute(): bool
    {
        return Str::contains($this->name, 'FFA');
    }

    public function getHasChampionshipAttribute(): bool
    {
        return $this->matchups()->where('group', Bracket::GRAND()->toNumerical())->exists();
    }

    public static function fromFaceItApi(array $payload): ?self
    {
        $championshipId = Arr::get($payload, 'id');

        /** @var Championship $championship */
        $championship = self::query()
            ->where('faceit_id', $championshipId)
            ->firstOrNew([
                'faceit_id' => $championshipId
            ]);

        $championship->name = Arr::get($payload, 'name');
        $championship->region = Arr::get($payload, 'region');
        $championship->started_at = Arr::get($payload, 'championship_start');

        if ($championship->isDirty()) {
            $championship->saveOrFail();
        }

        return $championship;
    }

    public function matchups(): HasMany
    {
        return $this->hasMany(Matchup::class);
    }
}
