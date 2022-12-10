
export const searchAdmins = (val = '') => {
    return fetch(`http://localhost/api/users?type=admin&q=${val}`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}

export const searchUsers = (val = '') => {
    return fetch(`http://localhost/api/users?q=${val}`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}
