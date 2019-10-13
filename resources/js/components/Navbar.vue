<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarTogglerDemo03"
      aria-controls="navbarTogglerDemo03"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Colis</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">الطلبيات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">المنتجات</a>
        </li>
      </ul>
      <form v-if="user" class="form-inline my-2 my-lg-0">
        <span style="margin-right: 8px;">{{user.name}}</span>
        <button
          @click="logout"
          class="btn btn-outline-danger my-2 my-sm-0"
          type="submit"
        >تسجيل الخروج</button>
      </form>
      <div v-else>
          أهلا بك
      </div>
    </div>
  </nav>
</template>
<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  },
  methods: {
    logout() {
      localStorage.removeItem("access_token");
      this.$store.dispatch("auth/setUser", { user: null });
      this.$router.push("/login");
    }
  }
};
</script>