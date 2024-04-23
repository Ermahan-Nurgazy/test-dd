import axios from '@/api/axios'

const postList = (data) => {
    return axios
        .post(`/api/post/post-list`, {post: data})
        .then(response => response.data)
}

const postAdd = (data) => {
    return axios
        .post(`/api/post/post-add`, {post: data})
        .then(response => response.data)
}


export default {
    postList,
    postAdd,
}
