<template>
  <div class="card" style="direction: rtl; text-align: right;">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <label for="date-from">
            التاريخ من
            <input
              v-model="dateFrom"
              class="form-control"
              id="date-from"
              type="text"
              placeholder="YYYY-MM-DD"
            />
          </label>
        </div>
        <div class="col-md-4">
          <label for="date-to">
            التاريخ إلى
            <input
              v-model="dateTo"
              class="form-control"
              id="date-to"
              type="text"
              placeholder="YYYY-MM-DD"
            />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label for="client-name">
            اسم الزبون
            <input v-model="clientName" class="form-control" id="client-name" type="text" />
          </label>
        </div>
        <div class="col-md-4">
          <label for="phone-number">
            رقم الهاتف
            <input
              v-model="clientPhone"
              class="form-control"
              id="phone-number"
              type="text"
            />
          </label>
        </div>
        <div class="col-md-4">
          <label for="order-number">
            رقم الطلبية
            <input
              v-model="orderNumber"
              class="form-control"
              id="order-number"
              type="text"
            />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label for="order-state">
            الحالة
            <select v-model="orderPossibleState" id="order-state" class="form-control">
              <option
                v-for="state in orderPossibleStates"
                :key="state.id"
                :value="state"
              >{{state.title}}</option>
            </select>
          </label>
        </div>
        <div class="col-md-8 d-flex align-items-end">
          <button class="btn btn-primary" @click="filterPressed">تأكيد</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { getOrderPossibleStatesAsync } from "../api.js";

export default {
  data() {
    return {
      dateFrom: null,
      dateTo: null,
      clientName: null,
      clientPhone: null,
      orderNumber: null,
      orderPossibleState: null,
      orderPossibleStates: []
    };
  },
  created() {
    getOrderPossibleStatesAsync().then(response => {
      if (response.body.orderPossibleStates) {
        this.orderPossibleStates = response.body.orderPossibleStates;
        this.$emit("filterChange", {
          startDate: this.dateFrom,
          endDate: this.dateTo,
          clientName: this.clientName,
          clientPhone: this.clientPhone,
          customId: this.orderNumber,
          stateId: this.orderPossibleStates[0].id,
          orderPossibleState: this.orderPossibleStates[0]
        });
      }
    });
  },
  methods: {
    filterPressed() {
      this.$emit("filterChange", {
        startDate: this.dateFrom,
        endDate: this.dateTo,
        clientName: this.clientName,
        clientPhone: this.clientPhone,
        customId: this.orderNumber,
        stateId: this.orderPossibleState.id,
        orderPossibleState: this.orderPossibleState
      });
    }
  }
};
</script>

<style>
</style>