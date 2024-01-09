<?php
include '../database/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $status_bayar = $_POST['status_bayar'];
    $status_bayar = filter_var($status_bayar, FILTER_SANITIZE_STRING);
    $update_payment = $koneksi->prepare("UPDATE `orders` SET status_bayar = ? WHERE id = ?");
    $update_payment->execute([$status_bayar, $order_id]);
    $message[] = 'Status Pembayaran Telah Diperbarui';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $koneksi->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:order.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Order</title>
</head>

<body>

    <?php include '../components/header.php'; ?>

    <section class="orders">

        <h1 class="heading">Pesanan</h1>

        <div class="box-container">

            <?php
            $select_orders = $koneksi->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->num_rows > 0) {
                while ($fetch_orders = $select_orders->fetch_assoc()) {
            ?>
                    <div class="box">
                        <p> ID Pesanan : <span><?= $fetch_orders['id']; ?></span> </p>
                        <p> ID Pengguna : <span><?= $fetch_orders['user_id']; ?></span> </p>
                        <p> Nama : <span><?= $fetch_orders['nama']; ?></span> </p>
                        <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
                        <p> No. Telepon : <span><?= $fetch_orders['nomor']; ?></span> </p>
                        <p> Alamat : <span><?= $fetch_orders['alamat']; ?></span> </p>
                        <p> Total Pesanan : <span><?= $fetch_orders['total_products']; ?></span> </p>
                        <p> Total Harga : <span>$<?= $fetch_orders['total_harga']; ?>/-</span> </p>
                        <p> Metode Pembayaran : <span><?= $fetch_orders['pembayaran']; ?></span> </p>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                            <select name="status_bayar" class="select">
                                <option selected disabled><?= $fetch_orders['status_bayar']; ?></option>
                                <option value="pending">Belum Diproses</option>
                                <option value="process">Proses</option>
                                <option value="completed">Selesai</option>
                            </select>
                            <div class="flex-btn">
                                <input type="submit" value="update" class="option-btn" name="update_payment">
                                <a href="order.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Hapus pesanan ini?');">Hapus</a>
                            </div>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Belum ada pesanan.</p>';
            }
            ?>

        </div>

    </section>

    <?php include '../components/footer.php' ?>

    <script src="../js/admin.js"></script>

</body>

</html>