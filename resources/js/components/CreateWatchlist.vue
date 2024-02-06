<template>
    <div class="container">
        <div class="row justify-content-center">
            <h2>Create Watchlist</h2>
            <div class="mt-4">
                <label for="name" class="form-label">Watchlist name</label>
                <input v-model="name" type="text" class="form-control" name="text">
            </div>
            <div class="mt-4">
                <button @click="saveWatchlist" type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";

const props = defineProps({
    user: Object,
});

let name = ref().value;
let userId = props.user.id;
let responseData = "";

const saveWatchlist = async () => {

    let data = {
        'name': name,
        'userId': userId,
    }

    try {
        const response = await axios.post(`/watchlist/create`, data);
        responseData = response.data;
    } catch (error) {
        this.error = error.message;
    }
};

</script>
