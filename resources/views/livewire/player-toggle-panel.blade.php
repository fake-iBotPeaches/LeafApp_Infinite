<div class="notification mb-1">
    <div class="control has-icons-left">
        <div class="select is-medium is-fullwidth">
            <span class="icon is-large is-left">
                <i class="fas fa-globe"></i>
            </span>
            <select wire:model="playerType" wire:change="onChange">
                <option value="{{ App\Enums\Mode::MATCHMADE_RANKED }}">Ranked Only</option>
                <option value="{{ App\Enums\Mode::MATCHMADE_PVP }}">All PVP</option>
            </select>
        </div>
    </div>
</div>