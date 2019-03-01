<template>
  <div id="app">
    <!--<link rel="stylesheet"-->
          <!--href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"-->
          <!--integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"-->
          <!--crossorigin="anonymous">-->
    <transition name="slide-fade" mode="out-in">
      <router-view></router-view>
    </transition>
    <!--{{this.$cookie.set('test', 'Hello world!', 1)-->
    <!--this.$cookie.get('test')}}-->
  </div>
</template>

<script>
export default {
  name: 'app',
  components: {
  },
  data() {
      return {
      }
  },

    beforeCreate() {
        function IsLoginUser() {}
        let isLoginUser = new IsLoginUser();

        isLoginUser = {
          login: this.$cookie.get('login'),
          password: this.$cookie.get('password'),
        };

        if (this.$cookie.get('login') !== null) {
            this.$router.push('/player');
            this.$store.dispatch('login', isLoginUser);
        }
    },
}
</script>
