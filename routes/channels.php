<?php

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

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
//linha abaixo foi nescessaria devido ao fato de usarmos uma calsse user fora da pasta padrao do laravel. Nao estava conseguindo receber os notificacoes no front end com laravel echo até adicionar esta linha.
Broadcast::channel('App.Influencer.User.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
