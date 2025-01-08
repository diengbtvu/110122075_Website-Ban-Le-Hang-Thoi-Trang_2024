<div class="axil-checkout-area axil-section-gap">
            <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="axil-checkout-billing">
                                <?php
                                    // var_dump($more_order);
                                    $checs=1;
                                    echo '
                                        <form action="fashionApp.php?act=check_out_update" method="POST">
                                            <h4 class="title mb--40">Chi tiết đơn hàng</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Tên<span>*</span></label>
                                                        <input type="text" id="first-name" value="'.$more_order[0]['fname'].'" placeholder="Tên của bạn" name="fname">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Họ <span>*</span></label>
                                                        <input type="text" id="last-name" value="'.$more_order[0]['lname'].'" placeholder="Họ của bạn" name="lname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ <span>*</span></label>
                                                <input type="text" value="'.$more_order[0]['address'].'"  id="country" name="address">
                                            </div>
                                            <div class="form-group">
                                                <label>SDT <span>*</span></label>
                                                <input type="tel" value="'.$more_order[0]['phone'].'" id="phone" name="phone">
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ email <span>*</span></label>
                                                <input type="email" value="'.$more_order[0]['email'].'" id="email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Ghi chú khác (ý kiến)</label>
                                                <textarea name="notes" id="notes" rows="2" placeholder="Ghi chú đặc biệt của bạn, những gì bạn cần khi giao hàng."></textarea>
                                            </div>
                                            <input type="hidden" value="'.$iddh.'" id="email" name="iddh">
                                    ';
                                ?>
                            </div>
                        </div>
                        <!--  -->
                                    <div class="col-lg-6">
                                    <div class="axil-order-summery order-checkout-summery">
                                        <h5 class="title mb--20">Đơn của bạn</h5>
                                        <div class="summery-table-wrap">
                                            <table class="table summery-table">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Size</th>
                                                        <th style="text-align:left;">Giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($more_cart as $cart)
                                                        {
                                                            if($iddh == $cart['id_order'])
                                                            {
                                                                echo '
                                                                <tr class="order-product">
                                                                    <td>'.$cart['name_pro'].' <span class="quantity">x'.$cart['quantity'].'</span></td>
                                                                    <td>'.$cart['size'].'</td>
                                                                    <td style="text-align:left;">'.number_format($cart['prices']).'đ</td>
                                                                </tr>
                                                            ';
                                                            }
                                                        }
                                                    ?>
                                                    <?php
                                                        $total = 0;
                                                        foreach($more_order as $order)
                                                        {
                                                            if($iddh == $order['id'])
                                                            {
                                                                $total = $order['total_prices'];
                                                            }                                    
                                                        }
                                                        echo '
                                                        <tr class="order-subtotal">
                                                        <td>Tổng tiền</td>
                                                        <td>'.number_format($total).'đ</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="order-shipping" >
                                                                    <div class="shipping-amount">
                                                                        <span class="title">Phương thức vận chuyển</span>
                                                                        <span class="amount">0.00đ</span>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="input-group">
                                                                    <input type="radio" id="radio1" name="shipping" checked>
                                                                    <label for="radio1">Giao hàng miễn phí</label>
                                                                </div>
                                                                <br>
                                                                <div class="input-group">
                                                                    <input type="radio" id="radio2" name="shipping">
                                                                    <label for="radio2">Địa phương</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ';
                                                    ?>
                                                    <?php                                    
                                                    echo'
                                                                            <tr class="order-total">
                                                                                <td>Tổng</td>
                                                                                <td class="order-total-amount">'.number_format($total).'đ</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <input value="Xong" type="submit" name="submit"  class="axil-btn btn-bg-primary checkout-btn"></input>
                                                            </div>
                                                        </div>
                                                    ';
                                                    ?>
                        <!--  -->               </tbody>
                        </form>
                    </div>
            </div>
        </div>
                                                                <!-- End Checkout Area  -->
                                                                <!-- <div class="order-payment-method">
                                                                    <div class="single-payment">
                                                                        <div class="input-group">
                                                                            <input type="radio" id="radio5" name="payment">
                                                                            <label for="radio5">Cash on delivery</label>
                                                                        </div>
                                                                        <p>Pay with cash upon delivery.</p>
                                                                    </div>
                                                                    <div class="single-payment">
                                                                        <div class="input-group justify-content-between align-items-center">
                                                                            <input type="radio" id="radio6" name="payment" checked>
                                                                            <label for="radio6">Momo</label>
                                                                            <img style="width: 110px; height: 40px;" src="../assets/images/others/momo3.png" alt="Paypal payment">
                                                                        </div>
                                                                        <p>Momo-nom-nom, convenience awaits!</p>
                                                                    </div>
                                                                </div> -->