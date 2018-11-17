Vue.transition('fade', {
    enterClass: 'fadeIn',
    leaveClass: 'fadeOut'
});

Vue.transition('fadeWithMove', {
    enterClass: 'fadeInDown',
    leaveClass: 'fadeOutUp'
});

Vue.component('modal-box', {
    template: '#modal-box-template',

    props: ['id', 'title'],

    created: function() {
        this.closeModal();
    },

    computed: {
        isModalOpen: function() {
            return this.$root[this.id + 'IsOpen'];
        }
    },

    methods: {
        closeModal: function() {
            this.$root.$set(this.id + 'IsOpen', false);
        }
    }
});

new Vue({
    el: '#app',

    data: {
        modalData: {}
    },

    methods: {
        showModal: function(id, data) {
            this.$set(id + 'IsOpen', true);
            this.modalData = data;
        }
    }
});