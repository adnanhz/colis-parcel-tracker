<template>
  <div class="container">
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <div class="card" style="margin-top: 50px">
          <h5 class="card-header">تسجيل الدخول</h5>
          <div class="card-body">
            <div class="card-text">
              <div class="row">
                <div class="col-12 mb-5">
                  <input
                    v-model="username"
                    type="text"
                    placeholder="اسم المستخدم"
                    class="form-control"
                  />
                </div>
                <div class="col-12 mb-5">
                  <input
                    v-model="password"
                    type="password"
                    placeholder="كلمة السر"
                    class="form-control"
                  />
                </div>
                <div class="col-12 mb-5">
                  <button @click="loginPressed" class="btn btn-primary btn-fluid">تسجيل الدخول</button>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    if (this.user) {
      this.$router.push("/orders");
    }
  },
  methods: {
    loginPressed() {
      login(this.username, this.password).then(response => {
        if (response.body.access_token) {
          localStorage.setItem("access_token", response.body.access_token);
          getAuthenticatedUser().then(response => {
            this.$store.dispatch("auth/setUser", { user: response.body });
            this.$router.push("/orders");
          });
        } else {
          alert("اسم المستخدم أو كلمة السر غير صحيح");
        }
      })
      .catch(response => {
          alert("اسم المستخدم أو كلمة السر غير صحيح");
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