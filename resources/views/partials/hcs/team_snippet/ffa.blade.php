<?php
/** @var string $color */
/** @var App\Models\MatchupTeam $team */
/** @var array $aggregateStats */
?>
@foreach ($matchup->matchupTeams->sortBy('points') as $matchupTeam)
    <?php $player = $matchupTeam->getPlayer(); ?>
    <div class="card has-background-{{ $matchupTeam->isWinner() ? 'success' : 'dark' }}-light">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-32x32">
                        <img src="{{ $player?->emblem_url ?? asset('images/teams/8.png') }}" alt="Emblem">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-6">
                        @if ($player)
                            @include('partials.links.player', ['player' => $player])
                        @else
                            <span>{{ $matchupTeam->name }}</span>
                        @endif
                    </p>
                    <div class="subtitle is-6">
                        <div class="is-pulled-right">
                            <span class="tag is-light">@th($matchupTeam->points) place</span>
                        </div>
                        <div class="is-pulled-left">
                            @if (Arr::has($aggregateStats, $player?->id))
                                @include('partials.hcs.stat_breakdown.ffa', ['stats' => $aggregateStats[$player->id]])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
