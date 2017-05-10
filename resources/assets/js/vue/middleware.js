import store from './store/index'

export default {
    //Redirect to 404 page if route is not defined
    invalidRoute(to, from, next) {
        if(to.name) {
            next()
        } else {
            next({ name: 'error.404' })
        }
    },
    //Middleware for authenticated users
    auth(to, from, next) {
        //Users not authenticated will be redirected to 404
        next(!store.getters.isAuth ? { name: 'error.404' } : undefined);
    },
    guest(to, from, next) {
        //Users authenticated will be redirected to 404
        next(store.getters.isAuth ? { name: 'error.404' } : undefined);
    },
    //Check for auth in local storage
    checkAuth(to, from, next) {
        //If user is not logged in
        if(!store.getters.isAuth) {
            //Check local storage for auth data (containing user info and token)
            var auth = store.getters.readLocalStorage('auth')
            if(auth) { //If found set store to values
                store.dispatch('setAuth', auth)
            }
        }

        //Continue with request
        next()
    }
}