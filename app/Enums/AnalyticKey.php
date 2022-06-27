<?php
declare(strict_types=1);

namespace App\Enums;

enum AnalyticKey: string
{
    case BEST_ACCURACY_SR = 'best_accuracy_sr';
    case BEST_KDA_SR = 'best_kda_sr';
    case BEST_KD_SR = 'best_ka_sr';
    case MOST_BETRAYALS_SR = 'most_betrayals_sr';
    case MOST_KILLS_SR = 'most_kills_sr';
    case MOST_MEDALS_SR = 'most_medals_sr';
    case MOST_TIME_PLAYED_SR = 'most_time_played_sr';

    case MOST_KILLS_RANKED_GAME = 'most_kills_ranked_game';
}