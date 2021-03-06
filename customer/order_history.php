<style>
    table.lich-su tr td {
        width: fit-content;
        text-align: start;
        vertical-align: top;
    }
</style>

<div class="lich-su">
    <table class="lich-su" border=1px style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>STT</th>
            <th>Mã Đơn</th>
            <th>Thông Tin Người Nhận</th>
            <th>Thông Tin Đơn Hàng</th>
            <th>Ngày Đặt Đơn</th>
            <th>Tình Trạng</th>
        </tr>
        <?php
        $ma_khach_hang = $_SESSION['dang-nhap'];
        $trang = 1; //khởi tạo trang ban đầu
        $gioi_han = 3; //số bản ghi trên 1 trang (2 bản ghi trên 1 trang)

        $rs = mysqli_query($conn, "select count(id_hoa_don) as tong_hoa_don from hoadon where id_khach_hang = $ma_khach_hang");

        $tong_hoa_don = mysqli_fetch_array($rs); //tính tổng số bản ghi 

        $tong_trang = ceil($tong_hoa_don['tong_hoa_don'] / $gioi_han); //tính tổng số trang sẽ chia

        //xem trang có vượt giới hạn không:
        if (isset($_GET['trang'])) {
            $trang = $_GET['trang'];
            if ($trang < 1) {
                $trang = 1;
            } //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
            if ($trang > $tong_trang) {
                $trang = $tong_trang;
            }
        } //nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng

        //tính start (vị trí bản ghi sẽ bắt đầu lấy):
        $vi_tri = ($trang - 1) * $gioi_han;


        $sql = "select id_hoa_don, nguoi_nhan, so_dien_thoai, dia_chi, ngay_dat_don, tinh_trang, ghi_chu from hoadon where id_khach_hang = $ma_khach_hang limit $vi_tri, $gioi_han";

        $rs = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($rs);
        $i = 1;
        if ($row == 0) {
            echo "<tr><td colspan=\"6\">Bạn chưa có hóa đơn đặt hàng nào!</td></tr>";
        } else {
            while ($each = mysqli_fetch_assoc($rs)) {
        ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php $ma_hoa_don = $each['id_hoa_don'];
                        echo $ma_hoa_don ?></td>
                    <td>
                        <table>
                            <tr>
                                <td>Người nhận: </td>
                                <td><?php echo $each['nguoi_nhan'] ?></td>
                            </tr>
                            <tr>
                                <td>SĐT người nhận: </td>
                                <td><?php echo $each['so_dien_thoai'] ?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ người nhận: </td>
                                <td><?php echo $each['dia_chi'] ?></td>
                            </tr>
                            <tr>
                                <td>Ghi chú người nhận: </td>
                                <td><?php if ($each['ghi_chu'] == null) {
                                        echo "Không có ghi chú";
                                    } else {
                                        echo $each['ghi_chu'];
                                    } ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <?php
                            $sql2 = "select quanlisanpham.id_san_pham, ten_san_pham, anh_san_pham, hoadonchitiet.gia, hoadonchitiet.so_luong from hoadonchitiet 
                        join quanlisanpham on quanlisanpham.id_san_pham = hoadonchitiet.id_san_pham where id_hoa_don = $ma_hoa_don";

                            $rs2 = mysqli_query($conn, $sql2);
                            $j = 1;
                            $tong_don_hang = 0;
                            while ($each2 = mysqli_fetch_assoc($rs2)) {
                                $tong_don_hang += $each2['so_luong'] * $each2['gia'];
                            ?>
                                <tr>
                                    <td rowspan="4" style="width: 20px"><?php echo $j++ ?>.</td>
                                    <td style="width: 150px"><a href="/PHP%202/sanpham/view_all.php?ma_san_pham=<?php echo $each2['id_san_pham'] ?>"><?php echo $each2['ten_san_pham'] ?></a></td>
                                </tr>
                                <tr>
                                    <td><img src="/PHP 2/admincp/modules/quanlisanpham/<?php echo $each2['anh_san_pham'] ?>" alt="" height="50px"></td>
                                </tr>
                                <tr>
                                    <td>Giá: <?php echo number_format($each2['gia']) ?></td>
                                </tr>
                                <tr>
                                    <td>SL: <?php echo $each2['so_luong'] ?></td>
                                </tr>

                            <?php
                            }

                            ?>
                            <tr>
                                <td colspan="2">Tổng đơn hàng: <?php echo number_format($tong_don_hang) ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?php $ngay_dat_don = date_create($each['ngay_dat_don']);
                        echo date_format($ngay_dat_don, "d/m/Y") ?></td>

                    <td>
                        <?php if ($each['tinh_trang'] == 0) {
                            echo "Đang chờ duyệt";
                            echo "<br>";
                            echo "<a href=\"/PHP 2/customer/process.php?action=huy_don_hang&ma_don=".$ma_hoa_don."\">Hủy</a>";
                        } else if ($each['tinh_trang'] == 1) {
                            echo "Đã lên đơn hàng";
                        } else {
                            echo "Đã hủy";
                        } ?>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
    <div class="dem-trang" style="width: 100%; float: left; text-align: right;">
        <ul style="list-style-type: none;">
            <li style="display: inline-flex;"><i>Xem tiếp trang: </i></li>
            <?php for ($k = 1; $k <= $tong_trang; $k++) {  ?>
                <li style="display: inline;">
                    <?php if ($k == $trang) { ?>
                        <span><?php echo $k ?></span>
                    <?php } else { ?>
                        <a href="index.php?manage=khach_hang&action=xem_lich_su_mua_hang&trang=<?php echo $k; ?>"><?php echo $k; ?></a>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>