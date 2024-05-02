<template>
    <search></search>
    <div class="container">
        <h2 class="p-1">Movie List</h2>
        <div class="row justify-content-center">
            <div class="card-group mt-3">
                <template v-if="movies && movies.data">
                    <div v-for="movie in movies.data" :key="movie.id">
                        <div class="col sm-3">
                            <div class="m-2">
                                <div class="card border-dark mb-3">
                                    <img v-bind:src="'/storage/' + movie.poster_path" width="240"
                                         height="360">
                                    <div class="card-body scrolling-text">
                                        <h6 class="card-title">{{ movie.title }}</h6>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                                :data-bs-target="'#exampleModal' + movie.id">
                                            More
                                        </button>
                                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-auto-close="outside">
                                            +
                                        </button>
                                        <button :class="movie.users.map(users => users.id).includes(userId) ? 'btn btn-success' : 'btn btn-secondary'"  @click="movie.users.map(users => users.id).includes(userId) ? movieWatchedDelete(movie.id, movie) : movieWatched(movie.id, movie)" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu p-4">
                                            <div class="mb-3">
                                                <div v-for="watchlist in watchlists" :key="watchlist.id">
                                                    <button @click="addToWatchlist(movie.id, watchlist.id)"
                                                            type="submit" class="btn btn-light">
                                                        {{ watchlist.name }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" :id="'exampleModal' + movie.id" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ movie.title }}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <img v-bind:src="'/storage/' + movie.poster_path" width="500"
                                                     height="700">
                                            </div>
                                            <div class="col-sm-4">
                                                <p><strong>Release date:</strong> {{ movie.release_date }}</p>
                                                <p><strong>Vote average:</strong> {{ movie.vote_average }}</p>
                                                <p><strong>Vote count:</strong> {{ movie.vote_count }}</p>
                                                <p><strong>Overview:</strong> {{ movie.overview }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Pagination buttons -->
        <nav aria-label="Page navigation" v-if="movies && movies.current_page && movies.last_page">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: movies.current_page === 1 }">
                    <a @click.prevent="fetchMovies(movies.current_page - 1)" class="page-link" href="#">Previous</a>
                </li>
                <li v-for="page in movies.last_page" :key="page" class="page-item"
                    :class="{ active: page === movies.current_page }">
                    <a @click.prevent="fetchMovies(page)" class="page-link" href="#">{{ page }}</a>
                </li>
                <li class="page-item" :class="{ disabled: movies.current_page === movies.last_page }">
                    <a @click.prevent="fetchMovies(movies.current_page + 1)" class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<style>
.scrolling-text {
    max-width: 240px;
    white-space: nowrap;
    overflow: hidden;
    animation: scrollText 10s linear infinite;
}

@keyframes scrollText {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}
</style>

<script setup>
import {onMounted, ref} from "vue";
import Search from "@/components/Search.vue";

const props = defineProps({
    user: Object,
});

let userId = props.user.id;
let watchlists = ref([]);
let currentPage = ref(1);
let movies = ref([]);

const addToWatchlist = async (movieId, watchlistId) => {
    let data = {
        'watchlistId': watchlistId,
        'movieId': movieId,
        // 'userId': userId
    }

    try {
        await axios.post('api/watchlist/movie/add', data);
    } catch (error) {
        console.error('Error record to watchlist', error.message);
    }
};

const fetchMovies = async (page) => {
    try {
        const response = await axios.get(`/api/movie?page=${page}`);
        movies.value = response.data;
    } catch (error) {
        console.error('Error fetching movies:', error.message);
    }
};

const movieWatched = async (movieId, movie) => {
    let data = {
        'movieId': movieId,
        'userId': userId
    }

    try {
        await axios.post('api/movie/watched/create', data);
        movie.users.push({ id: userId })
    } catch (error) {
        console.error('Error add to watched', error.message);
    }
}

const movieWatchedDelete = async (movieId, movie) => {
    try {
        await axios.delete('api/movie/watched/delete/' + movieId + '/' + userId);
        const index = movie.users.findIndex(u => u.id === userId);
        if (index !== -1) {
            movie.users.splice(index, 1);
        }
    } catch (error) {
        console.error('Error remove watched', error.message);
    }
}

onMounted(async () => {
    try {
        const response = await axios.get('api/movie');
        movies.value = response.data;
    } catch (error) {
        console.error('Error fetching watchlist:', error.message);
    }


    await fetchMovies(currentPage.value);
    try {
        const response = await axios.get('api/watchlist/permission/show/' + userId);
        watchlists.value = response.data;
    } catch (error) {
        console.error('Error fetching watchlist:', error.message);
    }
});
</script>
