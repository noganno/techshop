new Vue({
    el: '#app',
    data() {
        return {
            info: null,
            loading: true,
            errored: false
        }
    },
    methods: {
        viewSkladProducts: function (e) {
            this.loading = true;
            axios
                .get('https://texnomart.uz/tm_control/cm/get-update-products-count', {
                    params: {
                        'store': e
                    }
                })
                .then(response => {
                    console.log(response.data)
                    Swal.fire(
                        '1c dagi product soni:' + response.data.count_1c,
                        'The Internet?',
                        'info'
                    )
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        updateSkladProducts: function (e) {
            this.loading = true;
            axios
                .get('https://texnomart.uz/tm_control/cm/update-new-products', {
                    params: {
                        'store': e
                    }
                })
                .then(response => {
                    console.log(response.data)
                    Swal.fire(
                        `Yangi product soni: ${response.data.count_new} Yangilangan product soni: ${response.data.count_updated}`,
                        'The Internet?',
                        'info'
                    )
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        updateSklads: function () {
            this.loading = true;
            axios
                .get('https://texnomart.uz/tm_control/cm/update-new-sklads')
                .then(response => {
                    this.info = response.data
                    // alert("Qo'shilgan sklad soni: " + response.data.count_added)
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        }
    },
    mounted() {
        axios
            .get('https://texnomart.uz/tm_control/cm/get-sklads')
            .then(response => {
                this.info = response.data
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false)
    }
})