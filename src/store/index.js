import Vue from 'vue'
import Vuex from 'vuex'
import api from '../api'
Vue.use(Vuex);
import axios from 'axios'

const store = new Vuex.Store({
    state: {
        logged: false,
        token: null,
        userInfo: '' || JSON.parse(window.localStorage.getItem('userInfo')),
        playlist: [],
        total_tracks: '',
    },

    mutations: {
        set(state, {type, value}) {
            state[type] = value;
        },

        playlist(state, {params, counter, callback}) {
            if (params !== undefined && counter !== undefined) {
                api.getPlaylist(params, (json) => {
                    let playlist = json.data.playlist;
                    playlist[counter].active = 'active';
                    state.playlist = playlist;
                    state.total_tracks = json.data.total.total_tracks  - 1;
                    callback(json);
                });

            } else if(params !== undefined) {
                api.getPlaylist(params, function (json) {
                    state.playlist = json.data.playlist;
                    state.total_tracks = json.data.total.total_tracks  - 1;
                });

            } else if(counter !== undefined) {
                let playlist = state.playlist;
                playlist.map((item) => {
                    delete item.active;
                });
                playlist[counter].active = 'active';
                state.playlist = playlist;
            }
        },

    },
    actions: {
        login({commit}, data) {
           api.login(data.email, data.password, function (json) {
               if (json.status === 200) {
                   commit('set',{
                       type: 'token',
                       value: json.data.token
                   });
                   commit('set',{
                       type: 'userInfo',
                       value: json.data.userInfo
                   });
                   window.localStorage.setItem("token", json.data.token);
                   window.localStorage.setItem("userInfo", JSON.stringify(json.data.userInfo));
                   window.axios.defaults.headers.common['Authorization'] = json.data.token;
                   commit('set',{
                       type: 'logged',
                       value: true
                   });
                   data.success();
               }
           })
        },
        checkLogged({state}) {
            let token = window.localStorage.getItem('token');
            if (token !== null && token !== '' && token !== undefined) {
                axios.defaults.headers.common['Authorization'] = token;
                state.token = token;
                state.logged = true;
            }
            else {
                axios.defaults.headers.common['Authorization'] = '';
                state.token = null;
                state.logged = false;
            }
        },
        logout({state}) {
            window.localStorage.removeItem('token');
            window.axios.defaults.headers.common['Authorization'] = '';

            state.token = undefined;
            state.logged = false;
        },

        // selectPlaylist({commit}, data) {
        //     return axios({
        //         method: 'post',
        //         url: '/api/selectPlayList.php',
        //         data: {
        //             user_id: data.cookieID,
        //             limit: data.limitValue,
        //         }
        //     }).then(function (dataOutINServer) {
        //         console.log('nava');
        //         const result = dataOutINServer.data;
        //         commit('set', {type: 'playListUser', items: result});
        //     })
        // },
        //
        // selectPic({commit}, cookieID) {
        //     axios({
        //         method: 'post',
        //         url: '/api/selectPic.php',
        //         data: {
        //             user_id: cookieID,
        //         }
        //     }).then(function (dataOutINServer) {
        //         const result = dataOutINServer.data;
        //         commit('set', {type: 'randomCover', items: result});
        //     })
        // },
    }
});

export default store
