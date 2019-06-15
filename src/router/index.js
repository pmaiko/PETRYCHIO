import Vue from 'vue';
import VueRouter from 'vue-router';
import main from '../components/pages/main'
import login from '../components/pages/login'
import registration from '../components/pages/registration'
import NotFoundComponent from '../components/pages/NotFoundComponent'
import music from '../components/pages/music'
Vue.use(VueRouter);

const routes =[
    {
      path: '/',
      name: 'home',
      component: main
    },
    {
        path: '/login',
        name: 'login',
        component: login
    },
    {
        path: '/registration',
        name: 'registration',
        component: registration
    },
    {
        path: '/music',
        name: 'music',
        component: music
    },

    {
        path: '*',
        name: 'NotFoundComponent',
        component: NotFoundComponent
    },

];

const router = new VueRouter ({
    routes,
    mode: 'history',
});

export default router;

