<?php

namespace Database\Seeders;

use App\Models\Unit;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

/**
 * Class AnnouncementSeeder.
 */
class UnitSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('unit');

        if (app()->environment(['local', 'testing'])) {
            $faker = Faker::create();
            $max_block = 5;
            $max_floor = 5;
            $max_unit_floor = 5;
            for ($block=1; $block <= $max_block ; $block++) {
              for ($floor=1; $floor <= $max_floor ; $floor++) {
                for ($unit=1; $unit <= $max_unit_floor; $unit++) {
                  $occupied = $faker->numberBetween(1,100) > 30? 1: 0;
                  Unit::create([
                      'unit_block' => sprintf("%02d", $block),
                      'unit_number' => sprintf("%02d", $floor).'-'.sprintf("%02d", $unit),
                      'is_residential' => 1,
                      'occupant_name' => $occupied? $faker->name: null,
                      'occupant_contact' => $occupied? $faker->numberBetween(60000000,99999999): null,
                  ]);
                }
              }
            }
        }

        $this->enableForeignKeys();
    }
}
