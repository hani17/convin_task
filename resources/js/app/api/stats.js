
export const getStats = () => {
    return fetch(`/api/stats`)
        .then(res => res.ok ? res.json(): Promise.reject(res));
}
