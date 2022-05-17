<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Inertia\Inertia;
use Auth;
use Redirect;

class DashboardController extends Controller
{
    public function route(Request $request)
    {

      if(Auth::user()->can('view-super-dashboard')){
        return Inertia::render('Dashboard', ['organizations' => Organization::simplePaginate(10)]);
      }

      if(Auth::user()->can('view-admin-dashboard')){
        return Redirect(route('organization-dashboard', ['organization' => Auth::user()->organization->slug]));
      }

      return Redirect(route('location-dashboard', ['organization' => Auth::user()->organization->slug, 'location' => Auth::user()->curr_location->slug]));
    }


    public function organization(Request $request, Organization $organization)
    {
      Inertia::share('currLocation', Auth::user()->curr_location);
      return Inertia::render('OrganizationDashboard',
      [
        'organization' => $organization,
        'locations' => $organization->locations,
        'admins' => $organization->admin_users(),
        'defaults' => $organization->default_users()
      ]);
    }
}
