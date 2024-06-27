import Alpine from "alpinejs";
window.Alpine = Alpine;

import axios from "axios";
import { Modal } from "bootstrap";

Alpine.data('todoList', () => ({
    loaded: false,

    data: [],
    currentPage: 1,
    lastPage: 1,
    total: 0,

    attributes: {
        id: '',
        title: '',
        description: ''
    },

    init() {
        this.fetchIndex()

        window.setInterval(
            () => this.fetchIndex(), 300000
        )
    },

    fetchIndex() {
        axios.get(`/todos?page=${this.currentPage}`)
            .then((response) => {
                this.data = response.data.data
                this.currentPage = response.data.meta.current_page
                this.lastPage = response.data.meta.last_page
                this.total = response.data.meta.total
                this.loaded = true
            })
    },

    fetchPage(page) {
        this.currentPage = page

        document.documentElement.scrollIntoView({ behavior: 'smooth' });

        this.fetchIndex()
    },

    fetch(id) {
        axios.get(`/todos/${id}`)
            .then((response) => {
                this.attributes.id = response.data.data.id
                this.attributes.title = response.data.data.title
                this.attributes.description = response.data.data.description
            })
    },

    save() {
        if (this.attributes.id.length == 0) {
            axios.post('/todos', this.attributes)
        } else {
            axios.patch(`/todos/${this.attributes.id}`, this.attributes)
        }

        Modal.getInstance(document.querySelector('#todoFormModal'))
            .hide()

        document.documentElement.scrollIntoView({ behavior: 'smooth' });

        this.fetchIndex()
    },

    reset() {
        this.attributes = {
            id: '',
            title: '',
            description: ''
        }
    },

    destroy(id) {
        axios.delete(`/todos/${id}`)

        Modal.getInstance(document.querySelector('#todoDeleteModal'))
            .hide()

        document.documentElement.scrollIntoView({ behavior: 'smooth' });

        this.fetchPage(1)
    },
}));

Alpine.start();
