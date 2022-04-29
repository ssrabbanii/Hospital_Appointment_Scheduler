<?php
function printRow($patientId, $name,$date){
    $datearr= explode(" ", $date);  
    $time = $datearr[1];
    $date = date('d-m-y', strtotime($datearr[0]));
    //echo $time;
    $time = date('H.i',strtotime($time));
    $time = $time . ' '. $datearr[2];
    echo '
    <tr class="table-success">
    <th scope="row">
        <p >
            '.$name.'
        </p>  <!-- Modal -->      
    </th>
    <td>
        <p>
            '.$date.' '.$time.'
        </p>
    </td>
    </tr>';
}
function printRowTreatment($id,$name, $patientId, $start,$end, $result, $description){
    $newEnd = $end;
    //echo $end;
    if($end === null || strlen($end) <= 0){
        $newEnd = 'N/A';
    }else{
        $newarr = explode(' ', $end);
        //echo $newarr;
        $timeEnd = $newarr[1];
        $dateEnd = date('d-m-y', strtotime($newarr[0]));
        $timeEnd = date('H.i',strtotime($timeEnd));
        $timeEnd = $timeEnd . ' '. $newarr[2];
        $newEnd = $dateEnd . ' '. $timeEnd;
    }
    //$' d.$time.'atearr= explode(" ", $start);

    $datearr= explode(" ", $start);  
    $time = $datearr[1];
    $date = date('d-m-y', strtotime($datearr[0]));
    $time = date('H.i',strtotime($time));
    $time = $time . ' '. $datearr[2];

    echo '
    <tr class="table-success">
    <th scope="row">
    <p>
        '.$id.'
    </p>
    </th>
    <th scope="row">
        <button class="btn rounded-pill" name="patient"  value="'.$patientId.'" onClick="onClick(this.value,this.name)" >
            '.$name.'
        </button>  <!-- Modal -->      
    </th>
    <th scope="row">
    <p>
        '.$date.' '.$time.'
    </p>  <!-- Modal -->      
    </th> 
    <th scope="row">
    <p>
        '.$newEnd.'
    </p>  <!-- Modal -->      
    </th>  
    <th scope="row">
    <p>
        '.$description.'
    </p>  <!-- Modal -->      
    </th> 
    <th scope="row">
    <div class="dropdown">
    <button type="button" name="result"  value="test '.$id.'" onClick="processResult(this.value)" class="btn btn-primary rounded-pill" >
        '.$result.'
    </button>
    <div id="dropdownResult test '.$id.'" class="dropdown-content">
    <a  class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=treatment&status=failed">Failed</a>
    <a  class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=treatment&status=successful">Successful</a>
    <a  class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=treatment&status=pending">Pending</a>
    </div>
    </div>   <!-- Modal -->      
    </th>
    </tr>';
}
function printRowTest($id,$name, $patientId, $date,$testName, $result, $description){
    $datearr= explode(" ", $date);  
    $time = $datearr[1];
    $date = date('d-m-y', strtotime($datearr[0]));
    //echo $time;
    $time = date('H.i',strtotime($time));
    $time = $time . ' '. $datearr[2];
    echo '
    <tr class="table-success">
    <th scope="row">
    <p>
        '.$id.'
    </p>
    </th>
    <th scope="row">
        <button class="btn rounded-pill" name="patient"  value="'.$patientId.'" onClick="onClick(this.value,this.name)" >
            '.$name.'
        </button>  <!-- Modal -->      
    </th>
    <th scope="row">
    <p>
        '.$date.' '.$time.'
    </p>  <!-- Modal -->      
    </th>
    <th scope="row">
    <p>
        '.$testName.'
    </p>  <!-- Modal -->      
    </th> 
    <th scope="row">
    <p>
        '.$description.'
    </p>  <!-- Modal -->      
    </th>
    <th scope="row">
    <div class="dropdown">
    <button type="button" name="result"  value="test '.$id.'" onClick="processResult(this.value)" class="btn btn-primary rounded-pill" >
        '.$result.'
    </button>
    <div id="dropdownResult test '.$id.'" class="dropdown-content">
    <a  class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=test&status=failed">Failed</a>
    <a  class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=test&status=successful">Successful</a>
    <a   class="dropdown-item" href="./handler/resultUpdateHandler.php?id='.$id.'&type=test&status=pending">Pending</a>
    </div>
    </div>  <!-- Modal -->      
    </th>
    </tr>';
}
function printRowBill($id,$name,$price,$type){
    
    echo '
    <tr class="table-success">
    <th scope="row">
        <p>
            '.$type.'
        </p>  <!-- Modal -->      
    </th>
    <td>
        <p>
            '.$name.'
        </p>
    </td>
    <td>
    <p>
        '.$price.'
    </p>
    </td>
    <td>
        <a class="btn btn-primary rounded-pill" href="./handler/paymentHandler?id='.$id.'&type='.$type.'">
        pay
        </a>
    </td>
    </tr>';
}
?>