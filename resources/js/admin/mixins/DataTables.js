export default {
    data() {
        return {
            items: [],
            options: {},
            totalItems: 0,
            itemsPerPage: 5,
            loading: false,
            search: ""
        };
    },

    watch: {
        options() {
            this.fetchItems();
        },
        search() {
            this.fetchItems();
        }
    },

    methods: {
        async fetchItems() {
            // destructure object
            let { page, itemsPerPage: per_page, sortBy, sortDesc } = this.options;

            // if selected rows per page is `All`
            if (per_page == -1) {
                per_page = this.totalItems;
            }

            this.loading = true;
            await axios
                .get(
                    `${this.path}/list?page=${page}&per_page=${per_page}&column=${sortBy[0]}&order=${sortDesc}&filter=${this.search}`
                )
                .then(({ data }) => {
                    this.items = data.data;
                    this.totalItems = data.meta.total;
                })
                .catch(({ response }) => console.log(response.data))
                .finally(() => (this.loading = false));
        }
    }
}