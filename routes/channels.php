<?php

use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('result.{teacher_id}', function ($user,$teacher_id) {
    return $user->id==$teacher_id;
},['guards' => ['teacher']]);

Broadcast::channel('monitor.{teacher_id}', function ($user,$teacher_id) {
    return $user->id==$teacher_id;
},['guards' => ['teacher']]);

Broadcast::channel('warn.{student_id}', function ($user,$student_id) {
    return $user->id==$student_id;
},['guards' => ['student']]);
