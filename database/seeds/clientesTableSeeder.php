<?php

use Illuminate\Database\Seeder;

class clientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cliente::class, 120)->create()->each(function(App\cliente $Cli){
            $id= $Cli->ID_Cli;
            $Cli->sede()->saveMany(factory(App\sede::class, 5)->make([
                'Cliente' => $id,   
                'ID_Sede' => null,/*function($countsede) {
                    return $countsede;
                    $countsede++;
                    }*/
                ])
            );
        });
    }
}