<template>
  <div id="app">
    <transition name="slide-fade" mode="out-in">
      <router-view></router-view>
    </transition>
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
