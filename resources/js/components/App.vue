<template>
    <main class="position-fixed d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
          style="width: 280px; height: 100vh;">
        <div class="bg-dark p-2">
            <a href="#/" class="d-flex text-decoration-none align-items-center">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"/>
                </svg>
                <span class="fs-4">LaravelMovies</span>
            </a>
            <hr style="color: #4b5563">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#/" class="nav-link text-white" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-film" viewBox="0 0 16 16">
                            <path
                                d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                        </svg>
                        Movies
                    </a>
                </li>
                <li>
                    <a href="#/search" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        Search
                    </a>
                </li>
                <li>
                    <!--todo: disabled-->
                    <a href="#" class="nav-link text-white disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-tv" viewBox="0 0 16 16">
                            <path
                                d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5M13.991 3l.024.001a1.5 1.5 0 0 1 .538.143.76.76 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.5 1.5 0 0 1-.143.538.76.76 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.5 1.5 0 0 1-.538-.143.76.76 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.5 1.5 0 0 1 .143-.538.76.76 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2"/>
                        </svg>
                        Tv Series
                    </a>
                </li>
                <li>
                    <!--todo: disabled-->
                    <a href="#" class="nav-link text-white disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-list-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                        </svg>
                        Watching list
                    </a>
                </li>
                <li>
                    <a href="#/watchlist/create" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                        Create List
                    </a>
                </li>
                <li>
                    <a href="#/watchlist/show" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        My lists
                    </a>
                </li>
            </ul>
            <hr>

            <div v-if="user">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="bi bi-emoji-angry-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M4.053 4.276a.5.5 0 0 1 .67-.223l2 1a.5.5 0 0 1 .166.76c.071.206.111.44.111.687C7 7.328 6.552 8 6 8s-1-.672-1-1.5c0-.408.109-.778.285-1.049l-1.009-.504a.5.5 0 0 1-.223-.67zm.232 8.157a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 1 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5 0-.247.04-.48.11-.686a.502.502 0 0 1 .166-.761l2-1a.5.5 0 1 1 .448.894l-1.009.504c.176.27.285.64.285 1.049 0 .828-.448 1.5-1 1.5"/>
                            </svg>
                        </div>
                        <strong>{{ user.name }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <form ref="logoutForm" :action="logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf"/>
                        </form>
                        <li><a class="dropdown-item" @click.prevent="performLogout">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <div v-else>
                <a class="btn btn-light btn-sm mb-2" :href="login">Login</a>
                <br>
                <a class="btn btn-light btn-sm" :href="register">Registration</a>
            </div>
        </div>
    </main>
    <div class="flex-grow-1">
        <component :movies="moviesJSON" :user="user" :is="currentView"/>
    </div>
</template>

<script setup>
import {ref, computed} from 'vue'
import ShowMovies from './ShowMovies.vue'
import Search from './Search.vue'
import CreateWatchlist from './CreateWatchlist.vue'
import ShowWatchlist from './ShowWatchlist.vue'

const routes = {
    '/': ShowMovies,
    '/search': Search,
    '/watchlist/create': CreateWatchlist,
    '/watchlist/show': ShowWatchlist,
};

const props = defineProps({
    movies: Array,
    logout: String,
    login: String,
    register: String,
    csrf: String,
    user: Object,
});

let moviesJSON = JSON.parse(JSON.stringify(props.movies));

const currentPath = ref(window.location.hash);
const logoutForm = ref(null);

const performLogout = () => {
    logoutForm.value.submit();
};

window.addEventListener('hashchange', () => {
    currentPath.value = window.location.hash
})

const currentView = computed(() => {
    return routes[currentPath.value.slice(1) || '/']
})

</script>
