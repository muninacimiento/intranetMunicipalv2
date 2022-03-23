<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Vehiculo;
use App\MantencionVehiculos;
use DB;


class MantencionVehiculo extends Mailable
{
    use Queueable, SerializesModels;

    public $vehiculo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $mantencionVehiculo)
    {
        $this->vehiculo = $mantencionVehiculo;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('SisPAM - I.Municipalidad de Nacimiento')->view('email.mantencionVehiculo');
    }
}
