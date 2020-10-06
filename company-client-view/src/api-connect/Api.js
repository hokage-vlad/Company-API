import axios from "axios";

let baseHttp = axios.create({
    baseURL: "http://127.0.0.1:8000/api"
});

let Api = function () {

    let token = localStorage.getItem("token");

    if (token) {
        baseHttp.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }

    return baseHttp;
};

export default Api;