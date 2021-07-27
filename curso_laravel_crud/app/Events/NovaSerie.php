<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nome;
    public $qtdTemporadas;
    public $qtdEpisodios;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nome,$qtd_temporadas,$qtd_episodios)
    {
        $this->nome = $nome;
        $this->qtd_temporadas = $qtd_temporadas;
        $this->qtd_episodios = $qtd_episodios;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
