<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Visitor;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

/**
 * Class AnnouncementSeeder.
 */
class VisitorSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('visitor');

        if (app()->environment(['local', 'testing'])) {
            $faker = Faker::create();
            
            $frequent_visitors = [];
            $fv_count = 5;
            $fv_chance = 0.3;
            $total_visitors = 100;
            
            for ($i=0; $i < $fv_count; $i++) {
              $unit = Unit::inRandomOrder()->whereNotNull('occupant_name')->first();
              $frequent_visitors[] = [
                'name'=>$faker->name,
                'contact'=>$faker->numberBetween(60000000,99999999),
                'nric'=>$faker->bothify('##?'),
                'unit_id'=>$unit->id
              ];
            }
            
            
            foreach (range(0, $total_visitors) as $i) {
              $year = rand(2020, 2020);
              $month = rand(1, 12);
              $day = rand(1, 28);
              $hour = rand(0, 23);
              $minute = rand(0, 59);
              $second = rand(0, 59);
              
              $date = Carbon::create($year,$month ,$day , $hour, $minute, $second);
              
              $fv = rand( 1, round( $fv_count/$fv_chance) );
              $visitor = isset($frequent_visitors[$fv])? $frequent_visitors[$fv] : null;
              if (!$visitor) {
                $unit = Unit::inRandomOrder()->whereNotNull('occupant_name')->first();
              }
              Visitor::create([
                  'pass_id' => null,
                  'name' => $visitor? $visitor['name'] : $faker->name,
                  'contact' => $visitor? $visitor['contact'] : $faker->numberBetween(60000000,99999999),
                  'unit_id' => $visitor? $visitor['unit_id'] : $unit->id,
                  'nric' => strtoupper( $visitor? $visitor['nric'] : $faker->bothify('##?') ),
                  'time_in' => $date->format('Y-m-d H:i:s'),
                  'time_out' => $date->addSeconds(rand(1800, 21600))->format('Y-m-d H:i:s')
              ]);
            }
            
        }

        $this->enableForeignKeys();
    }
}
