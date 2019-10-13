<template>
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 style="text-decoration: underline">تعديل طلبية</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <input v-model="customId" placeholder="رقم الطلبية" class="form-control" />
      </div>
      <div class="col-12" style="margin-top: 8px;">
        <select v-model="productId" class="form-control">
          <option v-for="product in products" :key="product.id" :value="product.id">
            {{product.name}}
          </option>
        </select>
      </div>
      <div class="col-12" style="margin-top: 8px;">
        <input v-model="quantity" placeholder="الكمية" class="form-control" type="number" />
      </div>     
      <div class="col-12" style="margin-top: 8px;">
        <input v-model="clientName" placeholder="اسم الزبون" class="form-control" type="text" />
      </div>          
      <div class="col-12" style="margin-top: 8px;">
        <input v-model="clientPhone" placeholder="هاتف الزبون" class="form-control" type="text" />
      </div> 
      <div class="col-12" style="margin-top: 8px;">
        <input v-model="clientAddress" placeholder="عنوان الزبون" class="form-control" type="text" />
      </div> 
      <div class="col-12" style="margin-top: 8px;">
        <input v-model="additionalInfo" placeholder="معلومات إضافية" class="form-control" type="text" />
      </div>             
       <div class="col-12" style="margin-top: 8px;">
        <button @click="savePressed" class="btn btn-block btn-primary">
          تأكيد
        </button>
      </div>                             
    </div>
  </div>
</template>

<script>
import { getProductsAsync, updateOrderAsync, getOrderAsync } from '@/js/api.js';
export default {
  data() {
    return {
      products: [],
      customId: '',
      clientName: '',
      clientPhone: '',
      clientAddress: '',
      additionalInfo: '',
      productId: null,
      quantity: 1
    }
  },
  created() {
    getOrderAsync(this.$route.params.id).then(response => {
      if(response.body.order) {
        let order = response.body.order;
        this.customId = order.custom_id;
        this.clientName = order.client_name;
        this.clientPhone = order.client_phone;
        this.clientAddress = order.client_address;
        this.additionalInfo = order.additional_info;
        this.productId = order.products[0].id;
        this.quantity = order.products[0].pivot.quantity;
      }
    })
    getProductsAsync().then(response => {
      if(response.body.products) {
        this.products = response.body.products;
      }
    })
  },
  methods: {
    savePressed() {
      updateOrderAsync({
        id: this.$route.params.id,
        customId: this.customId,
        clientName: this.clientName,
        clientPhone: this.clientPhone,
        clientAddress: this.clientAddress,
        additionalInfo: this.additionalInfo,
        productId: this.productId,
        quantity: this.quantity
      }).then(response => {
        if(response.body.result == 'success') {
          alert("تم تعديل الطلبية");
          this.$router.back();
        }
      })
    }
  }
};
</script>
<style>
</style>