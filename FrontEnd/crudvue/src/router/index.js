import { createRouter, createWebHistory } from 'vue-router'
import editar from '../components/editar.vue'
import listar from '../components/listar.vue'
import HotelLogin from '../components/login.vue'
import MenuHotel from '@/components/MenuHotel.vue' 
import HabitacionesHotel from '../components/HabitacionesHotel.vue'
import contacto from '../components/contacto.vue'
import MuestraHabitaciones from '@/components/MuestraHabitaciones.vue'  


const routes = [
{
path: '/Habitaciones',
name: 'MuestraHabitaciones',
component: MuestraHabitaciones
},
{
  path: '/contacto',
  name: 'contacto', 
  component: contacto
},
  {
    path: '/Reservar',
    name: 'HabitacionesHotel',
    component: HabitacionesHotel
  },
   {
    path: '/menu',
    name: 'menu',
    component: MenuHotel
  },
  {
    path: '/',
    redirect: '/menu'
  },
  {
    path: '/login',
    name: 'login',
    component: HotelLogin
  },
  
  {
    path: '/editar/:id',
    name: 'editar',
    component: editar
  },
  {
    path: '/listar',
    name: 'listar',
    component: listar
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
