<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NovaSerie as MailNovaSerie;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $users = User::all();
        $cont = 1;
        foreach($users as $user)
        {

            $email = new MailNovaSerie($event->nome,$event->qtd_temporadas,$event->qtd_episodios);
            $email->subject="Nova série cadastrada no sistema!";
            Mail::to($user)->later(now()->addSeconds($cont*5),$email);
            $cont++;
        }
    }
}
