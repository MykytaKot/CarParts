<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>

            <li class="breadcrumb-item active" aria-current="page">Create car</li>
        </ol>
    </nav>
    <div>
        <h3 class="text-center">Create car</h3>
        <div class="d-flex justify-content-center">
            <div class="col-6 card shadow-sm p-4">
                <form @submit.prevent="addProduct">
                    <div class="form-group mb-2">

                        <input type="text" class="form-control p-2" placeholder="Car name" v-model="product.name">
                        <div class="pt-2 pb-2">
                            <input class="form-check-input " type="checkbox" v-model="product.is_registered"
                                id="flexSwitchCheckDefault">
                            <label class="form-check-label " style="margin-left: 0.5rem;" for="flexSwitchCheckDefault">: Is
                                registered</label>
                        </div>

                        <input v-if="product.is_registered" type="text" class="form-control p-2"
                            placeholder="Registration number" v-model="product.registration_number" required>

                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            product: {}
        }
    },
    methods: {
        addProduct() {
            this.product.action = 'save';
            this.axios
                .post('/api/cars', this.product)
                .then(response => (
                    this.$router.push({ name: 'home' })
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>