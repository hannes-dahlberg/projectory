export default {
    auth(payload) {
        return new Promise((resolve, reject) => {
            axios.post('/api/auth', { username: payload.username, password: payload.password }).then(response => {
                resolve(response.data)
            }).catch(error => reject(error))
        })
    },
    socialAuth(payload) {
        return new Promise((resolve, reject) => {
            axios.get('/api/auth/' + payload.url).then(response => {
                resolve(response.data)
            }).catch(error => reject(error))
        })
    }
}
