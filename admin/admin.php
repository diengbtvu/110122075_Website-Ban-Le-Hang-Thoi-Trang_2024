<?php
session_start();
ob_start();

// Thêm log lỗi
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
    define('HOST', true);
    include("../model/connectdb.php");
    include("../model/productdb.php");
    include("../model/catalogdb.php");
    include("../model/userdb.php");
    include("../model/clientdb.php");
    include("../model/supplierdb.php");
    include("../model/invoicedb.php");
    include("../model/statisticdb.php");
    include("helpers.php");
    include("head.php");
    include("header.php");
    include("sidebar.php");

    $act = $_GET['act'] ?? '';

    switch ($act) {
        case 'logout':
            unset($_SESSION['role'], $_SESSION['name']);
            header('location: login.php');
            break;

        case 'product':
            try {
                $dmsp = getall_catalog();
                $dmee = getall_user();
                $dmsup = getall_supplier();
                $kq = getall_product();
                include("product.php");
            } catch (Exception $e) {
                error_log("Error in product page: " . $e->getMessage());
                echo "Có lỗi xảy ra khi tải trang sản phẩm";
            }
            break;

        case 'client':
            $kq = getall_client();
            include("client.php");
            break;

        case 'insert_client':
            // Hiển thị form
            if (!isset($_POST['submit'])) {
                include("insert_client.php");
                break;
            }
            
            // Xử lý khi form được submit
            if (isset($_POST['submit'])) {
                $requiredFields = ['last_name_c', 'first_name_c', 'sex_c', 'email_c', 'phone_c', 'user_c', 'password_c', 'address_c'];
                
                if (!validateRequiredFields($requiredFields)) {
                    showAlert('Không thể thêm người dùng vì bạn nhập thiếu thông tin!', 'admin.php?act=insert_client');
                    include("insert_client.php");
                    break;
                }

                // Kiểm tra username đã tồn tại chưa
                if (checkDuplicateValue('tbl_client', 'user', $_POST['user_c'])) {
                    showAlert('Tên đăng nhập đã tồn tại!', 'admin.php?act=insert_client');
                    include("insert_client.php");
                    break;
                }

                $success = insert_client(
                    $_POST['last_name_c'],
                    $_POST['first_name_c'],
                    $_POST['sex_c'],
                    $_POST['email_c'],
                    $_POST['phone_c'],
                    $_POST['user_c'],
                    $_POST['password_c'],
                    $_POST['address_c']
                );

                if ($success) {
                    showAlert('Thêm người dùng thành công!', 'admin.php?act=client');
                    $kq = getall_client();
                    include("client.php");
                } else {
                    showAlert('Có lỗi xảy ra khi thêm người dùng!', 'admin.php?act=insert_client');
                    include("insert_client.php");
                }
            }
            break;

        case 'delete_client':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $clientId = $_GET['id'];
                
                // Debug: In ra thông tin xóa
                error_log("Processing delete request for client ID: " . $clientId);
                
                // Kiểm tra xem khách hàng có đơn hàng không
                $hasOrders = check_client_orders($clientId);
                
                if ($hasOrders) {
                    error_log("Cannot delete client {$clientId} - has orders");
                    showAlert('Không thể xóa khách hàng này vì họ đã có đơn hàng!', 'admin.php?act=client');
                } else {
                    // Thực hiện xóa khách hàng
                    $deleteResult = delete_client($clientId);
                    
                    if ($deleteResult) {
                        error_log("Successfully deleted client {$clientId}");
                        showAlert('Đã xóa khách hàng thành công!', 'admin.php?act=client');
                    } else {
                        error_log("Failed to delete client {$clientId}");
                        showAlert('Có lỗi xảy ra khi xóa khách hàng!', 'admin.php?act=client');
                    }
                }
                
                // Refresh danh sách khách hàng
                $kq = getall_client();
                include("client.php");
            }
            break;

        case 'statistic':
            include("statistic.php");
            break;

        case 'updateform_client':
            if (isset($_GET['id']) && !isset($_POST['submit'])) {
                $result = getoneClient($_GET['id']);
                include("update_client_form.php");
            } elseif (isset($_POST['submit'])) {
                // Debug: In ra các giá trị POST để kiểm tra
                error_log("POST data: " . print_r($_POST, true));
                
                $requiredFields = ['last_name_c', 'first_name_c', 'sex_c', 'email_c', 'phone_c', 'user_c', 'password_c', 'address_c', 'ban_c', 'id'];
                $missingFields = [];
                
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                        $missingFields[] = $field;
                    }
                }
                
                if (!empty($missingFields)) {
                    error_log("Missing fields: " . implode(', ', $missingFields));
                    showAlert('Vui lòng điền đầy đủ thông tin! Thiếu: ' . implode(', ', $missingFields), 'admin.php?act=updateform_client&id=' . $_POST['id']);
                    $result = getoneClient($_POST['id']);
                    include("update_client_form.php");
                    break;
                }

                // Kiểm tra username đã tồn tại chưa (trừ username hiện tại)
                if (checkDuplicateValue('tbl_client', 'user', $_POST['user_c'], $_POST['id'])) {
                    showAlert('Tên đăng nhập đã tồn tại!', 'admin.php?act=updateform_client&id=' . $_POST['id']);
                    $result = getoneClient($_POST['id']);
                    include("update_client_form.php");
                    break;
                }

                $success = update_client(
                    $_POST['id'],
                    $_POST['last_name_c'],
                    $_POST['first_name_c'],
                    $_POST['sex_c'],
                    $_POST['email_c'],
                    $_POST['phone_c'],
                    $_POST['user_c'],
                    $_POST['password_c'],
                    $_POST['address_c'],
                    $_POST['ban_c']
                );

                if ($success) {
                    showAlert('Cập nhật thông tin thành công!', 'admin.php?act=client');
                    $kq = getall_client();
                    include("client.php");
                } else {
                    showAlert('Có lỗi xảy ra khi cập nhật thông tin!', 'admin.php?act=updateform_client&id=' . $_POST['id']);
                    $result = getoneClient($_POST['id']);
                    include("update_client_form.php");
                }
            }
            break;

        case 'supplier':
            $kq = getall_supplier();
            include("supplier.php");
            break;

        case 'updateform_supplier':
            if (isset($_GET['id'])) {
                $result = getoneSupplier($_GET['id']);
                include("update_supplier_form.php");
                break;
            }
            
            if (isset($_POST['supplier_update'])) {
                if (empty($_POST['supplier_name']) || empty($_POST['supplier_address']) || 
                    empty($_POST['supplier_bank']) || empty($_POST['supplier_tax']) || empty($_POST['id'])) {
                    showAlert('Vui lòng điền đầy đủ thông tin!', 'admin.php?act=updateform_supplier&id=' . $_POST['id']);
                    $result = getoneSupplier($_POST['id']);
                    include("update_supplier_form.php");
                    break;
                }
                
                $success = update_supplier(
                    $_POST['id'],
                    $_POST['supplier_name'],
                    $_POST['supplier_address'],
                    $_POST['supplier_bank'],
                    $_POST['supplier_tax']
                );
                
                if ($success) {
                    showAlert('Cập nhật nhà cung cấp thành công!', 'admin.php?act=supplier');
                    $kq = getall_supplier();
                    include("supplier.php");
                } else {
                    showAlert('Có lỗi xảy ra khi cập nhật nhà cung cấp!', 'admin.php?act=updateform_supplier&id=' . $_POST['id']);
                    $result = getoneSupplier($_POST['id']);
                    include("update_supplier_form.php");
                }
            }
            break;

        case 'insert_supplier':
            if (!isset($_POST['submit'])) {
                include("insert_supplier.php");
                break;
            }
            
            if (isset($_POST['submit'])) {
                if (empty($_POST['supplier_name']) || empty($_POST['supplier_address']) || 
                    empty($_POST['supplier_bank']) || empty($_POST['supplier_tax'])) {
                    showAlert('Vui lòng điền đầy đủ thông tin!', 'admin.php?act=insert_supplier');
                    include("insert_supplier.php");
                    break;
                }
                
                $success = insert_supplier(
                    $_POST['supplier_name'],
                    $_POST['supplier_address'],
                    $_POST['supplier_bank'],
                    $_POST['supplier_tax']
                );
                
                if ($success) {
                    showAlert('Thêm nhà cung cấp thành công!', 'admin.php?act=supplier');
                    $kq = getall_supplier();
                    include("supplier.php");
                } else {
                    showAlert('Có lỗi xảy ra khi thêm nhà cung cấp!', 'admin.php?act=insert_supplier');
                    include("insert_supplier.php");
                }
            }
            break;

        case 'del_supplier':
            if (isset($_GET['id'])) {
                $kq = getall_product();
                $id = $_GET['id'];
                $check = false;
                foreach ($kq as $dm) {
                    if ($dm['sup_id'] == $id) {
                        $check = true;
                    }
                }
                if ($check) {
                    $kq = getall_supplier();
                    include("supplier.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Không xóa nhà cung cấp vì không hết sản phẩm!');";
                    echo '</script>';
                } else {
                    echo '<script>
                        if (confirm("Do you want to delete supplier?")) {
                            window.location.href = "admin.php?act=delete_supplier_sc&id=' . $id . '";
                        } else {
                            window.location.href = "admin.php?act=delete_supplier_fl";
                        }
                        </script>';
                }
            } else {
                $kq = getall_supplier();
                include("supplier.php");
                echo '<script type="text/javascript">';
                echo "alert('Xóa nhà cung cấp thất bại!');";
                echo '</script>';
            }
            break;

        case 'delete_supplier_fl':
            $kq = getall_supplier();
            include("supplier.php");
            echo '<script type="text/javascript">';
            echo "alert('Đã Hủy!');";
            echo '</script>';
            break;

        case 'delete_supplier_sc':
            if (isset($_GET['id']) && ($_GET['id'] != "")) {
                $id = $_GET['id'];
                delete_supplier($id);
                $kq = getall_supplier();
                include("supplier.php");
                echo '<script type="text/javascript">';
                echo "alert('Xóa nhà cung cấp thành công!');";
                echo '</script>';
            } else {
                $kq = getall_supplier();
                include("supplier.php");
                echo '<script type="text/javascript">';
                echo "alert('Xóa nhà cung cấp thất bại!');";
                echo '</script>';
            }
            break;

        case 'invoice':
            $user = getall_user();
            $kq = getall_invoice();
            include("invoice.php");
            break;

        case 'insert_data':
            include("insert_data.php");
            break;

        case 'catalog':
            $kq = getall_catalog();
            include("catalog.php");
            break;

        case 'insert_catalog':
            if (isset($_GET['id'])) {
                include("insert_catalog.php");
            }
            if (isset($_POST['submit']) && $_POST['submit']) {
                if (isset($_POST['name_catalog']) && $_POST['name_catalog'] != NULL) {
                    $rawName = $_POST['name_catalog'];
                    $name = trim($rawName);
                    $prioritize = $_POST['prioritize_catalog'];
                    $display = $_POST['display_catalog'];
                    $check = false;
                    if ($name == "" || $prioritize == "" || $display == "") {
                        $check = true;
                    }
                    $cata_cur = getall_catalog();
                    foreach ($cata_cur as $cata) {
                        if (strtolower($cata['catalog_name']) == strtolower($name)) {
                            $check = true;
                        }
                    }
                    if ($check == true) {
                        $kq = getall_catalog();
                        include("catalog.php");
                        echo '<script type="text/javascript">';
                        echo "alert('Không chèn danh mục vì bạn thiếu thông tin hoặc danh mục tồn tại');";
                        echo '</script>';
                    } else {
                        insert_catalog($name, $prioritize, $display);
                        $kq = getall_catalog();
                        include("catalog.php");
                        echo '<script type="text/javascript">';
                        echo "alert('Thêm danh mục thành công!');";
                        echo '</script>';
                        break;
                    }
                } else if ($_POST['name_catalog'] == "") {
                    $kq = getall_catalog();
                    include("catalog.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Không thể thêm danh mục vì bạn nhập thiếu thông tin!');";
                    echo '</script>';
                    break;
                }
            }
            break;

        case 'del_catalog':
            if (isset($_GET['id'])) {
                $kq = getall_product();
                $id = $_GET['id'];
                $check = false;
                foreach ($kq as $dm) {
                    if ($dm['catalog_id'] == $id) {
                        $check = true;
                    }
                }
                if ($check) {
                    $kq = getall_catalog();
                    include("catalog.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Không xóa danh mục vì không hết sản phẩm!');";
                    echo '</script>';
                } else {
                    echo '<script>
                        if (confirm("Bạn có muốn xóa danh mục?")) {
                            window.location.href = "admin.php?act=delete_catalog_sc&id=' . $id . '";
                        } else {
                            window.location.href = "admin.php?act=delete_catalog_fl";
                        }
                        </script>';
                }
            } else {
                $kq = getall_catalog();
                include("catalog.php");
                echo '<script type="text/javascript">';
                echo "alert('Xóa danh mục thất bại!');";
                echo '</script>';
            }
            break;

        case 'delete_catalog_fl':
            $kq = getall_catalog();
            include("catalog.php");
            echo '<script type="text/javascript">';
            echo "alert('Đã Hủy!');";
            echo '</script>';
            break;

        case 'delete_catalog_sc':
            if (isset($_GET['id']) && ($_GET['id'] != "")) {
                $id = $_GET['id'];
                delete_catalog($id);
                $kq = getall_catalog();
                include("catalog.php");
                echo '<script type="text/javascript">';
                echo "alert('Xoá danh mục thành công!');";
                echo '</script>';
            } else {
                $kq = getall_catalog();
                include("catalog.php");
                echo '<script type="text/javascript">';
                echo "alert('Xoá danh mục thất bại!');";
                echo '</script>';
            }
            break;

        case 'updateform_catalog':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $result = getoneCatalog($id);
                $kq = getall_catalog();
                include("update_catalog_form.php");
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $rawName = $_POST['catalog_name'];
                $name = trim($rawName);
                $display = $_POST['display_ctl'];
                $check = false;
                $cata_cur = getall_catalog();
                foreach ($cata_cur as $cata) {
                    if ((strtolower($name) == strtolower($cata['catalog_name'])) && ($cata['display_ctl'] == $display)) {
                        $check = true;
                    }
                }
                if ($check == true) {
                    $kq = getall_catalog();
                    include("catalog.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật danh mục thất bại vì danh mục tồn tại!');";
                    echo '</script>';
                    break;
                } elseif ($check == false) {
                    update_catalog($id, $name, $display);
                    $kq = getall_catalog();
                    include("catalog.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật thành công!');";
                    echo '</script>';
                    break;
                }
            }
            break;

        case 'insert_product':
            if (!isset($_POST['submit'])) {
                $dmsp = getall_catalog();
                $dmee = getall_user();
                $dmsup = getall_supplier();
                include("insert_product.php");
                break;
            }
            
            // Xử lý khi form được submit
            if (isset($_POST['submit'])) {
                $product_name = $_POST['name_product'];
                $quantity = $_POST['quantity_product'];
                $id_catalog = $_POST['iddm'];
                $prices = $_POST['prices_product'];
                $oldprices = $_POST['oldprices_product'];
                $id_employee = $_POST['idee'];
                $id_supplier = $_POST['idsup'];
                $size = $_POST['size_product'];
                $view = $_POST['view_product'];
                $special = $_POST['special_product'];
                $description = $_POST['description_product'];
                
                // Kiểm tra dữ liệu đầu vào
                if(empty($product_name) || empty($quantity) || empty($id_catalog) || 
                   empty($prices) || empty($size) || $id_catalog == "0" || 
                   empty($id_supplier) || $id_supplier == "0") {
                    showAlert("Vui lòng điền đầy đủ thông tin!");
                    header("Location: admin.php?act=insert_product");
                    exit();
                }
                
                // Xử lý upload ảnh
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["img_product"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Kiểm tra file ảnh
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["img_product"]["tmp_name"]);
                    if($check === false) {
                        showAlert("File không phải là ảnh.");
                        $uploadOk = 0;
                    }
                }
                
                // Kiểm tra kích thước file
                if ($_FILES["img_product"]["size"] > 500000) {
                    showAlert("File quá lớn.");
                    $uploadOk = 0;
                }
                
                // Cho phép các định dạng file
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    showAlert("Chỉ chấp nhận file JPG, JPEG, PNG & GIF.");
                    $uploadOk = 0;
                }
                
                if ($uploadOk == 0) {
                    showAlert("File của bạn không được upload.");
                } else {
                    if (move_uploaded_file($_FILES["img_product"]["tmp_name"], $target_file)) {
                        $product_img = basename($_FILES["img_product"]["name"]);
                        
                        // Kiểm tra sản phẩm đã tồn tại
                        $existing_product = get_product_by_name_and_size($product_name, $size);
                        if($existing_product) {
                            // Cập nhật số lượng nếu sản phẩm đã tồn tại
                            $new_quantity = $existing_product['quantity'] + $quantity;
                            if(update_product_quantity($existing_product['id_product'], $new_quantity)) {
                                showAlert("Sản phẩm đã tồn tại. Đã cập nhật số lượng.");
                                header("Location: admin.php?act=product");
                                exit();
                            }
                        } else {
                            // Thêm sản phẩm mới
                            if(insert_product($id_catalog, $quantity, $product_name, $prices, $product_img, 
                                           $id_employee, $id_supplier, $oldprices, $view, $special, 
                                           $description, $size)) {
                                showAlert("Thêm sản phẩm thành công!");
                                header("Location: admin.php?act=product");
                                exit();
                            } else {
                                showAlert("Có lỗi xảy ra khi thêm sản phẩm.");
                            }
                        }
                    } else {
                        showAlert("Có lỗi xảy ra khi upload file.");
                    }
                }
            }
            break;

        case 'del_product':
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];
                
                // Kiểm tra xem sản phẩm có trong giỏ hàng không
                if (check_product_in_cart($product_id)) {
                    showAlert("Không thể xóa sản phẩm này vì đang có trong giỏ hàng!");
                    header("Location: admin.php?act=product");
                    exit();
                }
                
                // Xác nhận xóa
                echo '<script>
                    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                        window.location.href = "admin.php?act=delete_product_confirm&id=' . $product_id . '";
                    } else {
                        window.location.href = "admin.php?act=product";
                    }
                </script>';
            }
            break;
            
        case 'delete_product_confirm':
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];
                
                // Lấy thông tin sản phẩm trước khi xóa
                $product = getoneProduct($product_id);
                if (!empty($product)) {
                    // Xóa file ảnh cũ nếu tồn tại
                    $old_image = "../uploads/" . $product[0]['product_img'];
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                    
                    // Xóa sản phẩm
                    if (delete_product($product_id)) {
                        showAlert("Xóa sản phẩm thành công!");
                    } else {
                        showAlert("Có lỗi xảy ra khi xóa sản phẩm!");
                    }
                }
            }
            header("Location: admin.php?act=product");
            break;

        case 'updateform_product':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $result = getoneProduct($id);
                $kq = getall_product();
                $dmee = getall_user();
                $dmsp = getall_catalog();
                $dmsup = getall_supplier();
                include("update_product_form.php");
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $id_pd = $_POST['iddm'];
                $id_ee = $_POST['idee'];
                $id_sup = $_POST['idsup'];
                $pdName = $_POST['name_product'];
                $name_pd = trim($pdName);
                $quantity_pd = $_POST['quantity_product'];
                $prices_pd = $_POST['prices_product'];
                $oldprices_pd = $_POST['oldprices_product'];
                $view_pd = $_POST['view_product'];
                $special_pd = $_POST['special_product'];
                $description_pd = $_POST['description_product'];
                $size_pd = strtoupper($_POST['size_product']);

                // Lấy thông tin sản phẩm cũ từ database
                $old_product = getoneProduct($id);
                
                if ($_FILES["img_product"]["name"] != "") {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["img_product"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Kiểm tra kích thước file
                    if ($_FILES["img_product"]["size"] > 500000) {
                        echo '<script type="text/javascript">';
                        echo "alert('File ảnh quá lớn.');";
                        echo '</script>';
                        $uploadOk = 0;
                    }

                    // Kiểm tra định dạng file
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo '<script type="text/javascript">';
                        echo "alert('Chỉ chấp nhận file JPG, JPEG, PNG & GIF.');";
                        echo '</script>';
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 1 && move_uploaded_file($_FILES["img_product"]["tmp_name"], $target_file)) {
                        $img_pd = basename($_FILES["img_product"]["name"]);
                    } else {
                        $img_pd = $old_product[0]['product_img']; // Giữ lại ảnh cũ nếu upload thất bại
                    }
                } else {
                    $img_pd = $old_product[0]['product_img']; // Giữ lại ảnh cũ nếu không chọn ảnh mới
                }

                $getproduct = getall_product();
                $flag_check_similar = false;
                foreach ($getproduct as $pro) {
                    if ($pro['product_name'] == $name_pd && $id != $pro['id_product']) {
                        $flag_check_similar = true;
                    }
                }

                if ($flag_check_similar) {
                    $kq = getall_product();
                    $dmee = getall_user();
                    $dmsp = getall_catalog();
                    $dmsup = getall_supplier();
                    $flag_check_similar = false;
                    include("product.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật sản phẩm thất bại vì sản phẩm tồn tại!');";
                    echo '</script>';
                } else {
                    update_product($id, $quantity_pd, $id_pd, $name_pd, $prices_pd, $img_pd, $id_ee, $id_sup, $oldprices_pd, $view_pd, $special_pd, $description_pd, $size_pd);
                    $dmsp = getall_catalog();
                    $dmee = getall_user();
                    $dmsup = getall_supplier();
                    $kq = getall_product();
                    include("product.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật thành công!');";
                    echo '</script>';
                }
            }
            break;

        case 'updateform_invoice':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $dmee = getall_user();
                $result = getoneInvoice($id);
                include("update_invoice_form.php");
            }
            if (!isset($_GET['id'])) {
                if (isset($_POST['id']) && ($_POST['idee'] != 0)) {
                    $id = $_POST['id'];
                    $id_ee = $_POST['idee'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $address = $_POST['address'];
                    $status = $_POST['status'];
                    update_invoice($id, $id_ee, $status, $phone, $email, $fname, $lname, $address);
                    $kq = getall_invoice();
                    $user = getall_user();
                    if ($status == "Cancel") {
                        $id_cart = getall_cart_month($id);
                        foreach ($id_cart as $cart) {
                            $quantity = $cart['quantity'];
                            $id_pro = $cart['id_pro'];
                            $product = getoneProduct($id_pro);
                            $quantity = $quantity + $product[0]['quantity'];
                            update_product_quantity($id_pro, $quantity);
                        }
                    }
                    include("invoice.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật hoá đơn thành công!');";
                    echo '</script>';
                } else {
                    $user = getall_user();
                    $kq = getall_invoice();
                    include("invoice.php");
                    echo '<script type="text/javascript">';
                    echo "alert('Cập nhật thất bại vui lòng nhập nhân viên!');";
                    echo '</script>';
                }
            }
            break;

        case 'update_invoice_status':
            ob_clean(); // Xóa mọi output trước đó
            header('Content-Type: application/json');
            
            if(isset($_POST['id']) && isset($_POST['status'])) {
                require_once("../model/invoicedb.php");
                $id = $_POST['id'];
                $status = $_POST['status'];
                
                $result = update_invoice_status($id, $status);
                
                if($result) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật trạng thái']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Thiếu thông tin cần thiết']);
            }
            exit;
            break;

        default:
            header('location: login.php');
            break;
    }
} else {
    header('location: login.php');
}
