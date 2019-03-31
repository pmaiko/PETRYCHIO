import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
import axios from 'axios'

const store = new Vuex.Store({
    state: {
        authUser: {},
        playListUser: '',
        randomCover: '',
    },
    mutations: {
        mtLogin(state, {type, items}) {
            state[type] = items;
        },

        set(state, {type, items}) {
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
                commit('set', {type: 'playListUser', items: result});
            })
        },

        selectPic({commit}, cookieID) {
            axios({
                method: 'post',
                url: '/api/selectPic.php',
                data: {
                    user_id: cookieID,
                }
            }).then(function (dataOutINServer) {
                const result = dataOutINServer.data;
                commit('set', {type: 'randomCover', items: result});
            })
        },
    }
});

export default store
