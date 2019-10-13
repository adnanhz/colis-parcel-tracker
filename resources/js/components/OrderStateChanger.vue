<template>
  <div class="container" v-if="order">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 style="text-decoration: underline">تغيير حالة الطلبية</h1>
      </div>        
      <div class="col-12 d-flex justify-content-center">
        <h2 style="text-decoration: underline">رقم {{order.id}}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center" style="margin-top: 8px">
        الحالة الحالية:
        <input class="form-control" type="text" disabled :value="order.currentState.title" />
      </div>

      <div class="col-12 d-flex justify-content-center" style="margin-top: 8px">
        الحالة الجديدة:
        <select class="form-control" v-model="newState">
          <option
            v-for="state in orderPossibleStates"
            :key="state.id"
            :value="state"
          >{{state.title}}</option>
        </select>
      </div>
      <div class="col-12 d-flex justify-content-center" style="margin-top: 8px">
        <button @click="savePressed" class="btn btn-block btn-primary">تأكيد</button>
      </div>
    </div>
  </div>
</template>

<script>
import { updateOrderAsync, getOrderPossibleStatesAsync } from "@/js/api.js";
export default {
  props: ["order"],
  data() {
    return {
      orderPossibleStates: [],
      newState: null
    };
  },
  created() {
    getOrderPossibleStatesAsync().then(response => {
      if (response.body.orderPossibleStates) {
        this.orderPossibleStates = response.body.orderPossibleStates;
      }
    });
  },
  methods: {
    savePressed() {
      const payload = {};
      payload.id = this.order.id;
      payload.clientName = this.order.client_name;
      payload.clientPhone = this.order.client_phone;
      payload.clientAddress = this.order.client_address;
      payload.additionalInfo = this.order.additional_info;
      payload.productId = this.order.products[0].id;
      payload.quantity = this.order.products[0].pivot.quantity;
      payload.customId = this.order.custom_id;
      payload.stateId = this.newState.id
      updateOrderAsync(payload).then(response => {
        if (response.body.result == "success") {
          alert("تمت العملية بنجاح");
        }
      });
    }
  }
};
</script>

<style>
</style>