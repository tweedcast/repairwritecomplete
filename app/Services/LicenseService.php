<?php

namespace App\Services;
use App\Models\License;
use App\Events\LicenseAssigned;
use App\Events\LicenseReleased;
use Auth;

class LicenseService
{
    private $device_name;
    private $user;
    private $response;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($device_name, $user)
    {
      $this->device_name = $device_name;
      $this->user = $user;
      $this->response = ['assigned' => false, 'message' => '', 'license_uid' => ''];
    }


    public static function release($license_id)
    {
      $license = License::find($license_id);

      $curr_user = $license->user;
      $license->update([
        'user_id' => NULL,
        'device_name' => NULL,
        'assigned' => 0
      ]);

      LicenseReleased::dispatch($license->uid, $curr_user->uid);
    }


    public function assign()
    {
      if($this->checkPreReserved()){
        return $this->response;
      }
      $this->checkAvailable();
      return $this->response;
    }

    private function checkAvailable()
    {
      $available = $this->user->shop->available_licenses;
      if($available->count() == 0){
        $this->response['message'] = 'No licenses available. Release your current license in the dashboard or contact your shop administrator.';
        return $this->response;
      } else {
        $this->reserve($available->first());
      }
    }

    private function checkPreReserved()
    {
      $check = License::where('user_id', $this->user->id)->where('device_name', $this->device_name)->get()->first();
      if($check){
        $this->response['assigned'] = true;
        $this->response['message'] = 'License assigned to this device.';
        $this->response['license_uid'] = $check->uid;

        $check->update([
          'user_id' => $this->user->id,
          'device_name' => $this->device_name,
          'assigned' => 1
        ]);

        return true;
      }
      return false;
    }

    private function reserve($license)
    {
      $license->update([
        'user_id' => $this->user->id,
        'device_name' => $this->device_name,
        'assigned' => 1
      ]);

      $this->response['assigned'] = true;
      $this->response['message'] = 'New license assigned to this device.';
      $this->response['license_uid'] = $license->uid;
      LicenseAssigned::dispatch($this->user->shop->uid);
    }


}

?>
