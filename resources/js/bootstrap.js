import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery';
window.jQuery = window.$ = $;

import select2 from 'select2';
select2();

import flatpickr from "flatpickr";
