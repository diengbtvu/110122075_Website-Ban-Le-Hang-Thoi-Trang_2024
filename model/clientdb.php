<?php

function getall_client(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_client");
    $stmt->execute();
    $kq=$stmt->fetchAll();
    return $kq;
}

function check_client_orders($clientId) {
    try {
        $conn = connectdb();
        $sql = "SELECT COUNT(*) FROM tbl_invoice WHERE client_id = :clientId";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':clientId' => $clientId]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

function delete_client($clientId) {
    try {
        $conn = connectdb();
        
        // Debug: In ra ID khách hàng cần xóa
        error_log("Attempting to delete client with ID: " . $clientId);
        
        // Kiểm tra xem khách hàng có tồn tại không
        $checkSql = "SELECT COUNT(*) FROM tbl_client WHERE id = :id";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([':id' => $clientId]);
        $exists = $checkStmt->fetchColumn();
        
        if (!$exists) {
            error_log("Client with ID {$clientId} does not exist");
            return false;
        }
        
        // Thực hiện xóa
        $sql = "DELETE FROM tbl_client WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([':id' => $clientId]);
        
        // Debug: In ra kết quả thực thi
        error_log("Delete result: " . ($result ? "success" : "failed"));
        error_log("Rows affected: " . $stmt->rowCount());
        
        if (!$result || $stmt->rowCount() === 0) {
            error_log("Delete failed for client ID: " . $clientId);
            return false;
        }
        
        return true;
    } catch (PDOException $e) {
        error_log("Database Error in delete_client: " . $e->getMessage());
        return false;
    }
}

function insert_client($last_name, $first_name, $sex, $email, $phone, $user, $password, $address) {
    try {
        $conn = connectdb();
        $sql = "INSERT INTO tbl_client (lname, fname, sex, email, phone, user, password, address, ban) 
                VALUES (:lname, :fname, :sex, :email, :phone, :user, :password, :address, '0')";
                
        $stmt = $conn->prepare($sql);
        $params = [
            ':lname' => $last_name,
            ':fname' => $first_name,
            ':sex' => $sex,
            ':email' => $email,
            ':phone' => $phone,
            ':user' => $user,
            ':password' => $password,
            ':address' => $address
        ];
        
        $result = $stmt->execute($params);
        
        if (!$result) {
            error_log("Insert failed for client: " . $user);
            return false;
        }
        return true;
    } catch (PDOException $e) {
        error_log("Database Error in insert_client: " . $e->getMessage());
        return false;
    }
}

function getoneClient($id){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_client WHERE id=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

function update_client($id, $lname, $fname, $sex, $email, $phone, $user, $password, $address, $ban) {
    try {
        $conn = connectdb();
        $sql = "UPDATE tbl_client SET 
                lname = :lname,
                fname = :fname,
                sex = :sex,
                email = :email,
                phone = :phone,
                user = :user,
                password = :password,
                address = :address,
                ban = :ban 
                WHERE id = :id";
                
        $stmt = $conn->prepare($sql);
        $params = [
            ':id' => $id,
            ':lname' => $lname,
            ':fname' => $fname,
            ':sex' => $sex,
            ':email' => $email,
            ':phone' => $phone,
            ':user' => $user,
            ':password' => $password,
            ':address' => $address,
            ':ban' => $ban
        ];
        
        $result = $stmt->execute($params);
        if (!$result) {
            error_log("Update failed for client ID: " . $id);
            return false;
        }
        return true;
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

?>