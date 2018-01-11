<?php
require_once "../../vendor/autoload.php";
use App\Admin\Room;
use App\Admin\Course;


header('Content-type: text/javascript');


if (isset($_POST['department'])){
    $department = $_POST['department'];
    $allCourse = Course::getAllCourseByDepartmentName($department);
    $allocationRoom = null;
    $shedule = '';
    foreach ($allCourse as $course){
        if (Room::getRoomAllocationByCourseCode($course->course_code)){
            $shedules = Room::getRoomAllocationByCourseCode($course->course_code);
            foreach ($shedules as $singleShedule){
                $timeFromTosend = $singleShedule->alocation_time_from;
                $timeFrom = explode(':', $timeFromTosend);
                $timeFromMinuts = end($timeFrom);
                $timeFromHour = $timeFrom[0];
                //$timeFrom = array_slice($timeFrom, 0, 0);
                //$timeFromTosend = $singleShedule->alocation_time_from;
                $timeFromCmprHour = $timeFromHour - 12;
                if ($timeFromCmprHour >= 0){
                    if ($timeFromCmprHour == 0){
                        $timeFromTosend = $timeFromTosend . ' PM';
                    }else{
                        $timeFromTosend = $timeFromCmprHour . ':' . $timeFromMinuts . ' PM';
                    }
                }else{
                    $timeFromHourToSend = 12 - $timeFromHour;
                    if ($timeFromHourToSend >= 12){
                        $timeFromTosend = $timeFromHourToSend . ':' . $timeFromMinuts . ' AM';
                    }else{
                        $timeFromTosend = $timeFromTosend . ' AM';
                    }
                }

                // Time to .....
                $timeToTosend = $singleShedule->alocation_time_to;
                $timeTo = explode(':', $timeToTosend);
                //$timeTo = array_slice($timeTo, 0, 1);
                $timeToMinuts = end($timeTo);
                $timeToHour = $timeTo[0];
                $timeToCmprHour = $timeToHour - 12;
                if ($timeToCmprHour >= 0){
                    if ($timeToCmprHour == 0){
                        $timeToTosend = $timeToTosend . ' PM';
                    }else{
                        $timeToTosend = $timeToCmprHour . ':' . $timeToMinuts . ' PM';
                    }
                }else{
                    $timeToHourToSend = 12 - $timeToHour;
                    if ($timeToHourToSend >= 12){
                        $timeToTosend = $timeToHourToSend . ':' . $timeToMinuts . ' AM';
                    }else{
                        $timeToTosend = $timeToTosend . ' AM';
                    }
                }

                $shedule = $shedule . '<p> R. No : '.$singleShedule->alocation_room.', '.$singleShedule->alocation_day.', '.$timeFromTosend.' - '. $timeToTosend.';</p>';
            }
            $allocationRoom[$course->course_code] = $shedule;
            $shedule = '';
        }else{
            $allocationRoom[$course->course_code] = null;
        }

    }

    $json = array(
        'allcourse' => $allCourse,
        'allocationRoom' => $allocationRoom
    );

    echo json_encode($json);
}

//if (Room::getRoomAllocationByCourseCode($course->course_code)){
//    $allocationRoom[] = Room::getRoomAllocationByCourseCode($course->course_code);
//}