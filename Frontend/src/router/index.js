import { createRouter, createWebHistory } from 'vue-router'
import vacancies from "@/views/Vacancies/index.vue";
import Vacancy from '@/views/Vacancies/show.vue';
import settings from '@/views/Settings.vue';
import LoginVue from '@/views/Users/Login.vue';
import registerVue from '@/views/Users/Register.vue';
import FirstVue from '@/views/Vacancies/Create/First.vue';
import SecondVue from '@/views/Vacancies/Create/Second.vue';
import ThirdVue from '@/views/Vacancies/Create/Third.vue';
import HomeViewVue from '@/views/HomeView.vue';
import ApplyVue from '@/views/Apply.vue';
import { useAuthStore } from '../Stores/Auth';
import ApplicantVue from '@/components/Multi-Step/Vacancy/Show/Applicant.vue';
import indexVue from '@/views/Shortlist/index.vue';
import showVue from '@/views/Shortlist/show.vue';
import CreateVue from '@/views/Vacancies/Create.vue';
import Show from '@/views/Resumes/Show.vue';

function auth(to, from) {
    const auth = useAuthStore();
    if (!localStorage.getItem('authToken')) {
        return "/sign-in";
    }
}

function guest(to, from) {
    const auth = useAuthStore();
    if (localStorage.getItem('authToken')) {
        return "/";
    }
}

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      beforeEnter: auth,
      component: HomeViewVue
    },
    {
      path: '/vacancies',
      name: 'Vacancy index',
      component: vacancies
    },
    {
      path: '/vacancies/:id',
      name: 'Vacancy Show',
      beforeEnter: auth,
      component: Vacancy
    },
    {
      path: '/vacancy/create',
      name: 'Vacancy Create',
      beforeEnter: auth,
      component: CreateVue
    },
    {
      path: '/vacancy/skills/create',
      name: 'Vacancy Skills Create',
      beforeEnter: auth,
      component: SecondVue
    },
    {
      path: '/vacancy/duties/create',
      name: 'Vacancy duties Create',
      beforeEnter: auth,
      component: ThirdVue
    },
    {
      path: '/settings',
      name: 'Seeker Settings',
      beforeEnter: auth,
      component: settings,
    },
    {
      path: '/sign-up',
      name: 'User Register',
      beforeEnter: guest,
      component: registerVue
    },
    {
      path: '/sign-in',
      name: 'User Login',
      beforeEnter: guest,
      component: LoginVue,
    },
    {
      path: '/apply/:id',
      name: 'Vacancy Apply',
      beforeEnter: auth,
      component: ApplyVue,
    },
    {
      path: '/shortlist',
      name: 'Vacancy Shortlist',
      beforeEnter: auth,
      component: indexVue,
    },
    {
      path: '/shortlist/:id',
      name: 'Vacancy Shortlist Applicants',
      beforeEnter: auth,
      component: showVue,
    },
    {
      path: '/resume',
      name: 'Seeker Resume',
      beforeEnter: auth,
      component: Show,
    },
    
  ]
})

export default router
