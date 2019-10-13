<template>
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 style="text-decoration: underline">طلبية جديدة</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <input v-model="customId" placeholder="رقم الطلبية" class="form-control" />
      </div>
      <div class="col-12" style="margin-top: 8px;">
        <select v-model="product" class="form-control">
          <option v-for="product in products" :key="product.id" :value="product">
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
        <button @click="createOrderPressed" class="btn btn-block btn-primary">
          تأكيد
        </button>
      </div>                             
    </div>
  </div>
</template>

<script>
import { getProductsAsync, createOrderAsync } from '@/js/api.js';
export default {
  data() {
    return {
      products: [],
      customId: '',
      clientName: '',
      clientPhone: '',
      clientAddress: '',
      additionalInfo: '',
      product: null,
      quantity: 1
    }
  },
  created() {
    getProductsAsync().then(response => {
      if(response.body.products) {
        this.products = response.body.products;
      }
    })
  },
  methods: {
    createOrderPressed() {
      createOrderAsync({
        customId: this.customId,
        clientName: this.clientName,
        clientPhone: this.clientPhone,
        clientAddress: this.clientAddress,
        additionalInfo: this.additionalInfo,
        productId: this.product.id,
        quantity: this.quantity
      }).then(response => {
        if(response.body.result == 'success') {
          alert("تم إنشاء الطلبية");
          this.$router.push("/orders");
        }
      })
    }
  }
};
</script>
<style>
</style>