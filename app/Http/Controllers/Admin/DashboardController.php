<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function PHPUnit\TextUI\executeHelpCommandWhenThereIsNothingElseToDo;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->type == 'user')
        {
            $data ['header_title'] = __('general.dash');
            return view('user.index', $data);
        }
        else
            {
                $data ['header_title'] = __('general.dash');
                return view('admin.index', $data);
            }
    }
}
