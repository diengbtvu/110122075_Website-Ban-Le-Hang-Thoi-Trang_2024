<?php

function getall_supplier(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_supplier");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

function getoneSupplier($id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_supplier WHERE sup_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting supplier: " . $e->getMessage());
        return [];
    }
}

function update_supplier($id, $name, $address, $bank, $tax) {
    try {
        $conn = connectdb();
        $sql = "UPDATE tbl_supplier 
                SET sup_name = :name,
                    sup_address = :address,
                    sup_bank = :bank,
                    sup_tax_code = :tax 
                WHERE sup_id = :id";
                
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':address' => $address,
            ':bank' => $bank,
            ':tax' => $tax
        ]);
        
        return $result;
    } catch (PDOException $e) {
        error_log("Error updating supplier: " . $e->getMessage());
        return false;
    }
}

function delete_supplier($id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("DELETE FROM tbl_supplier WHERE sup_id = :id");
        return $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        error_log("Error deleting supplier: " . $e->getMessage());
        return false;
    }
}

function insert_supplier($name, $address, $bank, $tax) {
    try {
        $conn = connectdb();
        $sql = "INSERT INTO tbl_supplier (sup_name, sup_address, sup_bank, sup_tax_code) 
                VALUES (:name, :address, :bank, :tax)";
                
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':name' => $name,
            ':address' => $address,
            ':bank' => $bank,
            ':tax' => $tax
        ]);
        
        return $result;
    } catch (PDOException $e) {
        error_log("Error inserting supplier: " . $e->getMessage());
        return false;
    }
}
?>