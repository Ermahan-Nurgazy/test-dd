import axios from '@/api/axios'


const login = (credentials) => {
  return axios.post('/api/user/authorization', {user: credentials})
}

export default {
  login
}
