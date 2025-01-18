import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "../views/LoginView.vue"
import RegView from '@/views/RegView.vue'
import ProfileView from '@/views/ProfileView.vue'
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  }
,
 {
    path: "/Log",
    name: "Login",
    component:LoginView
  },
  {
    path: "/Reg",
    name: "Register",
    component: RegView
  },
  {
    path: "/prof",
    name: "Profile",
    component: ProfileView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
