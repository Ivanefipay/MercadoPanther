import _ from 'lodash'
import * as bootstrap from 'bootstrap'
import axios from 'axios'
import swal from 'sweetalert2'


window._ = _
window.swal = swal
window.axios = axios
window.bootstrap = bootstrap
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const csrf_token = document.head.querySelector('meta[name="csrf-token"]')
if (csrf_token) {
	window.csrf_token = csrf_token.textContent
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token
}else console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')

