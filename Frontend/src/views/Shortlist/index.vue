<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import { ref } from 'vue';
import axios from 'axios';
import { onMounted } from 'vue';
import { useAuthStore } from '@/Stores/Auth';
import Shortlist from '@/components/Cards/Shortlist.vue';

const authStore = useAuthStore();

const shortlists = ref({});

const authToken = localStorage.getItem('authToken');

const getShortlists = async () => {
    authStore.getToken()
    const response = await axios.get("http://127.0.0.1:8000/api/shortlist", {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    shortlists.value = response.data.shortlisted;
    console.log(response.data);
}

onMounted(async => {
    authStore.getUser();
    getShortlists()
});
</script>
<template>
    <Base>
    <template v-slot:header>
        <Header title="Shortlist" />
    </template>
    <template v-slot:navigation>
        <Navigation />
    </template>
    <template v-slot:main>
        <div class="flex justify-center bg-gradient-to-t h-full p-6 bg-no-repeat bg-center w-full">
            <div class="w-full md:w-1/2 lg:w-full mx-auto">
                <Shortlist v-for="shortlist in shortlists" :shortlist="shortlist" />
            </div>
        </div>
    </template>
    </Base>
</template>
<style lang="scss" scoped></style>