<?php
    function getall_invoice(){
        $conn=connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_order ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq=$stmt->fetchAll();
        return $kq;
    }

    function getoneInvoice($id)
    {
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_order WHERE id=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
    }

    function update_invoice($id,$id_ee,$status,$phone,$email,$fname,$lname,$address){
        $conn=connectdb();
        $sql = "UPDATE tbl_order SET status='$status', employee_pr='$id_ee', phone='$phone', email='$email', lname='$lname', fname='$fname', address='$address' WHERE id=".$id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    function update_invoice_status($id, $status) {
        try {
            $conn = connectdb();
            $sql = "UPDATE tbl_order SET status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            error_log("Error updating invoice status: " . $e->getMessage());
            return false;
        }
    }
?>