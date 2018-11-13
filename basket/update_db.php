<?php
    ob_start();
    require_once('connect_db.php');
    //$needupdate=$_SESSION['needupdate'];
    //echo "update called! ".$_POST['action'].">";
    if(isset($_POST['action'])){
        $action=$_POST['action'];
        if($action=='needupdate'){
            $rowid = $_POST('rowid');
            if(array_search($rowid, $needupdate)==false){
                array_push($needupdate, $rowid);
            }
            //echo "need update!";
        }elseif($action=='insert'){
            $name=$_POST['name'];
            $qty=$_POST['qty'];
            $rate=$_POST['rate'];
            $detail=$_POST['detail'];
            $sql= "insert into product (name, qty, rate, detail, basket_id) values('$name', $qty, $rate ,'$detail',1)";
            mysqli_query($link, $sql);
            //echo "inserted!";
            
        }elseif($action=='update'){
            //echo "update begin..";
            $rowid = $_POST['rowid'];
            //if($i=array_search($rowid, $needupdate)){
                //unset($needupdate[i]);
                $name=$_POST['name'];
                $qty=$_POST['qty'];
                $rate=$_POST['rate'];
                $detail=$_POST['detail'];
                $sql= "update product set name='$name', qty=$qty, rate=$rate ,detail='$detail', basket_id=1 where id=$rowid";
                mysqli_query($link, $sql);
                //echo "".$rowid."updated!";
            //}
		}elseif($action=='delete'){
            $rowid = $_POST['rowid'];
            $sql= "delete from product where id=$rowid";
            mysqli_query($link, $sql);
            //echo "inserted!";
           
        }
		//print_r($needupdate);
    }
    //$_SESSION['needupdate']=$needupdate;
?>