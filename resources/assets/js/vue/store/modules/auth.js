import auth from '../../../api/auth'

export default {
    state: {
        login: false,
        user: null,
        token: null
    },
    actions: {
        auth({ state, getters, dispatch }, payload) {
            return new Promise((resolve, reject) => {
                auth.auth(payload).then(response => {
                    //Call to set auth values
                    dispatch('setAuth', { user: response.user, token: response.token['access_token'] })
                    //Store auth values
                    dispatch('storeAuth')
                    resolve()
                }).catch(error => reject(error))
            })
        },
        setAuth({ state, getters }, payload) {
            state.login = true
            state.user = payload.user
            state.token = payload.token

            //Setting the Echo header to include token needed when listening on private channels
            Echo.connector.options.auth.headers['Authorization'] = 'Bearer ' + getters.getToken

            //Setting axios default header to include token for any future requests
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + getters.getToken
        },
        storeAuth({ state, dispatch }) {
            //Store auth values in local storage
            dispatch('writeLocalStorage', { auth: { user: state.user, token: state.token } })
        },
        logout({ state, dispatch }) {
            dispatch('removeLocalStorage', 'auth')
            state.login = false
            state.user = null
            state.token = null
        },
        socialAuth({ state, dispatch }, routeQuery) {
            if(!routeQuery.driver) { return }
            return new Promise((resolve, reject) => {
                auth.socialAuth({ url: routeQuery.driver + '/callback?code=' + routeQuery.code }).then(response => {
                    //Call to set auth values
                    dispatch('setAuth', { user: response.user, token: response.token })
                    //Store auth values
                    dispatch('storeAuth')
                    resolve()
                }).catch(error => reject(error))
            })
        }
    },
    getters: {
        isAuth: state => {
            return state.login
        },
        getUser: state => {
            return state.login ? state.user : null
        },
        getToken: state => {
            return state.login ? state.token : null
        }
    }
}
