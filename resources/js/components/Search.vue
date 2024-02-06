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
                <div class="card-group mt-3">
                    <div v-for="result in responseData" :key="result.id">
                        <div class="col sm-3">
                            <div class="m-2">
                                <div class="card border-dark mb-3">
                                    <img v-bind:src="'/storage/' + result.poster_path" width="240" height="360">
                                    <div class="card-body scrolling-text">
                                        <h6 class="card-title">{{ result.title }}</h6>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                                :data-bs-target="'#exampleModal' + result.id">
                                            More
                                        </button>
                                        <button class="btn btn-info">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" :id="'exampleModal' + result.id" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ result.title }}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <img v-bind:src="'/storage/' + result.poster_path" width="500" height="700">
                                            </div>
                                            <div class="col-sm-4">
                                                <p><strong>Release date:</strong> {{ result.release_date }}</p>
                                                <p><strong>Vote average:</strong> {{ result.vote_average }}</p>
                                                <p><strong>Vote count:</strong> {{ result.vote_count }}</p>
                                                <p><strong>Overview:</strong> {{ result.overview }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


