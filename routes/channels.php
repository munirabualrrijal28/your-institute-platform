<?php
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('example-channel', function ($user) {
//     return true;
// });


Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
