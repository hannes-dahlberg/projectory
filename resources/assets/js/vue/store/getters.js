export default {
    //Get the loading state of the app
    isAppLoading: (state) => {
        return state.appLoading
    },
    getMenu: (state, getters) => {
        return state.menu.concat(getters.isAuth ? state.authMenu : state.guestMenu)
    },
    //Read from local storage
    readLocalStorage: () => (key) => {
        return JSON.parse(localStorage.getItem(key))
    }
}