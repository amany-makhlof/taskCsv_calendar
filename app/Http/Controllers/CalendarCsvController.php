<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class CalendarCsvController extends Controller
{
    public function index()
    {
            $Events =$this->getEvents();
             return view('calenderCsv')->with('Events', $Events); 
     }

     private  function getEvents()
    { 
        $date = '2021-01-01';
        $end = '2021-12-31' ; 
        $currentMonth = 1;
        $currentMonday = 0;
        $currentThursday = 0;
        $currentFridayDate = 0;
        $Events=array();
        $Event=array();
        while(strtotime($date) <= strtotime($end)) { 
                if(date('d', strtotime($date))==1){
                   if(date('m', strtotime($date))!=01){
                    $Event['Friday']  = $currentFridayDate; 
                    array_push ($Events,$Event); 
                    $Event=array();
                    $currentMonth++; 
                   }   
                    $currentMonday = 0;
                    $currentThursday = 0;
                    $Event['Month'] =  date('m/y', strtotime($date));   
                }
                if(date('l', strtotime($date))=="Monday"  ){
                    $currentMonday++;
                    if($currentMonday==1){
                            $Event['Monday'] =  date('d/m/y', strtotime($date));
                            
                    }                    
                }
                if(date('l', strtotime($date))=="Thursday" ){
                    $currentThursday ++;
                    if($currentThursday==3){
                            $Event['Thursday'] =  date('d/m/y', strtotime($date));
                    }
                }
                if(date('l', strtotime($date))=="Friday" ){
                    $currentFridayDate =date('d/m/y', strtotime($date));
                 }
                $date = date("Y-m-d", strtotime("+1 day", strtotime($date))); 
            }
         
            $Event['Friday']  = $currentFridayDate; 
            array_push ($Events,$Event); 
            return $Events;

    }  
    public function exportCsv()
    {      
        $Events =$this->getEvents();
 
        $fileName = 'tasks.csv';
          
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ); 

        $columns = array('Month', 'Brunch & Catchup', 'Thirsty Thursday', 'Friday Fry-up' );

        $callback = function() use($Events,$columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($Events as $Event) { 

                fputcsv($file,  $Event);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers) ;
    }
}
