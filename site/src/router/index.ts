import { createRouter, createWebHistory } from 'vue-router'
// @ts-ignore
import AddDogForm from "@/views/AddDogForm.vue";
// @ts-ignore
import ListDogs from "@/views/ListDogs.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/dogsList',
      name: 'dogsList',
      component: ListDogs
    },
    {
      path: '/addDog',
      name: 'addDogForm',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: AddDogForm
    }
  ]
})

export default router
