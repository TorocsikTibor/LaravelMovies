<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col mb-3 p-2" >
                    <input type="text" v-model="searchText" class="form-control" id="searchText" name="searchText">
                </div>
                <div class="col p-2">
                    <input @click="submitSearch" class="btn btn-primary" type="submit" value="Search">
                </div>
            </div>

            <div v-if="responseData">
                <h2>Search Result</h2>
                <div v-for="result in responseData" :key="result.id">
                    <div class="card" style="width: 18rem;">
                        <img v-bind:src="'/storage/' + result.poster_path" class="card-img-top" width="200"
                             height="300">
                        <div class="card body">
                            <h5 class="card-title">{{ result.title }}</h5>
                            <p class="card-text">{{ result.overview }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Release date: {{ result.release_date }}</li>
                            <li class="list-group-item">Vote average: {{ result.vote_average }}</li>
                            <li class="list-group-item">Vote count: {{ result.vote_count }}</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>

            <ShowMovies>

            </ShowMovies>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchText: '',
            responseData: null,
            error: null,
        }
    },
    methods: {
        async submitSearch() {
            try {
                const response = await axios.get(`/search/${this.searchText}`);
                this.responseData = response.data.addedMovies;
            } catch (error) {
                this.error = error.message;
            }
        }
    }
}
</script>


