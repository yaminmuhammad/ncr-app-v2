<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="mycard">
        <div>
            <div class="numbers">1,504</div>
            <div class="cardName">Daily Views</div>
        </div>

        <div class="iconBx">
            <ion-icon name="eye-outline"></ion-icon>
        </div>
    </div>

    <div class="mycard">
        <div>
            <div class="numbers">80</div>
            <div class="cardName">Sales</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cart-outline"></ion-icon>
        </div>
    </div>

    <div class="mycard">
        <div>
            <div class="numbers">284</div>
            <div class="cardName">Comments</div>
        </div>

        <div class="iconBx">
            <ion-icon name="chatbubbles-outline"></ion-icon>
        </div>
    </div>

    <div class="mycard">
        <div>
            <div class="numbers">$7,842</div>
            <div class="cardName">Earning</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </div>
</div>

<!-- ================ Order Details List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Recent Orders</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Payment</td>
                    <td>Status</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Star Refrigerator</td>
                    <td>$1200</td>
                    <td>Paid</td>
                    <td><span class="status delivered">Delivered</span></td>
                </tr>

                <tr>
                    <td>Dell Laptop</td>
                    <td>$110</td>
                    <td>Due</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>

                <tr>
                    <td>Apple Watch</td>
                    <td>$1200</td>
                    <td>Paid</td>
                    <td><span class="status return">Return</span></td>
                </tr>

                <tr>
                    <td>Addidas Shoes</td>
                    <td>$620</td>
                    <td>Due</td>
                    <td><span class="status inProgress">In Progress</span></td>
                </tr>

                <tr>
                    <td>Star Refrigerator</td>
                    <td>$1200</td>
                    <td>Paid</td>
                    <td><span class="status delivered">Delivered</span></td>
                </tr>

                <tr>
                    <td>Dell Laptop</td>
                    <td>$110</td>
                    <td>Due</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>

                <tr>
                    <td>Apple Watch</td>
                    <td>$1200</td>
                    <td>Paid</td>
                    <td><span class="status return">Return</span></td>
                </tr>

                <tr>
                    <td>Addidas Shoes</td>
                    <td>$620</td>
                    <td>Due</td>
                    <td><span class="status inProgress">In Progress</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>