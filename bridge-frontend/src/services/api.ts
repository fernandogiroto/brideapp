import axios from 'axios'
import Cookies from 'js-cookie'
import router from '@/router'
const cookieApi = import.meta.env.VITE_API_COOKIE_NAME;

const axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
  withCredentials: true,
})

// GET TOKEN
axiosInstance.interceptors.request.use(
  (config) => {
    let token = document.cookie.split(';').find((index) => {
      return index.startsWith(`${cookieApi}=`)
    })
    token = token?.split('=')[1]
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  },
)
// ERROR TOKEN
axiosInstance.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      Cookies.remove(cookieApi)
      console.error('Unauthorized access. Please log in again.')
      router.push('/login')
    }

    if (error.response && error.response.status === 404) {
      console.error(error.response.data.message)
    }
    return Promise.reject(error)
  },
)

export default axiosInstance
