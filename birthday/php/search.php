
<?php
require("config.php");
global $conn;

// cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_mid, c_ruid
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST["site"] = 'dashboard'){
        // Get the search query
        $search = $_POST["query"];
        $results1 = "";  $results2 = "";  $results3 = "";
        // Check if the search query is numeric
        if (is_numeric($search)) {
            $stmt1 = $conn->prepare("SELECT * FROM messages WHERE m_id = ? ORDER BY m_id");
            $stmt1->bind_param("i", $search);
            $stmt1->execute();
            $res1 = $stmt1->get_result();

            $stmt2 = $conn->prepare("SELECT * FROM contacts where c_id  LIKE ? or c_pnum like ? or c_ruid like ? ORDER BY cf_name ");
            $stmt2->bind_param("iii", $search, $search, $search);
            $stmt2->execute();
            $res2 = $stmt2->get_result();

            $stmt3 = $conn->prepare("SELECT * FROM registered_users where ru_id LIKE ? or ru_pnum like ? ORDER BY ru_id ASC");
            $stmt3->bind_param("ii", $search, $search);
            $stmt3->execute();
            $res3 = $stmt3->get_result();
       

        
            if ($res1 -> num_rows > 0) {
                $result_number1 = 1;
                $pics1 = ["img/im1.jpg","img/im2.jpg","img/im4.jpg","img/im5.jpg","img/im6.jpg","img/im7.jpg"];
                while(count($pics1) < $res1->num_rows){
                    foreach ($pics1 as $it1){
                        if (count($pics1) < $res1->num_rows ){
                            $pics1[] .= $it1; 
                        }
                        else{
                            $pics1[] .= $it1; 
                            break;
                        }

                    }
                }
                
                while($row1 = $res1->fetch_assoc()){ 
                    // Highlight the search term in the message body
                    // $message_body =  $row["m_body"];
                    $pic_index1 = random_int(0,count($pics1)-1);
                    // Construct the result item with the highlighted search term
                    $item1 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                    <div class="col p-4 d-flex flex-column style="width:50px">
                                        <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number1.'</strong>
                                        <h6 class="mb-0">Message Type: '.$row1["m_type"].'</h6>
                                        <div class="mb-1 text-muted">Message ID:'.$row1["m_id"].'</div>
                                        <p class="card-text mb-auto">'.substr($row1['m_body'],0,30).'</p>
                                        <p class="card-text mb-auto">'.substr($row1['m_body'],30,30).'</p>
                                        <p class="card-text mb-auto">'.substr($row1['m_body'],60,30).'</p>
                                        <p class="card-text mb-auto">'.substr($row1['m_body'],90,30).'</p>
                                        <p class="card-text mb-auto">'.substr($row1['m_body'],120,30).'</p>
                                    </div>
                                    <div class="col-auto d-none d-lg-block">
                                        <img src='.htmlspecialchars($pics1[$pic_index1]).' width="200" height="250">
                                    </div>
                                </div>
                            </div>
                            ';
                    if($result_number1 < count($pics1)){
                        $results1 .= $item1;
                    }
                    else{
                        break;
                    }
                    $result_number1++;
                } 
            }
            else {
                $results1 = "No results found in messages";
            }

            if ($res2->num_rows > 0) {
                $result_number2 = 1;
                while($row2 = $res2->fetch_assoc()){ 
                    // Highlight the search term in the message body
                    // $message_body =  $row["m_body"];
                    // $pic_index1 = random_int(0,count($pics1)-1);
                    // Construct the result item with the highlighted search term
                    $item2 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                    <div class="col p-4 d-flex flex-column style="width:50px">
                                        <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number2.'</strong>
                                        <h2 class="mb-0">Contact registrar ID: '.$row2["c_ruid"].'</h2>
                                        <div class="mb-1">contact ID:'.$row2["c_id"].'</div>
                                        <p class="card-text mb-auto">Contact First name: '.$row2['cf_name'].'</p>
                                        <p class="card-text mb-auto">Contact last name: '.$row2['cl_name'].'</p>
                                        <p class="card-text mb-auto">Contact Date of Birth: '.$row2['c_dob'].'</p>
                                        <p class="card-text mb-auto">Contact Phone Number: '.$row2['c_pnum'].'</p>
                                    </div>
                                </div>
                            </div>
                            ';
                
                    $results2 .= $item2;
                    $result_number2++;
                } 
            }
            else {
                $results2 = "No results found in contacts";
            }
            if ($res3->num_rows > 0) {
                $result_number3 = 1;
                while($row3 = $res3->fetch_assoc()){ 
                    // Highlight the search term in the message body
                    // $message_body =  $row["m_body"];
                    // $pic_index1 = random_int(0,count($pics1)-1);
                    // Construct the result item with the highlighted search term
                    $item3 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                    <div class="col p-4 d-flex flex-column style="width:50px">
                                        <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number3.'</strong>
                                        <h2 class="mb-0">Contact registrar ID: '.$row3["ru_id"].'</h2>
                                        <p class="card-text mb-auto">Contact First name: '.$row3['ruf_name'].'</p>
                                        <p class="card-text mb-auto">Contact last name: '.$row3['rul_name'].'</p>
                                        <p class="card-text mb-auto">Contact Date of Birth: '.$row3['ru_dob'].'</p>
                                        <p class="card-text mb-auto">Contact Phone Number: '.$row3['ru_pnum'].'</p>
                                    </div>
                                </div>
                            </div>
                            ';
                
                    $results3 .= $item3;
                    $result_number3++;
                } 
            }
            else {
                $results3 = "No results found in contacts";
            }
        } 
        else {
            $searchParam = "%" . $search . "%";
            $stmt1 = $conn->prepare("SELECT * FROM messages where m_type LIKE ? or m_body  LIKE ? ORDER BY m_id ASC");
            $stmt1->bind_param("ss", $searchParam, $searchParam);
            $stmt1->execute();
            $res1 = $stmt1->get_result();

            $stmt2 = $conn->prepare("SELECT * FROM contacts where cf_name LIKE ? or cl_name like ? ORDER BY c_ruid ASC");
            $stmt2->bind_param("ss", $searchParam, $searchParam);
            $stmt2->execute();
            $res2 = $stmt2->get_result();

            $stmt3 = $conn->prepare("SELECT * FROM registered_users where ruf_name LIKE ? or rul_name like ? or ru_name like ? ORDER BY ru_id ASC");
            $stmt3->bind_param("sss", $searchParam, $searchParam,$searchParam);
            $stmt3->execute();
            $res3 = $stmt3->get_result();
       

        
        if ($res1 -> num_rows > 0) {
           // Initialize results variable
            $result_number1 = 1;
            $pics1 = ["img/im1.jpg","img/im2.jpg","img/im4.jpg","img/im5.jpg","img/im6.jpg","img/im7.jpg"];
            while(count($pics1) < $res1->num_rows){
                foreach ($pics1 as $it1){
                    if (count($pics1) < $res1->num_rows ){
                        $pics1[] .= $it1; 
                    }
                    else{
                        $pics1[] .= $it1; 
                        break;
                    }

                }
            }
            
            while($row1 = $res1->fetch_assoc()){ 
                // Highlight the search term in the message body
                // $message_body =  $row["m_body"];
                $pic_index1 = random_int(0,count($pics1)-1);
                // Construct the result item with the highlighted search term
                $item1 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                            <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                <div class="col p-4 d-flex flex-column style="width:50px">
                                    <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number1.'</strong>
                                    <h6 class="mb-0">Message Type: '.$row1["m_type"].'</h6>
                                    <div class="mb-1 text-muted">Message ID:'.$row1["m_id"].'</div>
                                    <p class="card-text mb-auto">'.substr($row1['m_body'],0,30).'</p>
                                    <p class="card-text mb-auto">'.substr($row1['m_body'],30,30).'</p>
                                    <p class="card-text mb-auto">'.substr($row1['m_body'],60,30).'</p>
                                    <p class="card-text mb-auto">'.substr($row1['m_body'],90,30).'</p>
                                    <p class="card-text mb-auto">'.substr($row1['m_body'],120,30).'</p>
                                </div>
                                <div class="col-auto d-none d-lg-block">
                                    <img src='.htmlspecialchars($pics1[$pic_index1]).' width="200" height="250">
                                </div>
                            </div>
                        </div>
                        ';
                if($result_number1 < count($pics1)){
                    $results1 .= $item1;
                }
                else{
                    break;
                }
                $result_number1++;
            } 
        }
        else {
            $results1 = "No results found in messages";
        }

        if ($res2->num_rows > 0) {
            $result_number2 = 1;
            // $pics2 = ["img/im1.jpg","img/im2.jpg","img/im4.jpg","img/im5.jpg","img/im6.jpg","img/im7.jpg"];
            // while(count($pics1) < $res1->num_rows){
            //     foreach ($pics1 as $it1){
            //         if (count($pics1) < $res1->num_rows ){
            //             $pics1[] .= $it1; 
            //         }
            //         else{
            //             $pics1[] .= $it1; 
            //             break;
            //         }

            //     }
            // }
            
            while($row2 = $res2->fetch_assoc()){ 
                // Highlight the search term in the message body
                // $message_body =  $row["m_body"];
                // $pic_index1 = random_int(0,count($pics1)-1);
                // Construct the result item with the highlighted search term
                $item2 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                            <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                <div class="col p-4 d-flex flex-column style="width:50px">
                                    <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number2.'</strong>
                                    <h2 class="mb-0">Contact registrar ID: '.$row2["c_ruid"].'</h2>
                                    <div class="mb-1">contact ID:'.$row2["c_id"].'</div>
                                    <p class="card-text mb-auto">Contact First name: '.$row2['cf_name'].'</p>
                                    <p class="card-text mb-auto">Contact last name: '.$row2['cl_name'].'</p>
                                    <p class="card-text mb-auto">Contact Date of Birth: '.$row2['c_dob'].'</p>
                                    <p class="card-text mb-auto">Contact Phone Number: '.$row2['c_pnum'].'</p>
                                </div>
                            </div>
                        </div>
                        ';
               
                $results2 .= $item2;
                $result_number2++;
            } 
        }
        else {
            $results2 = "No results found in contacts";
        }
        if ($res3->num_rows > 0) {
            $result_number3 = 1;
            while($row3 = $res3->fetch_assoc()){ 
                // Highlight the search term in the message body
                // $message_body =  $row["m_body"];
                // $pic_index1 = random_int(0,count($pics1)-1);
                // Construct the result item with the highlighted search term
                $item3 = '<div class="col-hover hover-effect col-md-6 rounded mx-2"   style="display:inline-block;font-size:80%;">
                            <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="messages" style="border-radius:2rem; ">
                                <div class="col p-4 d-flex flex-column style="width:50px">
                                    <strong class="d-inline-block mb-2 text-primary">Result: '.$result_number3.'</strong>
                                    <h3 class="card-text mb-auto">User name: '.$row3['ru_name'].'</h3>
                                    <h4 class="mb-0">Usr ID: '.$row3["ru_id"].'</h4>
                                    <p class="card-text mb-auto">Contact First name: '.$row3['ruf_name'].'</p>
                                    <p class="card-text mb-auto">Contact last name: '.$row3['rul_name'].'</p>
                                    <p class="card-text mb-auto">Contact Date of Birth: '.$row3['ru_dob'].'</p>
                                    <p class="card-text mb-auto">Contact Phone Number: '.$row3['ru_pnum'].'</p>
                                </div>
                            </div>
                        </div>
                        ';
            
                $results3 .= $item3;
                $result_number3++;
            } 
        }
        else {
            $results3 = "No results found in contacts";
        }
    }
    // else {
    //     $results = "No results found";
    // }

} 
        echo '
            <div class="container">
                <h2>"'.$search.'"Results from Messages👇</h2>
                <div class="row">
                    <div class="col-12">
                        <div class=" scrollable-div px-5 py-4" style=" overflow-x:auto; white-space:nowrap;"> 
                        '. $results1 . '
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
            <h2>"'.$search.'" Results from Contacts👇</h2>
                <div class="row">
                    <div class="col-12">
                        <div class=" scrollable-div px-5 py-4" style=" overflow-x:auto; white-space:nowrap;"> 
                        '. $results2 . '
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
            <h2>"'.$search.'" Results from Registered users👇</h2>
                <div class="row">
                    <div class="col-12">
                        <div class=" scrollable-div px-5 py-4" style=" overflow-x:auto; white-space:nowrap;"> 
                        '. $results3 . '
                        </div>
                    </div>
                </div>
            </div>
           <hr> ';
            
    
}
    // elseif(){

    // }

else {
    echo "Method is not a post method";
}


