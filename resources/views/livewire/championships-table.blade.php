<?php
/** @var App\Models\Championship[] $championships */
?>
<div>
    <div class="table-container">
        <table class="table is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>Tournament</th>
                <th>Region</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($championships as $championship)
                <tr>
                    <td>
                        <a href="{{ route('championship', [$championship]) }}">
                            {{ $championship->name }}
                        </a>
                    </td>
                    <td>{{ $championship->region->description }}</td>
                    <td>{{ $championship->started_at->toDateString() }}</td>
                    <td>{{ $championship->status?->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $championships->links(data: ['scrollTo' => false]) }}
</div>
