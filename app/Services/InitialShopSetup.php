<?php

namespace App\Services;
use App\Models\User;
use App\Models\Shop;
use App\Models\License;
use App\Models\PartDiscountSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\OperationCodes;

class InitialShopSetup
{
    private $data;
    private $shop;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data = $data;
    }



    public function setup_shop()
    {
      $this->create_shop();
      $this->create_user();
      $this->create_licenses();
      $this->add_parts_discount();
      return $this->user;
    }

    private function create_shop()
    {
      $this->shop = Shop::create([
        'name' => $this->data->shop_name,
        'email' => $this->data->shop_email,
        'uid' => Str::random(16),
      ]);
    }

    private function create_user()
    {
      $this->user = User::create([
          'name' => $this->data->name,
          'email' => $this->data->email,
          'password' => Hash::make($this->data->password),
          'uid' => Str::random(16),
          'shop_id' => $this->shop->id
      ]);

      $this->shop->update([
        'user_id' => $this->user->id
      ]);
    }

    private function create_licenses()
    {
      for($i = 1; $i <= 5; $i++){
        License::create([
          'shop_id' => $this->shop->id,
          'uid' => Str::random(16)
        ]);
      }
    }

    private function add_parts_discount()
    {
      foreach(OperationCodes::$modifier as $type => $modify){
        foreach($modify as $modifier){
          if($modifier != 'OEM'){
            PartDiscountSetting::create([
              'shop_id' => $this->shop->id,
              'part_type' => $type,
              'modifier' => $modifier
            ]);
          }
        }
      }
    }

}

?>
