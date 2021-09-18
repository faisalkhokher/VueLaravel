import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import profile from './components/Profile.vue';
import users from './components/Users.vue';
import dashboard from './components/Dashboard.vue';
import vblog from './components/blog.vue';

//  Routes
let routes = [
  
    {
      path: '/profile',
      component: profile , 
      name : profile
    },
    {
        path: '/users',
        name: 'users',
        component: users, 
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: dashboard , 
    },
    {
      path: '/blog',
      name: 'blog',
      component: vblog
    }
  ]

   export default new VueRouter({
     mode: 'history',
     routes
   });

