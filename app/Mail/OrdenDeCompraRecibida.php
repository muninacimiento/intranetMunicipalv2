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

    public $oc_mail, $detalleSolicitud;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->oc_mail = DB::table('orden_compras')
                        ->join('users', 'orden_compras.user_id', '=', 'users.id')
                        ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                        ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                        ->select('orden_compras.*', 'users.name as Comprador', 'users.email as EmailComprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial', 'proveedores.correo as EmailProveedor')
                        ->where('orden_compras.id', '=', $id)
                        ->first();

        $this->detalleSolicitud = DB::table('detail_solicituds')
                                ->join('products', 'detail_solicituds.product_id', 'products.id')
                                ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                ->join('assign_request_to_o_c_s', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_o_c_s.solicitud_id')
                                ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                ->select('detail_solicituds.*', 'products.name as Producto')
                                ->where('assign_request_to_o_c_s.ordenCompra_id', '=', $this->oc_mail->id)
                                ->get();

                                //dd($oc_mail);    

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.ordenCompra');
    }
}
