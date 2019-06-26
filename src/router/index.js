import Vue from 'vue';
import VueRouter from 'vue-router';
import main from '../components/pages/main'
import SignIn from '../components/pages/SignIn'
import registration from '../components/pages/registration'
import NotFoundComponent from '../components/pages/NotFoundComponent'
import Music from '../components/pages/Music'
Vue.use(VueRouter);

const routes =[
    {
      path: '/',
      name: 'home',
      component: main
    },
    {
        path: '/sign-in',
        name: 'SignIn',
        component: SignIn
    },
    {
        path: '/registration',
        name: 'registration',
        component: registration
    },
    {
        path: '/music',
        name: 'Music',
        component: Music
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

