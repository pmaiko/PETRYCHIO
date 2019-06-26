<template>
    <div class="login player-styles">
        <div class="login_wrap">
            <h1 style="text-align: center">Aвторизация</h1>
            <div name="person">
                <label for="login">Login</label>
                <input type="text" placeholder="admin" id="login" v-model="email">
                <label for="password">Password</label>
                <input type="password" placeholder="admin" id="password" v-model="password">
                <div class="login_buttons">
                    <button type="submit" @click="auth">Login</button>
                </div>
                <router-link to="/registration">REG</router-link>
            </div>
        </div>
        <div class="login_logo">
            <h2>IMMORTAL</h2><span>MP3</span><h2>player</h2>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
            };
        },
        methods: {
            auth () {
                this.$store.dispatch('login', {
                    email: this.email,
                    password: this.password,
                    success: () => {
                        this.$router.push({
                            path: '/music',
                        });
                    },
                    error: () => {
                    },
                });
            },
        },
        mounted() {
            if (this.logged) {
                this.$router.push({
                    path: '/music',
                });
            }
        },

        computed: {
            logged() {
                return this.$store.state.logged;
            }
        }



    }
</script>
