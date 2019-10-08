import Vue from 'vue';

const API_URL = "http://localhost:8000/api";
const OAUTH_URL = "http://localhost:8000/oauth"

export function login(username, password) {
    const payload = {};
    payload.grant_type = "password";
    console.log(process.env);
    payload.client_id = window.laravel.CLIENT_ID;
    payload.client_secret = window.laravel.CLIENT_SECRET;
    payload.username = username;
    payload.password = password;
    return Vue.http.post(OAUTH_URL + '/token', payload);
}

export function getAuthenticatedUser(){
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/user');   
}