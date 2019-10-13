<template>
  <div class="container" v-if="order">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 style="text-decoration: underline">معاينة الطلبية</h1>
      </div>        
      <div class="col-12 d-flex justify-content-center">
        <h2 style="text-decoration: underline">رقم {{order.id}}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12" style="margin-top: 8px">
        <p>وضع الطلبية: {{order.user_placed.name}}</p>
        <table class="table table-striped" style="direction: rtl">
          <thead>
            <tr>
              <th>الحالة</th>
              <th>التاريخ</th>
              <th>المستخدم</th>
            </tr>
            </thead>
            <tbody>
              <tr v-for="state in order.states" :key="state.id">
                <td>{{state.title}}</td>
                <td>{{utcToLocal(state.pivot.created_at).format("DD-MM-YYYY HH:mm a")}}</td>
                <td>{{getUser(state.pivot.user_id).name}}</td>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import UtilsMixin from "@/js/UtilsMixin";
import { getUsersAsync } from "@/js/api.js";
export default {
  mixins: [UtilsMixin],
  props: ["order"],
  data() {
    return {
      users: []
    }
  },
  created() {
    getUsersAsync().then(response => {
      if(response.body) {
        this.users = response.body;
      }
    })
  },
  methods: {
    getUser(userId) {
      if(!this.users.length) {
        return {name: "غير معروف"};
      }
      return this.users.find(u => u.id == userId);
    }
  }
};
</script>

<style>
</style>