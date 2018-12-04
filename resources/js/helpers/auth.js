export function login(credentials) {
    return new Promise((res, rej) => {
        return axios.post('/api/auth/login', credentials)
            .then((response) => {
                res(response.data);
            })
            .catch((err) => {
                rej("Wrong email or password");
            })
        })
}

export function logout() {
    axios.post('/api/auth/logout')
}

export function register(credentials) {
    return axios.post('/api/auth/signup', credentials)
        .then((response) => {
            res(response.data);
        })
        .catch((err) => {
            rej("Registration error");
        })
}

export function getLocalUser() {
        const userStr = localStorage.getItem("user");

        if(!userStr)
        {
            return null;
        }

        return JSON.parse(userStr);
}
