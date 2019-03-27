import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
import axios from 'axios'

const store = new Vuex.Store({
    state: {
        authUser: {},
        playListUser: '',
    },
    mutations: {
        mtLogin(state, {type, items}) {
            state[type] = items;
        },

        mtSelectList(state, {type, items}) {
            state[type] = items;
        }
    },
    actions: {
        login({commit}, auth) {
            axios({
                method: 'post',
                url: '/api/login.php',
                data: {
                    login: auth.login,
                    pass: auth.password,
                }
            }).then(function (dataOutINServer) {
                 const result = dataOutINServer.data;
                 commit('mtLogin', {type: 'authUser', items: result})
            })
        },

        selectPlaylist({commit}, cookieID) {
            axios({
                method: 'post',
                url: '/api/selectPlayList.php',
                data: {
                    user_id: cookieID,
                }
            }).then(function (dataOutINServer) {
                const result = dataOutINServer.data;
                commit('mtSelectList', {type: 'playListUser', items: result});
            })
        }
    }
});

export default store
