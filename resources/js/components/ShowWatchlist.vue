<template>
    <div class="container">
        <div class="row justify-content-center">
            <h2>Your Watchlists</h2>
            <div class="row">
                <div v-for="watchlist in watchlists" :key="watchlist.id" class="col-sm-6 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ watchlist.name }}</h5>
                            <button @click="showMovies(watchlist.movies)" class="btn btn-primary m-2">Show Movies
                            </button>
                            <button type="button" class="btn btn-success m-2" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-auto-close="outside">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                     class="bi bi-person-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                    <path
                                        d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu p-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Member email</label>
                                    <input v-model="memberEmail" type="email" class="form-control" name="email">
                                    <div class="mb-3">
                                        <input class="form-check-input" type="radio" id="member" value="1"
                                               v-model="selectedMemberType">
                                        <label class="form-check-label" for="member">
                                            Just see
                                        </label>
                                        <input class="form-check-input" type="radio" id="collabor" value="2"
                                               v-model="selectedMemberType">
                                        <label class="form-check-label" for="collabor">
                                            Collaborator
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <button @click="addMember(watchlist.id)" type="submit" class="btn btn-light">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div v-if="moviesVisible">
                    <div class="container">
                        <div class="card-group mt-3">
                            <div v-for="movie in movies" :key="movie.id">
                                <div class="col sm-3">
                                    <div class="m-2">
                                        <div class="card border-dark mb-3">
                                            <img v-bind:src="'/storage/' + movie.poster_path" width="240"
                                                 height="360">
                                            <div class="card-body scrolling-text">
                                                <h6 class="card-title">{{ movie.title }}</h6>
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary m-1"
                                                        data-bs-toggle="modal"
                                                        :data-bs-target="'#exampleModal' + movie.id">
                                                    More
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        data-bs-auto-close="outside">
                                                    +
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
                                                        <img v-bind:src="'/storage/' + movie.poster_path"
                                                             width="500" height="700">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><strong>Release date:</strong> {{ movie.release_date }}
                                                        </p>
                                                        <p><strong>Vote average:</strong> {{ movie.vote_average }}
                                                        </p>
                                                        <p><strong>Vote count:</strong> {{ movie.vote_count }}</p>
                                                        <p><strong>Overview:</strong> {{ movie.overview }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";

const props = defineProps({
    user: Object,
});

let userId = props.user.id;
let watchlists = ref([]);
const moviesVisible = ref(false);
const movies = ref();
let memberEmail = ref();
let selectedMemberType = ref(null);

const showMovies = (watchlistMovies) => {
    movies.value = watchlistMovies;
    moviesVisible.value = true;
}

const addMember = async (watchlistId) => {
    let intMemberType = parseInt(selectedMemberType.value)

    let data = {
        'email': memberEmail.value,
        'watchlistId': watchlistId,
        'memberType': intMemberType,
    }

    try {
        const response = await axios.post('api/watchlist/member/add', data);
        console.log(response.data);
    } catch (error) {
        console.error('Error record to watchlist', error.message);
    }
};


onMounted(async () => {
    try {
        const response = await axios.get('api/watchlist/show/' + userId);
        watchlists.value = response.data;
    } catch (error) {
        console.error('Error fetching watchlist:', error.message);
    }
});


</script>
