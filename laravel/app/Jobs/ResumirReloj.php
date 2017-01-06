<?php

namespace App\Jobs;

use App\Models\ResumenReloj;
use App\Models\User;
use App\Models\Input_Reloj;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ResumirReloj extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $año;
    protected $mes;

    public function __construct($año, $mes)
    {
        $this->año = $año;
        $this->mes = $mes;
    }


    public function handle()
    {
        $input_reloj = New ResumenReloj();

        $input_reloj->ResumirReloj( $this->año,  $this->mes );
    }
}
