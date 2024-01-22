<template>
    <!--    <h1>{{ movies }}</h1>-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-group mt-3">
                <!--            <div class="row">-->
                <div v-for="movie in movies" :key="movie.id">
                    <div class="col sm-3">
                        <div class="m-2">
                            <div class="card border-dark mb-3">
                                <img v-bind:src="'/storage/' + movie.poster_path" class="card-img-top" width="240" height="360">
                                <div class="card-body scrolling-text">
                                    <h6 class="card-title">{{ movie.title }}</h6>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">More</button>
                                    <button class="btn btn-info">+</button>
                                </div>
                            </div>
                        </div>
                        <!--                    </div>-->
                    </div>
                </div>
            </div>
        </div>
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
/* Add any additional styling as needed */
</style>

<script setup>
const props = defineProps(['movies'])
console.log(props.movies)
</script>
