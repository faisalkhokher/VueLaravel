import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import profile from './components/Profile.vue';
import users from './components/Users.vue';
import dashboard from './components/Dashboard.vue';
import vblog from './components/blog.vue';
import posting from './components/post.vue';
import editPost from './pages/EditPost.vue';
import Category from './components/category.vue';
import AddCategory from './pages/Addcategory.vue';
import chat from './pages/chat.vue';
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
    },
    {
      path: '/fetch/posts',
      name: 'post',
      component: posting
    },
    {
      path: '/edit/posts/:id',
      name: 'editPost',
      component: editPost
    },
    {
      path: '/categories',
      name: 'Category',
      component: Category
    },
    {
      path: '/category/addcategory',
      name: 'AddCategory',
      component: AddCategory
    },
    {
      path: '/chat',
      name: 'chat',
      component: chat
    },
  ]

   export default new VueRouter({
     mode: 'history',
     routes
   });

