
export const getTasks = (page = 1) => {
    return fetch(`/api/tasks?page=${page}`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}

export const createTask = (data) => {
    return fetch(`/api/tasks`, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(res => res.ok ? res.json(): Promise.reject(res));
}
