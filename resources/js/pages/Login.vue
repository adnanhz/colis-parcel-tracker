<template>
  <div class="container">
    <h1>تسجيل الدخول</h1>
    <div class="row">
      <div class="col-12 mb-5">
        <input v-model="username" type="text" placeholder="اسم المستخدم" class="form-control" />
      </div>
      <div class="col-12 mb-5">
        <input v-model="password" type="password" placeholder="كلمة السر" class="form-control" />
      </div>
      <div class="col-12 mb-5">
        <button @click="loginPressed" class="btn btn-primary btn-fluid">تسجيل الدخول</button>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import { login, getAuthenticatedUser } from "../api.js";
export default {
  data() {
    return {
      username: "",
      password: ""
    };
  },
  created() {
      if(this.user) {
          this.$router.push("/dashboard");
      }
  },
  methods: {
    loginPressed() {
        login(this.username, this.password)
        .then(response => {
            if(response.body.access_token) {
                localStorage.setItem("access_token", response.body.access_token);
                getAuthenticatedUser()
                .then(response => {
                    this.$store.dispatch("auth/setUser", { user: response.body });
                })
                
            } else {
                alert("اسم المستخدم أو كلمة السر غير صحيح");
            }
        });
    }
  },
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  }
};
</script>