import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000',
  withCredentials: true
});

export const getCards = (page = 1) => api.get(`/api/cards?page=${page}`);
export const createCard = (payload) => api.post('/api/cards', payload);
export const updateCard = (id, payload) => api.put(`/api/cards/${id}`, payload);
export const deleteCard = (id) => api.delete(`/api/cards/${id}`);

export default api;
