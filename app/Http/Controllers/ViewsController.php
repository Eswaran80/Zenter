<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function tasksshow(){
        return view('Tasks_page');
    }
     public function teamshow(){
        return view('Team_page');
    }
     public function reportsshow(){
        return view('Reports_page');
    }
     public function notificationsshow(){
        return view('Notifications_page');
    }
     public function calendarshow(){
        return view('Calendar_page');
    }
     public function projectsshow(){
        return view('Projects_page');
    }
     public function messagesshow(){
        return view('Messages_page');
    }
     public function accountshow(){
        return view('Account_page');
    }
     public function supportshow(){
        return view('Support_page');
    }
     public function settingsshow(){
        return view('settings_page');
    }
}
