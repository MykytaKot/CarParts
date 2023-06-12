<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>

            <li class="breadcrumb-item active" aria-current="page">Edit {{ part.name }}</li>
        </ol>
    </nav>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="d-flex justify-content-center">
            <div class="col-6 card shadow-sm p-4">
                <form @submit.prevent="updateProduct">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control p-2 mb-2" placeholder="Part name" v-model="part.name">


                        <input type="text" class="form-control p-2 mb-2" placeholder="Serial number"
                            v-model="part.serialnumber" required>
                        <label for="car" class="form-label">Car for part :</label>
                        <select class="form-select p-2" id='car' v-model="part.car_id" required>

                            <option v-for="option in cars" :value="option.id"> {{ option.name }}</option>



                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            part: {},
            cars: [],

        }
    },
    created() {
        this.axios
            .get('/api/cars/')
            .then(response => {

                this.cars = response.data;
                this.axios
                    .get(`/api/parts/${this.$route.params.id}`)
                    .then((res) => {
                        this.part = res.data;

                    });
            });

    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`/api/parts/${this.$route.params.id}`, this.part)
                .then((res) => {
                    this.$router.push(`/parts/${this.part.car_id}`)
                });
        }
    }
}
</script>