import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginVue.vue'
import ForgotPasswordView from '@/views/ForgotPasswordView.vue'
import ResetPasswordView from '@/views/ResetPasswordView.vue'

import Cookies from 'js-cookie'
const cookieApi = import.meta.env.VITE_API_COOKIE_NAME;

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: '/register', name: 'register',component: RegisterView },
    { path: '/login', name: 'login', component: LoginView },
    { path: '/forgot-password', name: 'forgotPassword',component: ForgotPasswordView },
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
