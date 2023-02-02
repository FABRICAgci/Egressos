<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    if(Auth::check())
    {
      if(Auth::user()->perfil == 1)
      {
        return redirect()->route('index-egresso-admin');
      }

      if(Auth::user()->perfil == 2)
      {
        return redirect()->route('index-egresso');
      }
    }

    return redirect()->route('login');
  }
}
