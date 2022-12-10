
export const getStats = () => {
    return fetch(`http://localhost/api/stats`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}
