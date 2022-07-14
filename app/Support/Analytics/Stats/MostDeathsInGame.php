<?php
declare(strict_types = 1);

namespace App\Support\Analytics\Stats;

use App\Enums\AnalyticKey;
use App\Models\Analytic;
use App\Support\Analytics\AnalyticInterface;
use App\Support\Analytics\BaseGameStat;
use Illuminate\Database\Eloquent\Collection;

class MostDeathsInGame extends BaseGameStat implements AnalyticInterface
{
    public function title(): string
    {
        return 'Most Deaths in Game';
    }

    public function key(): string
    {
        return AnalyticKey::MOST_DEATHS_GAME->value;
    }

    public function unit(): string
    {
        return 'deaths';
    }

    public function property(): string
    {
        return 'deaths';
    }

    public function displayProperty(Analytic $analytic): string
    {
        return number_format($analytic->value);
    }

    public function results(): ?Collection
    {
        return $this->builder()
            ->select('game_players.*')
            ->with(['game', 'player'])
            ->leftJoin('players', 'players.id', '=', 'game_players.player_id')
            ->where('players.is_cheater', false)
            ->leftJoin('games', 'game_players.game_id', '=', 'games.id')
            ->orderByDesc($this->property())
            ->limit(10)
            ->get();
    }
}
