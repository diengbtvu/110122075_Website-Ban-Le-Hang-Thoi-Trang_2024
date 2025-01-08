<?php
function getall_product(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

// function search_product($query){
//     $conn=connectdb();
//     $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE product_name LIKE '%$query%' OR description LIKE '%$query%' OR product_prices LIKE '%$query% ");
//     $stmt->execute();
//     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $kq=$stmt->fetchAll();
//     return $kq;
// }

function search_product($query) {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE product_name LIKE :query OR description LIKE :query OR product_prices LIKE :query");
    $stmt->bindParam(':query', $queryParam, PDO::PARAM_STR);
    $queryParam = '%' . $query . '%';
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function update_quantity_product($id,$quantity){
    $conn=connectdb();
    $sql = "UPDATE tbl_product SET quantity='".$quantity."' WHERE id_product=".$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function getall_product_hot(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE special ='1'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}
// function getall_product_new(){
//     $conn=connectdb();
//     $stmt = $conn->prepare("SELECT * FROM tbl_product ORDER BY id_product DESC");
//     $stmt->execute();
//     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $kq=$stmt->fetchAll();
//     return $kq;
// }
function get_detail_product($id){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product Where id_product =".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

function getall_product_view($iddm,$view){
    $conn=connectdb();
    $sql = "SELECT * FROM tbl_product WHERE 1";
    if($iddm > 0){
        $sql.=" AND catalog_id =".$iddm;
    }
    if($view == 1)
    {
        $sql.=" order by view DESC";
    } else {
        $sql.=" order by id_product DESC";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

function filter_products($catalog_id, $price_range = '', $sort = '') {
    $conn = connectdb();
    $sql = "SELECT * FROM tbl_product WHERE view = 1";
    
    if($catalog_id > 0) {
        $sql .= " AND catalog_id = :catalog_id";
    }
    
    if(!empty($price_range)) {
        switch($price_range) {
            case '0-3000000':
                $sql .= " AND product_prices < 3000000";
                break;
            case '3000000-5000000':
                $sql .= " AND product_prices BETWEEN 3000000 AND 5000000";
                break;
            case '5000000-10000000':
                $sql .= " AND product_prices BETWEEN 5000000 AND 10000000";
                break;
            case '10000000':
                $sql .= " AND product_prices > 10000000";
                break;
        }
    }
    
    switch($sort) {
        case 'price_asc':
            $sql .= " ORDER BY product_prices ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY product_prices DESC";
            break;
        case 'name_asc':
            $sql .= " ORDER BY product_name ASC";
            break;
        case 'name_desc':
            $sql .= " ORDER BY product_name DESC";
            break;
        default:
            $sql .= " ORDER BY id_product DESC";
    }
    
    $stmt = $conn->prepare($sql);
    if($catalog_id > 0) {
        $stmt->bindParam(':catalog_id', $catalog_id, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>