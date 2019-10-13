<template>
  <div class="container">
    <h1></h1>
  </div>
</template>
<script>
import { mapState } from "vuex";
import { login, getAuthenticatedUser } from "../api.js";
import Navbar from "@/js/components/Navbar";
export default {
  data() {
    return {
      username: "",
      password: ""
    };
  },
  created() {
      if(!this.user) {
          this.$router.push("/login");
      }
  },
  components: {
    Navbar
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