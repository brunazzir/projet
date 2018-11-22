import Axios from 'axios';

const API_ENDPOINT = `http://127.0.0.1:3333/api`;

export default {
    /**
     * SignIn from API
     */
    SignIn(username, password){
      return Axios.post(`${API_ENDPOINT}/auth/login`, {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
            },
            email: username,
            password: password,
        })
    },

    SignUp(email, username, password) {
      return Axios.post(`${API_ENDPOINT}/auth/signup`, {
        method: 'post',
        headers: {
          'Content-Type': 'application/json',
        },
        email: email,
        username: username,
        password: password,
      })
    },

    LogOut() {
      return Axios.post(`${API_ENDPOINT}/auth/logout`, {
        method: 'post',
        headers: {
          'Content-Type': 'application/json',
        },
      })
    },

    CheckAuth(token) {
      return Axios.post(`${API_ENDPOINT}/auth/check`, {
        method: 'post',
        headers: {
          'Content-Type': 'application/json',
        },
      })
    },

}
