<template>
    <div class="login player-styles">
        <div class="login_wrap">
            <h1 style="text-align: center">#Autorisation</h1>
            <div name="person">
                <label for="login">Login</label>
                <input type="text" placeholder="admin" id="login" v-model="auth.login">
                <label for="password">Password</label>
                <input type="password" placeholder="admin" id="password" v-model="auth.password">
                <div class="login_buttons">
                    <button type="submit" @click="postForm">Login</button>
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
                auth: {
                    login: '',
                    password: '',
                }
            };
        },
        methods: {
           postForm() {
                this.$store.dispatch('login', this.auth);
            }
        },

        computed: {
            fun() {
                if (this.$store.state.authUser[0] === 'userLoginEd') {
                    console.log('lox');
                    this.$cookie.set('login', this.$store.state.authUser[1], 100);
                    this.$cookie.set('password', this.$store.state.authUser[2], 100);
                    this.$cookie.set('user_id', this.$store.state.authUser[3], 100);
                    this.$router.push('/player');
                }
            }
        },

        watch: {
            fun() {

            }
        },



    }
</script>
