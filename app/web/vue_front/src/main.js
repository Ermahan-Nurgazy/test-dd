import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import './style.css'

let defData = {};
defData.state = {};
defData.state.userInterface = true;

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {

    if (localStorage.getItem('type')) {
      store.commit('setUserType', localStorage.getItem('type'));
    }

    if (localStorage.getItem('accessToken')) {
      store.commit('setUserInterface', defData);
      next()
    } else {
      next({ path: '/' })
    }
  } else if (to.matched.some(record => record.meta.logout)) {
    // Remove bearer token from localStorage
    localStorage.clear();
    store.commit('unSetUserInterface')
    next({
      path: '/'
    })
  } else {
    next()
  }

})

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
