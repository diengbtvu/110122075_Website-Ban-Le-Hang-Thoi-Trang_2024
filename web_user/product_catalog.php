<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <!-- <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Clothes</li>
                            </ul> -->
                        <h1 class="title-kid">Khám Phá Sản Phẩm</h1>
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
    <!-- Start Shop Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Sidebar Filter -->
                    <div class="axil-shop-sidebar">
                        <div class="d-lg-none mb-4">
                            <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterSidebar">
                                <i class="fas fa-filter me-2"></i>Hiển thị bộ lọc
                            </button>
                        </div>
                        
                        <div class="collapse d-lg-block" id="filterSidebar">
                            <div class="sidebar-widget">
                                <h6 class="widget-title">Bộ lọc sản phẩm</h6>
                                
                                <form action="" method="GET" class="filter-form">
                                    <input type="hidden" name="act" value="<?php echo $_GET['act']; ?>">
                                    <?php if(isset($_GET['iddm'])): ?>
                                        <input type="hidden" name="iddm" value="<?php echo $_GET['iddm']; ?>">
                                    <?php endif; ?>
                                    
                                    <div class="filter-widget mb-4">
                                        <h6 class="widget-sub-title">Khoảng giá</h6>
                                        <div class="price-range">
                                            <select name="price_range" class="form-select">
                                                <option value="">Tất cả mức giá</option>
                                                <option value="0-3000000" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == '0-3000000') ? 'selected' : ''; ?>>Dưới 3,000,000đ</option>
                                                <option value="3000000-5000000" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == '3000000-5000000') ? 'selected' : ''; ?>>3,000,000đ - 5,000,000đ</option>
                                                <option value="5000000-10000000" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == '5000000-10000000') ? 'selected' : ''; ?>>5,000,000đ - 10,000,000đ</option>
                                                <option value="10000000" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == '10000000') ? 'selected' : ''; ?>>Trên 10,000,000đ</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="filter-widget mb-4">
                                        <h6 class="widget-sub-title">Sắp xếp theo</h6>
                                        <div class="sorting-selection">
                                            <select name="sort" class="form-select">
                                                <option value="">Mặc định</option>
                                                <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Giá: Thấp đến cao</option>
                                                <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Giá: Cao đến thấp</option>
                                                <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>Tên: A-Z</option>
                                                <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : ''; ?>>Tên: Z-A</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="filter-actions">
                                        <button type="submit" class="btn btn-primary w-100 mb-2">
                                            <i class="fas fa-filter me-2"></i>Áp dụng
                                        </button>
                                        <?php if(isset($_GET['price_range']) || isset($_GET['sort'])): ?>
                                            <a href="?act=<?php echo $_GET['act']; ?><?php echo isset($_GET['iddm']) ? '&iddm='.$_GET['iddm'] : ''; ?>" 
                                               class="btn btn-outline-secondary w-100">
                                                <i class="fas fa-times me-2"></i>Xóa lọc
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <!-- Product Grid -->
                    <div class="row row--15">
                        <?php
                            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
                            $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                            
                            $filtered_products = filter_products($iddm, $price_range, $sort);
                            
                            foreach($filtered_products as $pd) {
                                if($pd['view']==1){
                                    echo '
                                    <div class="col-xl-4 col-lg-4 col-sm-6">
                                        <div class="axil-product product-style-one has-color-pick mt--40">
                                            <div class="thumbnail">
                                                <a href="fashionApp.php?act=detail_product&id='.$pd['id_product'].'">
                                                    <img class="conform-img" src="../uploads/'.$pd['product_img'].'" alt="Product Images">
                                                </a>
                                                <div class="product-hover-action">
                                                    <ul class="cart-action">
                                                        <li class="wishlist"><a href="fashionApp.php?act=detail_product&id='.$pd['id_product'].'"><i class="far fa-heart"></i></a></li>
                                                        <li class="select-option"><a  href="fashionApp.php?act=detail_product&id='.$pd['id_product'].'">Mua ngay</a></li>
                                                        <li class="quickview"><a href="fashionApp.php?act=detail_product&id='.$pd['id_product'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="inner">
                                                    <h5 class="title"><a href="fashionApp.php?act=detail_product&id='.$pd['id_product'].'">'.$pd['product_name'].'</a></h5>
                                                    <div class="product-price-variant">
                                                        <span class="price current-price">'.number_format($pd['product_prices']).'đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                }
                            }
                            ?>
                        <!-- End Single Product  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Area  -->
</main>