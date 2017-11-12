<template>
    <h3 v-text="pageTitle"></h3>
            
    <ul v-bind:class="listClass">
        <li v-for="name in names" v-text="name" v-on:click="removeName"></li>
    </ul>

    <input type="text" v-model="newName">

    <button v-on:click="addName" v-bind:title="buttonTitle" v-bind:disabled="isDisabled">Add</button>

</template>

<script>
    export default {
    	data() {
    		return {
    			/**
		         * User names
		         * @type {Array}
		         */
		        names: (typeof window.localStorage.names !== 'string') ? [] : JSON.parse(window.localStorage.names),

		        /**
		         * New name input string
		         * @type {String}
		         */
		        newName: ''
    		};
    	},

        mounted() {
        	this.focusInput();
        },

        computed: {
	        pageTitle: function() {
	            var length = this.names.length;

	            return length + ' ' + (length === 1 ? 'Person' : 'People');
	        },

	        buttonTitle: function() {
	            return (this.newName === '') ? 'Add a name' : 'Add "' + this.newName + '"';
	        },

	        isDisabled: function() {
	            return (this.newName === '');
	        },

	        listClass: function() {
	            var count = this.names.length;

	            if (count > 5) {
	                return 'color-high';
	            }

	            if (count > 3) {
	                return 'color-medium';
	            }

	            return 'color-low';
	        }
    	},

	    methods: {
	        /**
	         * Add input string to list
	         */
	        addName: function() {
	            this.names.push(this.newName);
	            this.newName = '';
	            this.focusInput();
	        },

	        /**
	         * Remove clicked name from list
	         * @param  {Event} e
	         */
	        removeName: function(e) {
	            this.names.splice(this.names.indexOf(e.target.innerText), 1);
	            this.focusInput();
	        },

	        focusInput: function() {
	            document.querySelector('input').focus();
	        }
	    },

	    watch: {
	        names: function(data) {
	            window.localStorage.names = JSON.stringify(data);
	        }
	    }
    };

// var Vue = require('vue');

// Vue.component('task-list', require('./components/TaskList.vue'));

// var app = new Vue({
//     el: '#app',

//     data: {
//         /**
//          * User names
//          * @type {Array}
//          */
//         names: (typeof window.localStorage.names !== 'string') ? [] : JSON.parse(window.localStorage.names),

//         /**
//          * New name input string
//          * @type {String}
//          */
//         newName: ''
//     },

//     computed: {
//         pageTitle: function() {
//             var length = this.names.length;

//             return length + ' ' + (length === 1 ? 'Person' : 'People');
//         },

//         buttonTitle: function() {
//             return (this.newName === '') ? 'Add a name' : 'Add "' + this.newName + '"';
//         },

//         isDisabled: function() {
//             return (this.newName === '');
//         },

//         listClass: function() {
//             var count = this.names.length;

//             if (count > 5) {
//                 return 'color-high';
//             }

//             if (count > 3) {
//                 return 'color-medium';
//             }

//             return 'color-low';
//         }
//     },

//     methods: {
//         /**
//          * Add input string to list
//          */
//         addName: function() {
//             this.names.push(this.newName);
//             this.newName = '';
//             this.focusInput();
//         },

//         /**
//          * Remove clicked name from list
//          * @param  {Event} e
//          */
//         removeName: function(e) {
//             this.names.splice(this.names.indexOf(e.target.innerText), 1);
//             this.focusInput();
//         },

//         focusInput: function() {
//             document.querySelector('input').focus();
//         }
//     },

//     watch: {
//         names: function(data) {
//             window.localStorage.names = JSON.stringify(data);
//         }
//     },

//     mounted: function() {
//         this.focusInput();
//     }
// });
</script>
