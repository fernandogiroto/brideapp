import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import Page01View from '@/views/Page01View.vue'
import Page02View from '@/views/Page02View.vue'
import Page03View from '@/views/Page03View.vue'
import Page04View from '@/views/Page04View.vue'
import LoginView from '@/views/LoginVue.vue'
import ResetPasswordView from '@/views/ResetPasswordView.vue'

import Cookies from 'js-cookie'
const cookieApi = import.meta.env.VITE_API_COOKIE_NAME;

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: '/page1', name: 'page1', component: Page01View },
    { path: '/page2', name: 'page2', component: Page02View },
    { path: '/page3', name: 'page3', component: Page03View },
    { path: '/page4', name: 'page4', component: Page04View },
    { path: '/login', name: 'login', component: LoginView },
    { path: '/reset-password', name: 'resetPassword', component: ResetPasswordView},
  ],
})

router.beforeEach((to, from, next) => {
  if (to.meta.permission === 'AUTH') {
    if (Cookies.get(cookieApi)) {
      next()
    } else {
      next('/login')
    }
  } else {
    next()
  }
})

export default router
