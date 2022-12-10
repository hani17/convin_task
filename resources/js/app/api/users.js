
export const searchAdmins = (val = '') => {
    return fetch(`/api/users?type=admin&q=${val}`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}

export const searchUsers = (val = '') => {
    return fetch(`/api/users?q=${val}`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}
