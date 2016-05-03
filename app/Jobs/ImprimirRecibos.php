<?php

namespace App\Jobs;

use App\Models\User;
use App\Payrool\Entities\Recibo;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ImprimirRecibos extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $legajos;
    protected $año;
    protected $mes;
    protected $user;


    public function __construct( $año, $mes)
    {

        $this->año = $año;
        $this->mes = $mes;

    }


    public function handle()
    {
        $recibos = New Recibo();

        $recibos->ImprimirRecibos( $this->año, $this->mes);
    }
}
