<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\UserType;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\UserType::factory()->create();
        \App\Models\Organization::factory()->create();

        \App\Models\Location::factory()->create();

        \App\Models\Location::factory()->create([
          'name' => 'Metro Accident Repair Center',
          'slug' => 'MetroAccidentRepairCenter',
          'organization_id' => 1
        ]);

        \App\Models\Location::factory()->create([
          'name' => 'Mike Johnson\'s Collision Center',
          'slug' => 'MikeJohnsonsCollisionCenter',
          'organization_id' => 1
        ]);

         \App\Models\UserType::factory()->create([
            'name' => 'super-admin',
            'user_type_id' => Str::random(18)
         ]);

         \App\Models\UserType::factory()->create([
            'name' => 'admin',
            'user_type_id' => Str::random(18)
         ]);

         \App\Models\UserType::factory()->create([
            'name' => 'default',
            'user_type_id' => Str::random(18)
         ]);

      \App\Models\User::factory()->create([
          'name' => 'Harley Wegman',
          'email' => 'harley@tweedcast.com',
          'email_verified_at' => now(),
          'password' => Hash::make('Binster13!'), // password
          'remember_token' => Str::random(10),
          'uid' => Str::random(16),
          'user_type' => UserType::where('name', 'super-admin')->first()->user_type_id
      ]);

      \App\Models\User::factory()->create([
          'name' => 'Jay Pope',
          'email' => 'wegman13@live.com',
          'email_verified_at' => now(),
          'password' => Hash::make('Binster13!'), // password
          'remember_token' => Str::random(10),
          'uid' => Str::random(16),
          'user_type' => UserType::where('name', 'admin')->first()->user_type_id,
          'organization_id' => 1
      ]);



      \App\Models\User::factory()->create([
          'name' => 'Jim Bob',
          'email' => 'wegman133@gmail.com',
          'email_verified_at' => now(),
          'password' => Hash::make('Binster13!'), // password
          'remember_token' => Str::random(10),
          'uid' => Str::random(16),
          'user_type' => UserType::where('name', 'default')->first()->user_type_id,
          'organization_id' => 1,
          'curr_location_id' => 1
      ]);

      \App\Models\Repair::factory()->create();

      User::find(2)->locations()->attach(1);
      User::find(3)->locations()->attach(1);

    }
}
