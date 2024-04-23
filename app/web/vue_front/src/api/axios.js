import axios from 'axios'
import {getItem} from '@/helpers/persistanceStorage'
import apiConfig from '../config/config.json'

axios.defaults.baseURL = apiConfig.apiHost
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

axios.interceptors.request.use(config => {
    const token = getItem('accessToken')
    const authorizisationToken = token ? `Bearer ${token}` : ''
    config.headers.Authorization = authorizisationToken
    return config
})


export default axios
