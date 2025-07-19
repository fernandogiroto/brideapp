
import router from '@/router'
import axiosInstance from '@/services/api'
import Cookies from 'js-cookie'
const cookieApi = import.meta.env.VITE_API_COOKIE_NAME;

const login = async (email:string,password:string) => {
    try {
        const response = await axiosInstance.post('/login', {
            email: email,
            password: password,
        })
        Cookies.set(cookieApi, response.data.data.token, {
            sameSite: 'Lax',
            path: '/',
            secure: true,
        })
        router.push({ name: 'home' })
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    } catch (error: any) {
        if (error.response?.data?.errors) {
        console.error('Login failed:', error.response.data.errors)
        } else {
        console.error('Login failed:', error)
        }
    }
}

const logout = async () => {
    try {
        await axiosInstance.post('/v1/logout')
        Cookies.remove(cookieApi)
        router.push({ name: 'login' })
    } catch (error: unknown) {
        if (error instanceof Error) {
        console.error('Error fetching test data:', error.message)
        } else {
        console.error('Unknown error:', error)
        }
    }
}

export { login, logout };
