<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(DependenciesTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);

        $this->call(StatusSolicitudTableSeeder::class);

        $this->call(ProductsTableSeeder::class);

        $this->call(StatusOCTableSeeder::class);

        $this->call(StatusFacturaTableSeeder::class);

        $this->call(StatusLicitacionTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(TagsTableSeeder::class);

        $this->call(PostsTableSeeder::class);


    }
}
