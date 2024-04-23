import axios from '@/api/axios'

const genreList = (data) => {
    return axios
        .post(`/api/genre/post-list`, {post: data})
        .then(response => response.data)
}

const genreAdd = (data) => {
    return axios
        .post(`/api/genre/post-add`, {post: data})
        .then(response => response.data)
}


export default {
    genreList,
    genreAdd
}
