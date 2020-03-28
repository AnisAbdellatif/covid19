<?php

use App\Request;
use Illuminate\Database\Seeder;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 15; $x++) {
            $request = new Request();
            $request->user_id = '2';
            $request->wanted = 'volunteer';
            $request->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec facilisis tortor, vitae condimentum tortor. Nulla id egestas nulla, eget vulputate tortor. Curabitur faucibus volutpat nisl. Quisque imperdiet dignissim erat, ac volutpat nisl ornare at. Integer finibus euismod risus, non placerat purus. Etiam turpis arcu, porta egestas augue vel, congue porttitor dui.';
            $request->save();
        }
    }
}
