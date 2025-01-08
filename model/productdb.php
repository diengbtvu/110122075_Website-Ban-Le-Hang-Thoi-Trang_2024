<?php
/**
 * Hệ thống quản lý sản phẩm cho cửa hàng 
 * Được phát triển bởi [Tên của bạn] - [Năm hiện tại]
 * 
 * File này chứa các hàm xử lý CRUD cho bảng sản phẩm
 * Các tính năng chính:
 * - Quản lý thông tin sản phẩm
 * - Xử lý số lượng tồn kho
 * - Liên kết với danh mục và nhà cung cấp
 */

// Tạo một số hằng số độc đáo cho dự án
define('PRODUCT_STATUS_ACTIVE', 1);
define('PRODUCT_STATUS_INACTIVE', 0);
define('PRODUCT_MIN_QUANTITY', 5);
define('PRODUCT_MAX_QUANTITY', 1000);

if (!defined('HOST')) {
    exit('Không được phép truy cập trực tiếp');
}

function getall_product() {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT p.*, c.catalog_name, u.name_us, s.sup_name 
                               FROM tbl_product p
                               LEFT JOIN tbl_catalog c ON p.catalog_id = c.id_catalog_k
                               LEFT JOIN tbl_user u ON p.employee_entry = u.id
                               LEFT JOIN tbl_supplier s ON p.sup_id = s.sup_id
                               ORDER BY p.entry_date DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting products: " . $e->getMessage());
        return [];
    }
}

function insert_product($id_pd, $quantity_pd, $name_pd, $prices_pd, $img_pd, $id_ee, $sup_pd, $oldprices_pd, $view_pd, $special_pd, $description_pd, $size_pd) {
    try {
        $conn = connectdb();
        $sql = "INSERT INTO tbl_product (
            product_name, quantity, product_img, product_prices, 
            catalog_id, employee_entry, sup_id, old_prices,
            view, special, description, size, entry_date
        ) VALUES (
            :name, :quantity, :img, :prices,
            :catalog_id, :employee_id, :sup_id, :old_prices,
            :view, :special, :description, :size, NOW()
        )";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name_pd);
        $stmt->bindParam(':quantity', $quantity_pd);
        $stmt->bindParam(':img', $img_pd);
        $stmt->bindParam(':prices', $prices_pd);
        $stmt->bindParam(':catalog_id', $id_pd);
        $stmt->bindParam(':employee_id', $id_ee);
        $stmt->bindParam(':sup_id', $sup_pd);
        $stmt->bindParam(':old_prices', $oldprices_pd);
        $stmt->bindParam(':view', $view_pd);
        $stmt->bindParam(':special', $special_pd);
        $stmt->bindParam(':description', $description_pd);
        $stmt->bindParam(':size', $size_pd);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error inserting product: " . $e->getMessage());
        return false;
    }
}

function delete_product($id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("DELETE FROM tbl_product WHERE id_product = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error deleting product: " . $e->getMessage());
        return false;
    }
}

function getoneProduct($id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE id_product = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting product: " . $e->getMessage());
        return [];
    }
}

function update_product($id, $quantity_pd, $id_pd, $name_pd, $prices_pd, $img_pd, $id_ee, $id_sup, $oldprices_pd, $view_pd, $special_pd, $description_pd, $size_pd) {
    try {
        $conn = connectdb();
        $sql = "UPDATE tbl_product SET 
            product_name = :name,
            quantity = :quantity,
            product_img = :img,
            product_prices = :prices,
            catalog_id = :catalog_id,
            employee_entry = :employee_id,
            sup_id = :sup_id,
            old_prices = :old_prices,
            view = :view,
            special = :special,
            description = :description,
            size = :size
            WHERE id_product = :id";
            
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name_pd);
        $stmt->bindParam(':quantity', $quantity_pd);
        $stmt->bindParam(':img', $img_pd);
        $stmt->bindParam(':prices', $prices_pd);
        $stmt->bindParam(':catalog_id', $id_pd);
        $stmt->bindParam(':employee_id', $id_ee);
        $stmt->bindParam(':sup_id', $id_sup);
        $stmt->bindParam(':old_prices', $oldprices_pd);
        $stmt->bindParam(':view', $view_pd);
        $stmt->bindParam(':special', $special_pd);
        $stmt->bindParam(':description', $description_pd);
        $stmt->bindParam(':size', $size_pd);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error updating product: " . $e->getMessage());
        return false;
    }
}

function get_product_by_name_and_size($name, $size) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE product_name = ? AND size = ?");
        $stmt->execute([$name, $size]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting product by name and size: " . $e->getMessage());
        return null;
    }
}

function update_product_quantity($id, $new_quantity) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("UPDATE tbl_product SET quantity = ? WHERE id_product = ?");
        return $stmt->execute([$new_quantity, $id]);
    } catch (PDOException $e) {
        error_log("Error updating product quantity: " . $e->getMessage());
        return false;
    }
}

// Thêm một số hàm tiện ích
function get_product_by_category($category_id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE catalog_id = ?");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting products by category: " . $e->getMessage());
        return [];
    }
}

function get_low_stock_products($threshold = 10) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE quantity <= ?");
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting low stock products: " . $e->getMessage());
        return [];
    }
}

// Hàm liên quan đến giỏ hàng
function getall_cart_id() {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT DISTINCT id_pro FROM tbl_cart");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting cart IDs: " . $e->getMessage());
        return [];
    }
}

function check_product_in_cart($product_id) {
    try {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_cart WHERE id_pro = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error checking product in cart: " . $e->getMessage());
        return false;
    }
}