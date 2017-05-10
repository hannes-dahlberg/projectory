//Import libraries
import _ from 'lodash'
import Vue from 'vue'
import axios from 'axios'
import Echo from 'laravel-echo'
import bootstrapSass from 'bootstrap-sass'
import selectize from 'selectize'
import Nodehelpers from 'nodehelpers'

//Setting to window
window.Vue = Vue
window.axios = axios

//Setting default headers for axios
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': $('meta[name=\'csrf-token\']').attr('content'),
    'X-Requested-With': 'XMLHttpRequest'
};

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'socketio.app:6001'
})