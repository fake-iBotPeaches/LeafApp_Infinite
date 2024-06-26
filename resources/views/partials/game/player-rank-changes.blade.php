<?php
/** @var App\Models\Game $game */
?>
@foreach($game->players as $gamePlayer)
    @if ($gamePlayer->csr_rank_change_message)
        <article class="message is-small {{ $gamePlayer->team->color ?? 'is-dark' }} mb-1">
            <div class="message-body">
                @include('partials.links.player', ['player' => $gamePlayer->player])
                {{ $gamePlayer->csr_rank_change_message }}
            </div>
        </article>
    @endif
@endforeach
