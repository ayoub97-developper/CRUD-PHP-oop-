<?php 
    require_once 'db.php';

    $db=new Database();

    if(isset($_POST['action']) &&  $_POST ['action']=="view"){
        $output='';
        $data=$db->read();

        if($db->totalRowCount()>0){
            $output.=' <table class="table table-sriped table-sm table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last name</th>
                    <th>e mail</th>
                    <th>phone</th>
                    <th>Action</th>
                </tr>
            </thead><tbody>';
            foreach($data as $row){

                $output.= '<tr class="text-center text-secondary">
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="'.$row['id'].'"><i class="fas fa-info-circle fa-lg">&nbsp;&nbsp;</i></a>
                    <a href="#" title="Edit" class="text-primary editBtn"
                     id="'.$row['id'].'" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit fa-lg">&nbsp;&nbsp;</i></a>
                    <a href="#" title="Delete" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt fa-lg">&nbsp;&nbsp;</i></a>
                    
                </td></tr>
                ';
            }
            $output.='</tbody></table>';
            echo $output;
        }else{
            echo '<h3 class="text-center text-secondary mt-5>No any user  </h3>';
        }


    }

    if(isset($_POST['action']) && $_POST['action']=="insert"){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];

        $db->insert($fname,$lname,$email,$phone);

    }

    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
       
        $row=$db->getUserById($id);
        echo json_encode($row);

    }


    if(isset($_POST['action']) && $_POST['action']=="update"){
        $id=$_POST['id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $db->update($id,$fname,$lname,$email,$phone);
    }

    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
       
        $db->delete($id);
        

    }
?>