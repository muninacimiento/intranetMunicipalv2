<?php

/*
 *	JFuentealba @itux
 *	created at October 11, 2019 - 9:11 am
 *	updated at
 */

use Illuminate\Database\Seeder;
//Invocamos el Modelo de la Entidad
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Product::create([

            'name'     =>  'Resma de Hojas Oficio',

        ]);

        Product::create([

            'name'     =>  'Resma de Hojas Carta',

        ]);

        Product::create([

            'name'     =>  'Archivadores Tamaño Oficio',

        ]);

        Product::create([

            'name'     =>  'Resma de Hojas Carta',

        ]);

    }
}
