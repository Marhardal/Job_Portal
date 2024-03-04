import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authToken: null,
        authRole: null
    }),

    getters: {
        User: (state) => state.authUser,
    },

    actions: {
        async getToken() {
            await axios.get(`http://127.0.0.1:8000/sanctum/csrf-cookie/`);
        },

        async getUser() {
            await this.getToken();
            this.authToken = localStorage.getItem('authToken');
            const response = await axios.get(`http://127.0.0.1:8000/api/user/`, {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            });
            this.authRole = response.data.role;
            this.authUser = response.data.user;
        },

        async Login(data){
            await this.getToken();
            try{
                const response = await axios.post(`http://127.0.0.1:8000/api/sign-in`, data)
                this.authUser = response.data.user;
                this.authToken = response.data.token;
                localStorage.setItem('authToken', this.authToken);
                this.router.push('/')
            }
            catch(error){
                console.log("Failed to login user.", error);
            }
        },

        async Register(data){
            await this.getToken();
            try{
                const response = await axios.post("http://127.0.0.1:8000/api/users", data)
                this.authUser = response.data.user;
                this.authToken = response.data.token;
                localStorage.setItem('authToken', this.authToken);
                this.router.push('/')
            }
            catch(error){
                console.log("Failed to register new user.", error);
            };
        },

        async Logout(){
            await this.getToken();
            try {
                this.authToken = localStorage.getItem('authToken');
                await axios.post("http://127.0.0.1:8000/api/sign-out", {
                    headers: {
                        Authorization : `Bearer ${this.authToken}`
                    }
                });
                localStorage.removeItem('authToken');
                $router.push('/sign-in')
            } catch (error) {
                console.log("Failed to Logout user.", error);
            }
        }
    },
});