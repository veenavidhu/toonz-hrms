<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Setting up basic Location data...');

        // 1. Countries
        $countries = [
            ['name' => 'India', 'status' => true],
            ['name' => 'United States', 'status' => true],
            ['name' => 'United Kingdom', 'status' => true],
            ['name' => 'Australia', 'status' => true],
            ['name' => 'Canada', 'status' => true],
            ['name' => 'United Arab Emirates', 'status' => true],
        ];

        DB::table('countries')->insert($countries);
        $this->command->info('Added major countries.');

        // 2. States (For India as an example)
        $indiaId = DB::table('countries')->where('name', 'India')->first()->id;

        $indiaStates = [
            ['country_id' => $indiaId, 'name' => 'Kerala', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'Tamil Nadu', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'Karnataka', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'Maharashtra', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'Delhi', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'Gujarat', 'status' => true],
            ['country_id' => $indiaId, 'name' => 'West Bengal', 'status' => true],
        ];

        DB::table('states')->insert($indiaStates);
        $this->command->info('Added typical states for India (for testing/values).');

        // 3. Cities (For Kerala & Tamil Nadu as examples)
        $keralaId = DB::table('states')->where('name', 'Kerala')->first()->id;
        $tnId = DB::table('states')->where('name', 'Tamil Nadu')->first()->id;

        $keralaCities = [
            ['state_id' => $keralaId, 'name' => 'Thiruvananthapuram', 'status' => true],
            ['state_id' => $keralaId, 'name' => 'Kochi', 'status' => true],
            ['state_id' => $keralaId, 'name' => 'Kozhikode', 'status' => true],
            ['state_id' => $keralaId, 'name' => 'Thrissur', 'status' => true],
            ['state_id' => $keralaId, 'name' => 'Kollam', 'status' => true],
        ];

        $tnCities = [
            ['state_id' => $tnId, 'name' => 'Chennai', 'status' => true],
            ['state_id' => $tnId, 'name' => 'Coimbatore', 'status' => true],
            ['state_id' => $tnId, 'name' => 'Madurai', 'status' => true],
            ['state_id' => $tnId, 'name' => 'Tiruchirappalli', 'status' => true],
            ['state_id' => $tnId, 'name' => 'Salem', 'status' => true],
        ];

        DB::table('cities')->insert(array_merge($keralaCities, $tnCities));
        $this->command->info('Added some typical cities.');
        
        $this->command->info('Done! For a fully populated world database (150k+ records), using an NPM API package might be better for performance.');
    }
}
