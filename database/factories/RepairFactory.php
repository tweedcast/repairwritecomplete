<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'unqfile_id' => '5df19d26',
            'ro_id' => '575288',
            'est_system' => 'CCC',
            'supp_no' => 'E01',
            'create_dt' => '20220401',
            'create_tm' => '141315',
            'ins_co_nm' => 'All State',
            'clm_no' => '000663139558B02',
            'ownr_ln' => 'Marshall',
            'ownr_fn' => 'Anise',
            'rf_co_nm' => 'Willoughby Accident Repair Center',
            'v_vin' => '1C4RJFAG5CC270542',
            'v_prod_dt' => null,
            'v_model_yr' => '12',
            'v_makecode' => 'JEEP',
            'v_makedesc' => 'Jeep',
            'v_model' => 'Grand Cherokee Laredo 4WD',
            'v_mileage' => null,
            'v_color' => 'black',
            'location_id' => 1,
            'user_id' => 3
        ];
    }
}
