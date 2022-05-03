<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Order']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table">
          <thead>
            <tr>
              <th>Mã đơn hàng</th>
              <th>Tên sản phẩm</th>
              <th>Trạng thái</th>
              <th>Phương thức thanh toán</th>
              <th>Tổng tiền</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="order-detail.html">#1</a></td>
              <td>Clean Code</td>
              <td class="text-success font-weight-bold">Giao hàng thành công</td>
              <td>
                COD
              </td>
              <td>200.000đ</td>
              <td><a href="order-detail.html"><button class="btn btn-sm btn-info mr-2">Chi
                    tiết</button></a>
                <button class="btn btn-sm btn-danger" disabled>Hủy đơn hàng</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
export default {
  name: 'Order',
  components: { Breadcrumb }
};
</script>
<style>
</style>