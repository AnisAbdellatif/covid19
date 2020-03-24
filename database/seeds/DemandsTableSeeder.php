<?php

use App\Demand;
use Illuminate\Database\Seeder;

class DemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 5; $x++) {
            $demand = new Demand();
            $demand->title = 'Need Help';
            $demand->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dui est, varius id commodo ut, porta at ligula. Praesent tempor egestas ultricies. Phasellus varius urna ac ex pretium vestibulum sit amet ut erat. Nam ipsum est, gravida ac facilisis vel, venenatis id nisi. Donec a vehicula neque. Nulla bibendum sodales dui, ac varius nunc pulvinar at. Ut ut mi id felis accumsan malesuada non eget orci. Sed eget ante arcu. Nunc scelerisque luctus laoreet. Vivamus consectetur, turpis eu eleifend imperdiet, massa felis fermentum nibh, vitae accumsan enim justo a diam. Sed felis nisl, ullamcorper at augue id, vulputate aliquam tellus. Duis fermentum mauris purus, eu sollicitudin mi iaculis vel.';
            $demand->user_id = 1;
            $demand->save();
        }
    }
}
