import Vuex from 'vuex'
import Vue from 'vue'
import auth from './modules/auth'
import VuexPersistence from 'vuex-persist'
const debug = process.env.NODE_ENV !== 'production'

Vue.use(Vuex);
const vuexLocal = new VuexPersistence({
  storage: window.localStorage
})
export default new Vuex.Store({
  modules: {
    auth
  },
  strict: debug,
  plugins: [vuexLocal.plugin]
})