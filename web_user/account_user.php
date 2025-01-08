<script>
// Lắng nghe sự kiện click trên các liên kết tab
document.addEventListener('DOMContentLoaded', function() {
    var tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            var target = this.getAttribute('href'); // Lấy đích đến của tab

            // Ẩn tất cả các tab pane
            var tabPanes = document.querySelectorAll('.tab-pane');
            tabPanes.forEach(function(pane) {
                pane.classList.remove('show', 'active');
            });

            // Hiển thị tab pane tương ứng với tab được nhấp
            var activePane = document.querySelector(target);
            activePane.classList.add('show', 'active');
        });
    });
});
</script>
<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <!-- <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="index.php?act=homepage_login_successed">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                        </ul> -->
                        <h1 class="title-kid">Thông tin tài khoản</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img style="height: 150px; width: 150px;" src="../assets/images/logo/Minilogo.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <aside class="axil-dashboard-aside">
                            <nav class="axil-dashboard-nav">
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-item nav-link   active" data-bs-toggle="tab" href="#nav-account"
                                        role="tab" aria-selected="false"><i class="fas fa-user"></i>Thông tin tài khoản</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab"
                                        aria-selected="false"><i class="fas fa-shopping-basket"></i>Đơn hàng</a>
                                </div>
                            </nav>
                        </aside>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane fade " id="nav-orders" role="tabpanel">
                                <div class="axil-dashboard-order">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Đơn hàng</th>
                                                    <th scope="col">Ngày đặt</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Tổng tiền</th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        foreach($order as $od)
                                                        {
                                                            $iduser_check=$_SESSION['iduser'];
                                                            if($iduser_check == $od['id_user'])
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <th scope="row">'.$od['invoice_id'].'</th>
                                                                        <td>'.$od['due_date'].'</td>
                                                                ';
                                                                
                                                                if($od['status'] =="Pending")
                                                                {
                                                                  echo '<td style="color: grey; font-weight: bold;">Đang xử lý</td>';
                                                                } elseif ($od['status'] == "Cancel"){
                                                                  echo '<td style="color: red; font-weight: bold;">Đã hủy</td>';
                                                                } elseif ($od['status'] == "Delivered"){
                                                                  echo '<td style="color: green; font-weight: bold;">Đã giao hàng</td>';
                                                                }
                                    
                                                                echo'
                                                                        <td>'.number_format($od['total_prices']).'</td>
                                                                        <td><a href="fashionApp.php?act=print_invoice&iddh='.$od['id'].'" class="axil-btn view-btn">In hóa đơn</a></td>
                                                                    </tr>
                                                                ';
                                                            }
                                                        }
                                                    
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="tab-pane fade  show active" id="nav-account" role="tabpanel">
                                <div class="col-lg-9">
                                    <div class="axil-dashboard-account">
                                        <form class="account-details-form">
                                            <?php
                                                    $iduser=$_SESSION['iduser'];
                                                    foreach($client as $client)
                                                    {
                                                        if($iduser == $client['id'])
                                                        {
                                                            echo'
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Tên</label>
                                                                        <input  style="background-color: white;" type="text" readonly class="form-control" value="'.$client['fname'].'">
                                                                    </div>
                                                                </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Họ</label>
                                                                    <input style="background-color: white;"type="text" readonly class="form-control" value="'.$client['lname'].'">
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="axil-dashboard-address">
                                                            <p class="notice-text">Các địa chỉ sau sẽ được sử dụng mặc định trong trang thanh toán.</p>
                                                            <div class="row row--30">
                                                                <div class="col-lg-6">
                                                                    <div class="address-info mb--40">
                                                                        <div class="addrss-header d-flex align-items-center justify-content-between">
                                                                            <h4 class="title mb-0">Thông tin cá nhân</h4>
                                                                            <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                                        </div>
                                                                        <ul class="address-details">
                                                                            <li>Tên: '.$client['fname'].'</li>
                                                                            <li>Email: '.$client['email'].'</li>
                                                                            <li>SDT: '.$client['phone'].'</li>
                                                                            <li>Địa chỉ: '.$client['address'].'</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="address-info">
                                                                        <div class="addrss-header d-flex align-items-center justify-content-between">
                                                                            <h4 class="title mb-0">Địa chỉ thanh toán</h4>
                                                                            <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                                        </div>
                                                                        <ul class="address-details">
                                                                            <li>Tên: '.$client['fname'].'</li>
                                                                            <li>Email: '.$client['email'].'</li>
                                                                            <li>SDT: '.$client['phone'].'</li>
                                                                            <li>Địa chỉ: '.$client['address'].'</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ';
                                                        }
                                                    }
                                                ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->
</main>