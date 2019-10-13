<template>
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 style="text-decoration: underline">الطلبيات</h1>
      </div>
    </div>
    <orders-filter @filterChange="filterChanged" />
    <div
      v-if="orderPossibleState"
      class="card"
      style="direction: rtl; text-align: right; margin-top: 8px;"
    >
      <div class="card-body">
        يتم عرض <b>{{orders.length}}</b> طلبية في حالة <b>{{orderPossibleState.title}}</b>
        <button
          @click="createOrderPressed"
          class="btn btn-primary float-left"
        >طلبية جديدة</button>
      </div>
    </div>
    <table class="table table-striped" style="direction: rtl">
      <thead>
        <tr>
          <th>#</th>
          <th>رقم الطلبية</th>
          <th>المنتج</th>
          <th>الزبون</th>
          <th>السعر</th>
          <th>وضع في</th>
          <th>آخر حالة</th>
          <th>معلومات إضافية</th>
          <th>إجراء</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td>{{order.id}}</td>
          <td>{{order.custom_id}}</td>
          <td>{{order.products.length ? order.products[0].name : 'لا يوجد'}}</td>
          <td>
            {{order.client_name}}
            <br />
            {{order.client_phone}}
            <br />
            {{order.client_address}}
          </td>
          <td v-if="order.products.length">
            {{order.products[0].pivot.quantity + ' x ' + order.products[0].pivot.one_item_price}}
            <br />
            = {{order.products[0].pivot.quantity*order.products[0].pivot.one_item_price}}
          </td>
          <td v-else>لا يوجد</td>
          <td>{{utcToLocal(order.created_at).format('DD-MM-YYYY HH:mm a')}}</td>
          <td>
            {{order.currentState ? order.currentState.title : 'لا يوجد'}}
            <br />
            {{order.currentState ? utcToLocal(order.currentState.pivot.created_at).format('DD-MM-YYYY HH:mm a'): 'لا يوجد'}}
          </td>
          <td>{{order.additional_info}}</td>
          <td>
            <button @click="changeStatePressed(order)" class="btn btn-link">تغيير الحالة</button>
            <button @click="viewPressed(order)" class="btn btn-link">معاينة</button>
            <button @click="editPressed(order)" class="btn btn-link">تعديل</button>
            <button @click="deletePressed(order)" class="btn btn-link">حذف</button>
          </td>
        </tr>
      </tbody>
    </table>
    <modal :active="showOrderStateChangerModal" @close="showOrderStateChangerModal = false">
      <order-state-changer :order="orderChangingState" />
    </modal>
    <modal :active="showOrderDetailsModal" @close="showOrderDetailsModal = false">
      <order-details :order="orderShowingDetails" />
    </modal>
  </div>
</template>
<script>
import { mapState } from "vuex";
import Navbar from "@/js/components/Navbar";
import OrdersFilter from "@/js/components/OrdersFilter";
import { getOrdersAsync, deleteOrderAsync } from "@/js/api.js";
import UtilsMixin from "@/js/UtilsMixin.js";
import OrderStateChanger from "@/js/components/OrderStateChanger";
import Modal from "@/js/components/Modal";
import OrderDetails from "@/js/components/OrderDetails";
export default {
  mixins: [UtilsMixin],
  data() {
    return {
      orders: [],
      orderPossibleState: null, // currently selected state
      showOrderStateChangerModal: false,
      orderChangingState: null, // the order selected to change the state for
      showOrderDetailsModal: false,
      orderShowingDetails: null, // the order currently showing details of
      filterPayload: null // the filtering payload as received from OrderFilter component
    };
  },
  created() {
    if (!this.user) {
      this.$router.push("/login");
    }
  },
  components: {
    Navbar,
    OrdersFilter,
    OrderStateChanger,
    OrderDetails,
    Modal
  },
  methods: {
    loginPressed() {
      login(this.username, this.password).then(response => {
        if (response.body.access_token) {
          localStorage.setItem("access_token", response.body.access_token);
          getAuthenticatedUser().then(response => {
            this.$store.dispatch("auth/setUser", { user: response.body });
          });
        } else {
          alert("اسم المستخدم أو كلمة السر غير صحيح");
        }
      });
    },
    filterChanged(payload) {
      this.orderPossibleState = payload.orderPossibleState;
      getOrdersAsync(payload).then(response => {
        this.filterPayload = payload;
        if (response.body.orders) {
          this.orders = response.body.orders;
        }
      });
    },
    changeStatePressed(order) {
      this.orderChangingState = order;
      this.showOrderStateChangerModal = true;
    },
    viewPressed(order) {
      this.orderShowingDetails = order;
      this.showOrderDetailsModal = true;
    },
    editPressed(order) {
      this.$router.push("/orders/" + order.id + "/edit");
    },
    deletePressed(order) {
      let isSure = confirm("هل أنت متأكد من أنك تريد حذف الطلبية إلى الأبد؟");
      if (isSure) {
        deleteOrderAsync(order.id).then(response => {
          if (response.body.result == "success") {
            alert("تم الحذف بنجاح");
            getOrdersAsync(this.filterPayload).then(response => {
              if (response.body.orders) {
                this.orders = response.body.orders;
              }
            });
          }
        });
      }
    },
    createOrderPressed() {
      this.$router.push("/orders/create");
    }
  },
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  }
};
</script>