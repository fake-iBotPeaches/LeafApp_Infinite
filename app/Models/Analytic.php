<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\AnalyticKey;
use App\Support\Analytics\AnalyticInterface;
use App\Support\Analytics\Stats\BestAccuracyServiceRecord;
use App\Support\Analytics\Stats\BestKDAServiceRecord;
use App\Support\Analytics\Stats\BestKDServiceRecord;
use App\Support\Analytics\Stats\MostBetrayalsServiceRecord;
use App\Support\Analytics\Stats\MostKillsInRankedGame;
use App\Support\Analytics\Stats\MostKillsServiceRecord;
use App\Support\Analytics\Stats\MostTimePlayedServiceRecord;
use App\Support\Analytics\Stats\MostMedalsServiceRecord;
use Carbon\Carbon;
use Database\Factories\AnalyticFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use UnexpectedValueException;

/**
 * @property int $id
 * @property string $key
 * @property ?int $game_id
 * @property int $player_id
 * @property float $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read ?Game $game
 * @property-read Player $player
 * @property-read AnalyticInterface $stat
 * @method static AnalyticFactory factory(...$parameters)
 */
class Analytic extends Model
{
    use HasFactory;

    public $guarded = [
        'id'
    ];

    public function getStatAttribute(): AnalyticInterface
    {
        return self::getStatFromEnum(AnalyticKey::tryFrom($this->key));
    }

    public static function getStatFromEnum(?AnalyticKey $key): AnalyticInterface
    {
        return match ($key) {
            AnalyticKey::MOST_TIME_PLAYED_SR => new MostTimePlayedServiceRecord(),
            AnalyticKey::MOST_KILLS_SR => new MostKillsServiceRecord(),
            AnalyticKey::MOST_KILLS_RANKED_GAME => new MostKillsInRankedGame(),
            AnalyticKey::MOST_BETRAYALS_SR => new MostBetrayalsServiceRecord(),
            AnalyticKey::MOST_MEDALS_SR => new MostMedalsServiceRecord(),
            AnalyticKey::BEST_ACCURACY_SR => new BestAccuracyServiceRecord(),
            AnalyticKey::BEST_KD_SR => new BestKDServiceRecord(),
            AnalyticKey::BEST_KDA_SR => new BestKDAServiceRecord(),
            default => throw new UnexpectedValueException('Unknown value in getStatFromEnum')
        };
    }

    public static function purgeKey(string $key): void
    {
        self::query()
            ->where('key', $key)
            ->delete();
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}