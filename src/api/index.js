import {API_URL} from "../constants";
import axios from "axios/index";
export default {
    login(email, password, callback) {
        axios.post(API_URL + 'authorization', {
            email: email,
            password: password,
        }).then(function (data) {
            callback(data);
        });
    },

    getPlaylist(params, callback) {
        axios.get(`${API_URL}getPlaylist?size=${params.size}`)
            .then(function (data) {
            callback(data);
        });
    },
    getTrack(src, callback) {
        axios.get(src,{
            responseType: 'arraybuffer'
        }).then(function (data) {
            callback(data);
        });
    },
    uploadTracks(data, callback) {
        axios.post(API_URL + 'uploadTracks', data, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },

            onUploadProgress: (progressEvent) => {
                let progress;
                const {loaded, total} = progressEvent;
                progress = (loaded * 100) / total;
                console.log(progress);
            }
        }).then(function (response) {
            callback(response);
        });
    }
}
