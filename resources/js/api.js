import Vue from 'vue';

const API_URL = window.laravel.HOST + "/api";
const OAUTH_URL = window.laravel.HOST + "/oauth"

export function loginAsync(username, password) {
    const payload = {};
    payload.grant_type = "password";
    console.log(process.env);
    payload.client_id = window.laravel.CLIENT_ID;
    payload.client_secret = window.laravel.CLIENT_SECRET;
    payload.username = username;
    payload.password = password;
    return Vue.http.post(OAUTH_URL + '/token', payload);
}

export function getAuthenticatedUserAsync() {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/user');
}

export function getOrderPossibleStatesAsync() {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/order-possible-states');
}

export function getOrdersAsync({ startDate, endDate, clientName, clientPhone, customId, stateId }) {
    const filterData = {};
    if (startDate) { filterData.startDate = startDate }
    if (endDate) { filterData.endDate = endDate }
    if (clientName) { filterData.clientName = clientName }
    if (clientPhone) { filterData.clientPhone = clientPhone }
    if (customId) { filterData.customId = customId }
    if (stateId) { filterData.stateId = stateId }
    const queryString = encodeQueryData(filterData);
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/orders?' + queryString);
}

export function createOrderAsync({ clientName, clientPhone, clientAddress, additionalInfo, productId, quantity, customId }) {
    const data = { clientName, clientPhone, clientAddress, additionalInfo, productId, quantity, customId };
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.put(API_URL + '/orders', data);

}

export function updateOrderAsync({ id, clientName, clientPhone, clientAddress, additionalInfo, productId, quantity, customId, stateId }) {
    const data = { clientName, clientPhone, clientAddress, additionalInfo, productId, quantity, customId, stateId };
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.post(API_URL + '/orders/' + id, data);

}

export function deleteOrderAsync(id) {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.delete(API_URL + '/orders/' + id);

}

export function getOrderAsync(id) {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/orders/' + id);
}

export function getUsersAsync() {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/users');
}

export function getProductsAsync() {
    Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem("access_token");
    return Vue.http.get(API_URL + '/products');
}

function encodeQueryData(data) {
    const ret = [];
    for (let d in data)
        ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
    return ret.join('&');
}