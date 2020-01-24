<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\DetailSolicitud;
use App\OrdenCompra;
use DB;


class OrdenDeCompraRecibida extends Mailable
{
    use Queueable, SerializesModels;

    public $oc_mail, $sol, $dS;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $detalleSolicitud, $ocMail, $solicitud)
    {
        $this->oc_mail = $ocMail;

        $this->dS = $detalleSolicitud;

        $this->sol = $solicitud;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Orden de Compra - I.Municipalidad de Nacimiento')->view('email.ordenCompra');
    }
}
