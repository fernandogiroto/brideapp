import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import PageView from '@/views/PageView.vue'

import VisaStudentView from '@/views/visa/VisaStudentView.vue'

import LoginView from '@/views/LoginVue.vue'
import ResetPasswordView from '@/views/ResetPasswordView.vue'

import Cookies from 'js-cookie'
const cookieApi = import.meta.env.VITE_API_COOKIE_NAME;

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: '/page', name: 'page', component: PageView },
    { path: '/visa-student', name: 'visaStudent', component: VisaStudentView },
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
